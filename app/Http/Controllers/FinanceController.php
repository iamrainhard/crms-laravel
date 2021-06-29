<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = Finance::query();
        if (request('term')) {
            $search->where('type', 'Like', '%' . request('term') . '%');
        }
//        $users = User::paginate(10);
//        dd($users);
        $finances = $search->orderBy('type', 'ASC')->paginate(10);
        return view('manager.finance', compact('finances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|string|max:255|min:3'
        ]);
        Finance::create([
            'type' => $data['type'],
        ]);
        return redirect('/finances')->with('status', 'Record Added Successful');
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
    public function edit(Finance $finance)
    {
        return view('manager.editFinance', compact('finance'));
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
        $finance = Finance::findOrFail($id);
        $this->validate($request,[
            'type' => 'required|string|max:255|min:3'
        ]);
        $finance->update($request->all());
        return redirect('/finances')->with('status', 'Record Updated Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finance $finance)
    {
        $finance->delete();
        return redirect('/finances')->with('status','Record Deleted Successful');
    }
}
