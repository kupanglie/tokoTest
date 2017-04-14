<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\expedition;

class ExpeditionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$expeditions = DB::table('expeditions')->get();

        return view('setting.expedition_management.index', compact('expeditions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setting.expedition_management.create');
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
			'handphone_number' => 'required',
		]);

		$expedition = new expedition();
		$expedition->name = $request->name;
		$expedition->handphone_number = $request->handphone_number;
		$expedition->save();

		return redirect()->route('expeditions-management.index');
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
		$expedition = DB::table('expeditions')->find($id);

		return view('setting.expedition_management.edit', compact('expedition'));
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
		DB::table('expeditions')
		->where('expeditions.id', '=', $id)
		->update([
			'name' => $request->name,
			'handphone_number' => $request->handphone_number
		]);

		return redirect()->route('expeditions-management.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$expedition = expedition::find($id);
		$expedition->delete();

		return redirect()->route('expeditions-management.index');
    }
}
