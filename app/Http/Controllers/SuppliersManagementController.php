<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\supplier;

class SuppliersManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = DB::table('suppliers')
		->get();

		return view('setting.supplier_management.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setting.supplier_management.create');
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
			'information' => 'required',
		]);

		$supplier = new supplier();
		$supplier->name = $request->name;
		$supplier->handphone_number = $request->handphone_number;
		$supplier->information = $request->information;
		$supplier->save();

		return redirect()->route('suppliers-management.index');
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
		$supplier = DB::table('suppliers')->find($id);

		return view('setting.supplier_management.edit', compact('supplier'));
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
		$supplier = supplier::find($id);
		$supplier->name = $request->name;
		$supplier->handphone_number = $request->handphone_number;
		$supplier->information = $request->information;
		$supplier->save();

		return redirect()->route('suppliers-management.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$supplier = supplier::find($id);
		$supplier->delete();

		return redirect()->route('suppliers-management.index');
    }
}
