<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Models\Region;
use Illuminate\Http\Request;

class ChurchController extends Controller
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
        $this->authorize('isAdman');
        $search = Church::query();
//        dd($search);
        if (request('term')) {
            $search->where('name', 'Like', '%' . request('term') . '%');
        }
//        $users = User::paginate(10);
//        dd($users);
        $churches = $search->orderBy('name', 'ASC')->paginate(10);
//        dd($churches);
        return view('manager.church', compact('churches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('isAdman');
        $regions = Region::all()->sortBy('region');
        return view('manager.addChurch', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isAdman');
        $data = $request->validate([
            'name' => 'required|string|max:255|min:3',
            'region' => 'required'
        ]);

        Church::create([
            'name' => $data['name'],
            'region_id' => $data['region']
        ]);

        return redirect('/churches')->with('message', "Church Registered Successful!");
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
    public function edit(Church $church)
    {
        $this->authorize('isAdman');
        $regions = Region::all()->sortBy('region');
        return view('manager.editChurch', compact('church', 'regions'));
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
        $this->authorize('isAdman');
        $church = Church::findOrFail($id);
//        dd($church);

        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'region_id' => 'required'
        ]);

        $church->update($data);
        return redirect('/churches')->with('message', "Church Branch Details Updated Successful!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Church $church)
    {
        $this->authorize('isAdman');
        $church->delete();
        return redirect('/churches')->with('message', 'Church Deleted Successful');
    }
}
