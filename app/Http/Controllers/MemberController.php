<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Propaganistas\LaravelPhone\PhoneNumber;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('isLeader');
        $leader = Auth::user();
        $search = User::query()->where('church_id', $leader->church_id);
        if (request('term')) {
            $search->where('firstName', 'Like', '%' . request('term') . '%')
                ->orWhere('sirName', 'Like', '%' . request('term') . '%');
        }
//        $users = User::paginate(10);
//        dd($users);
        $members = $search->orderBy('firstName', 'ASC')->paginate(10);
        return view('leader.members', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('isLeader');
        $regions = Region::all()->sortBy('region');
        return view('leader.addMember', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isLeader');
//        dd($request);
        $data = $request->validate([
            'firstName' => 'required|string|min:3|max:255|alpha',
            'sirName' => 'required|string|min:3|max:255|alpha',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|string|phone:TZ|max:255|unique:users',
            'gender' => 'required|string',
            'church_id' => 'string',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required',
        ]);

        User::create([
            'firstName' => $data['firstName'],
            'sirName' => $data['sirName'],
            'email' => $data['email'],
            'mobile' => phoneNumber::make($data['mobile'],'TZ')->formatInternational(),
            'gender' => $data['gender'],
            'password' => Hash::make($data['firstName']),
            'role' => $data['role'],
            'church_id' => $data['church_id']
        ]);

        return redirect('/members')->with('message', "Member Registered Successful!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $member)
    {
//        $this->authorize('isLeader');
        $regions = Region::all()->sortBy('region');
        return view('leader.editMember', compact('member', 'regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('isLeader');

        $user = User::findOrFail($id);
        if (empty($request['password'])) {
            $data = $request->validate([
                'firstName' => 'required|string|alpha|min:3|max:255',
                'sirName' => 'required|string|alpha|min:3|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'mobile' => 'required|string|phone:TZ|max:255|unique:users,mobile,' . $user->id,
                'role' => 'required'
            ]);
        } else {
            $data = $request->validate([
                'firstName' => 'required|string|alpha|min:3|max:255',
                'sirName' => 'required|string|alpha|min:3|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'mobile' => 'required|string|phone:TZ|max:255|unique:users,mobile,' . $user->id,
                'role' => 'required',
                'password' => 'sometimes|string|min:8|confirmed',
            ]);
        }
        $data['church_id'] = $request['church_id'];
        $request['mobile'] = phoneNumber::make($request['mobile'], 'TZ')->formatInternational();
        if (empty($data['password'])) {
            $user->update($request->except('password'));
        } else {
            $data['mobile'] = phoneNumber::make($data['mobile'], 'TZ')->formatInternational();
            $data['password'] = Hash::make($data['password']);
            $user->update($data);
        }
        return redirect('/members')->with('message', 'User Updated Successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
