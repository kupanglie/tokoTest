<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\opname;
use App\stock;

class ListItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$item_mappings = DB::table('item_mappings')
		->join('items', 'item_mappings.item_id', '=', 'items.id')
		->join('stocks', 'item_mappings.stock_id', '=', 'stocks.id')
		->leftjoin('lengths', 'stocks.length_id', '=', 'lengths.id')
		->leftjoin('thicks', 'stocks.thick_id', '=', 'thicks.id')
		->join('opnames', 'opnames.item_mapping_id', '=', 'item_mappings.id')
		->select('stocks.*', 'item_mappings.id as item_mapping_id', 'item_mappings.item_id', 'item_mappings.stock_id', 'items.*', 'lengths.*', 'thicks.*', 'opnames.qty as opname_qty', 'opnames.is_opname')
		->get();

        return view('stock_management.list_items.index', compact('item_mappings'));
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
        //
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
		$item_mapping = DB::table('item_mappings')
		->join('items', 'item_mappings.item_id', '=', 'items.id')
		->join('stocks', 'item_mappings.stock_id', '=', 'stocks.id')
		->join('lengths', 'stocks.length_id', '=', 'lengths.id')
		->join('thicks', 'stocks.thick_id', '=', 'thicks.id')
		->join('opnames', 'opnames.item_mapping_id', '=', 'item_mappings.id')
		->select('stocks.*', 'item_mappings.id as item_mapping_id', 'item_mappings.item_id', 'item_mappings.stock_id', 'items.*', 'lengths.*', 'thicks.*', 'opnames.qty as opname_qty', 'opnames.is_opname')
		->where('item_mappings.id', '=', $id)
		->first();

        return view('stock_management.list_items.edit', compact('item_mapping'));
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
		// dd($request, $id);
		$opnames = opname::find($id);
		$opnames->qty = $request->actual_qty;
		$opnames->is_opname = '1';
		$opnames->save();

		$stocks = stock::find($request->stock_id);
		$stocks->qty = $request->actual_qty;
		$stocks->save();

		return redirect()->route('list-items.index');
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

	public function getOpnameItems()
	{
		$item_mappings = DB::table('item_mappings')
			->join('items', 'item_mappings.item_id', '=', 'items.id')
			->join('stocks', 'item_mappings.stock_id', '=', 'stocks.id')
			->join('lengths', 'stocks.length_id', '=', 'lengths.id')
			->join('thicks', 'stocks.thick_id', '=', 'thicks.id')
			->join('opnames', 'opnames.item_mapping_id', '=', 'item_mappings.id')
			->select('stocks.*', 'item_mappings.id as item_mapping_id', 'item_mappings.item_id', 'item_mappings.stock_id', 'items.*', 'lengths.*', 'thicks.*', 'opnames.qty as opname_qty', 'opnames.is_opname')
			->orderBy('item_id', 'asc')
			->get();

		return view('stock_management.list_items.opname-pdf', compact('item_mappings'));
	}

	public function postEditItemPrice(Request $request)
	{
		$stocks = stock::find($request->stock_id);
		$stocks->sell_price = $request->price;
		$stocks->save();

		return redirect()->route('list-items.index');
	}
}
