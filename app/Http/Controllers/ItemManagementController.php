<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\item;
use APP\item_mapping;

class ItemManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$items = DB::table('items')->get();

		return view('setting.item_management.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setting.item_management.create');
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
		]);

		$newItem = new item();
		$newItem->name = $request->name;
		$newItem->save();

		return redirect()->route('item-management.index');
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
		$item = DB::table('items')->find($id);

		return view('setting.item_management.edit', compact('item'));
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
		DB::table('items')
		->where('items.id', '=', $id)
		->update(['name' => $request->name]);

		return redirect()->route('item-management.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$status = DB::table('item_mappings')
		->join('stocks', 'item_mappings.stock_id', '=', 'stocks.id')
		->where('item_mappings.item_id', '=', $id)
		->get();

		if(count($status) == NULL) {
	        $item = item::find($id);
			$item->delete();
		} else {
			return redirect()->route('item-management.index');
		}
		return redirect()->route('item-management.index');
    }
}
