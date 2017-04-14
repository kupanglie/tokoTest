<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\sales;

class SalesManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$sales_list = DB::table('sales')->get();

        return view('setting.sales_management.index', compact('sales_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setting.sales_management.create');
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

		$sales = new sales();
		$sales->name = $request->name;
		$sales->identity_number = $request->identity_number;
		$sales->address = $request->address;
		$sales->handphone_number = $request->handphone_number;
		$sales->save();

		return redirect()->route('sales-management.index');
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
		$sales = DB::table('sales')->find($id);

		return view('setting.sales_management.edit', compact('sales'));
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
		$sales = sales::find($id);
		$sales->name = $request->name;
		$sales->identity_number = $request->identity_number;
		$sales->address = $request->address;
		$sales->handphone_number = $request->handphone_number;
		$sales->save();

		return redirect()->route('sales-management.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$sales = sales::find($id);
		$sales->delete();

		return redirect()->route('sales-management.index');
    }
}
