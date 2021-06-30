<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Models\FinanceRecord;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

//        For admin Dashboard
        $totalUsers = User::count();
        $totalMembers = User::where('role','member')->count();
        $totalChurches = Church::count();
        $totalPastors = User::where('role','pastor')->count();
        $regionCount = Region::count();
        $regionWithChurch = Region::has('churches')->count();
        $churchPercent = round((($regionWithChurch/$regionCount)*100), 2);
//        $admins = User::where('role','admin')->get();

//        Admins Search
        $searchA = User::query()->where('role','admin');
        $searchM = User::query()->where('role','manager');
        if (request('term')){
            $searchA->where('firstName', 'Like', '%'. request('term').'%')
                ->orWhere('sirName', 'Like', '%'. request('term').'%');
        }
        if (request('term')){
            $searchM->where('firstName', 'Like', '%'. request('term').'%')
                ->orWhere('sirName', 'Like', '%'. request('term').'%');
        }
        $admins = $searchA->orderBy('firstName', 'ASC')->paginate(10);
        $managers = $searchM->orderBy('firstName', 'ASC')->paginate(10);
//        dd($managers);
        // For Pastor Dashboard
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);

        $totalChurchMembers = User::where('church_id', $user->church_id)->where('role','member')->count();
        $totalChurchElders = User::where('church_id', $user->church_id)->where('role','elder')->count();
        $churchElders = User::where('church_id', $user->church_id)->where('role','elder')->orderBy('firstName', 'ASC')->paginate(10);
        $myPastor = User::where('church_id', $user->church_id)->where('role', 'pastor')->first();
        $yearlyCollection = FinanceRecord::whereYear('created_at', now()->year)->where('church_id', $user->church_id)->sum('amount');
        $weeklyCollection = FinanceRecord::whereBetween('created_at',[now()->startOfWeek(), now()->endOfWeek()])->sum('amount');
        $monthlyCollection = FinanceRecord::whereMonth('created_at',now()->month)->sum('amount');
//        dd($monthlyCollection);





        if ($user->role === 'admin') {
            return view('admin.dashboard', compact('totalUsers','totalChurches','totalPastors','churchPercent','admins'));
        }elseif ($user->role === 'manager') {
            return view('manager.dashboard', compact('totalMembers','totalChurches','totalPastors','churchPercent','managers'));
        }elseif ($user->role === 'leader' || $user->role === 'pastor') {
            return view('leader.dashboard', compact('totalChurchMembers', 'totalChurchElders','churchElders','yearlyCollection','monthlyCollection','weeklyCollection'));
        }else{
            return view('home',compact('totalChurchMembers','myPastor','yearlyCollection','monthlyCollection','weeklyCollection','churchElders'));
        }

    }
}
