<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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

    public function index(Request $request)
    {
        $search = User::query();
        if (request('term')) {
            $search->where('firstName', 'Like', '%' . request('term') . '%')
                ->orWhere('sirName', 'Like', '%' . request('term') . '%');
        }
//        $users = User::paginate(10);
//        dd($users);
        $users = $search->orderBy('firstName', 'ASC')->paginate(10);
        return view('admin.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::all()->sortBy('region');
        return view('admin.addUser', compact('regions'));
    }

    public function getChurch(Request $request)
    {
        $data['churches'] = Church::where("region_id", $request->region)
            ->get(["name", "id"]);
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'firstName' => 'required|string|min:3|max:255|alpha',
            'sirName' => 'required|string|min:3|max:255|alpha',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|string|max:255|unique:users,',
            'gender' => 'required|string',
            'church_id' => 'string',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required',
        ]);

        User::create([
            'firstName' => $data['firstName'],
            'sirName' => $data['sirName'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'gender' => $data['gender'],
            'password' => Hash::make($data['firstName']),
            'role' => $data['role'],
            'church_id' => $data['church_id'],
        ]);

        return redirect('/users')->with('message', "User Registered Successful!");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $regions = Region::all()->sortBy('region');
        return view('admin.editUser', compact('user', 'regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);
        if (empty($request['password'])) {
            $data = $request->validate([
                'firstName' => 'required|string|alpha|min:3|max:255',
                'sirName' => 'required|string|alpha|min:3|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'mobile' => 'required|string|max:255|unique:users,mobile,' . $user->id,
                'role' => 'required'
            ]);
        } else {
            $data = $request->validate([
                'firstName' => 'required|string|alpha|min:3|max:255',
                'sirName' => 'required|string|alpha|min:3|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'mobile' => 'required|string|max:255|unique:users,mobile,' . $user->id,
                'role' => 'required',
                'password' => 'sometimes|string|min:8|confirmed',
            ]);
        }
        $data['church_id'] = $request['church_id'];
        if (empty($data['password'])) {
            $user->update($request->except('password'));
        } else {
            $data['password'] = Hash::make($data['password']);
            $user->update($data);
        }
        return redirect('/users')->with('message', 'User Updated Successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
//        $this->authorize('isAdmin');
        $user->delete();
        return redirect('/users');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('profile',compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
//        dd($request);
        $user = User::findOrFail($id);
        if (empty($request['password'])) {
            $data = $request->validate([
                'firstName' => 'required|string|alpha|min:3|max:255',
                'sirName' => 'required|string|alpha|min:3|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'mobile' => 'required|string|max:255|unique:users,mobile,' . $user->id,
            ]);
        } else {
            $data = $request->validate([
                'firstName' => 'required|string|alpha|min:3|max:255',
                'sirName' => 'required|string|alpha|min:3|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'mobile' => 'required|string|max:255|unique:users,mobile,' . $user->id,
                'password' => 'sometimes|string|min:8|confirmed',
            ]);
        }
        if (empty($data['password'])) {
            $user->update($request->except('password'));
        } else {
            $data['password'] = Hash::make($data['password']);
            $user->update($data);
        }
        return redirect('/profile')->with('message', 'User Profile Updated Successful!');

    }
}
