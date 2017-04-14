<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Worker;

class WorkerManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$workers = DB::table('workers')->get();

        return view('setting.worker_management.index', compact('workers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view('setting.worker_management.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request, [
			'name' => 'required',
			'identity_number' => 'required',
			'address' => 'required',
			'handphone_number' => 'required'
		]);

		$worker = new worker();
		$worker->name = $request->name;
		$worker->identity_number = $request->identity_number;
		$worker->address = $request->address;
		$worker->handphone_number = $request->handphone_number;
		$worker->save();

		return redirect()->route('worker-management.index');
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
    public function edit($id)
    {
		$worker = DB::table('workers')->find($id);

		return view('setting.worker_management.edit', compact('worker'));
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
		$worker = worker::find($id);
		$worker->name = $request->name;
		$worker->identity_number = $request->identity_number;
		$worker->address = $request->address;
		$worker->handphone_number = $request->handphone_number;
		$worker->save();

		return redirect()->route('worker-management.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$worker = worker::find($id);
		$worker->delete();

		return redirect()->route('worker-management.index');
    }
}
