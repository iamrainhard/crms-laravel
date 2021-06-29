<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\FinanceRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd(Auth::user()->church_id);
        $search = FinanceRecord::query()->where('church_id', Auth::user()->church_id);
        $finances = Finance::all();
        if (request('term')) {
            $search->where('amount', 'Like', '%' . request('term') . '%')
                ->orWhere('description', 'Like', '%' . request('term') . '%');
        }
//        $users = User::paginate(10);
//        dd($users);
        $records = $search->orderBy('created_at', 'ASC')->paginate(10);
        return view('leader.records', compact('records','finances'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'finance_id' => 'required',
            'amount' => 'required|numeric',
            'description' => 'required|string|max:255|min:10',
        ]);
        FinanceRecord::create([
            'finance_id' => $data['finance_id'],
            'amount' => round($data['amount'],2),
            'description' => $data['description'],
            'church_id' => Auth::user()->church_id,
        ]);
        return redirect('/records')->with('status', 'Record Added Successful!');
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
    public function edit(FinanceRecord $record)
    {
        $finances = Finance::all();
        return view('leader.editRecord', compact('record','finances'));
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
        $record = FinanceRecord::findOrFail($id);
        $this->validate($request,[
            'finance_id' => 'required',
            'amount' => 'required|numeric',
            'description' => 'required|string|max:255|min:10',
        ]);
        $record->update($request->all());
        return redirect('/records')->with('status', 'Record Updated Successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinanceRecord $record)
    {
        $record->delete();
        return redirect('/records')->with('status','Record Deleted Successful');
    }
}
