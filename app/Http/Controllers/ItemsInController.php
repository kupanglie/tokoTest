<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\item;
use App\stock;
use App\item_in;
use App\item_mapping;
use App\opname;

class ItemsInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$itemsIn = DB::table('item_ins')
		->join('item_mappings', 'item_ins.item_mapping_id', '=', 'item_mappings.id')
		->leftjoin('preorders', 'item_ins.preorder_id', '=', 'preorders.id')
		->join('items', 'item_mappings.item_id', '=', 'items.id')
		->join('stocks', 'item_mappings.stock_id', '=', 'stocks.id')
		->join('lengths', 'stocks.length_id', '=', 'lengths.id')
		->join('thicks', 'stocks.thick_id', '=', 'thicks.id')
		->leftjoin('projects', 'item_ins.project_id', '=', 'projects.id')
		->select('items.*', 'lengths.*', 'thicks.*', 'stocks.*', 'item_ins.qty as quantity', 'item_ins.created_at as date', 'item_ins.*', 'preorders.*', 'projects.name as project_name')
		->get();

        return view('stock_management.items_in.index', compact('itemsIn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$items = DB::table('items')->get();
		$length_categories = DB::table('lengths')->get();
		$thick_categories = DB::table('thicks')->get();
		$projects = DB::table('projects')->get();

        return view('stock_management.items_in.create', compact('items', 'length_categories', 'thick_categories', 'projects'));
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
			'item_id' => 'required',
			'qty' => 'required'
		]);

		$item_mapping = DB::table('item_mappings')
		->join('items', 'item_mappings.item_id', '=', 'items.id')
		->join('stocks', 'item_mappings.stock_id', '=', 'stocks.id')
		->where('items.id', '=', $request->item_id)
		->where('stocks.length_id', '=', $request->length_id)
		->where('stocks.actual_length', '=', $request->length)
		->where('stocks.thick_id', '=', $request->thick_id)
		->select('item_mappings.id as item_mapping_id', 'item_mappings.*', 'items.*', 'stocks.*')
		->first();
		$check_status = count($item_mapping);

		if($check_status == NULL) {
			$newStock = new stock();
			$newStock->length_id = $request->length_id;
			$newStock->thick_id = $request->thick_id;
			$newStock->actual_length = $request->length;
			$newStock->qty = $request->qty;
			$newStock->save();

			$newItemMappings = new item_mapping();
			$newItemMappings->item_id = $request->item_id;
			$newItemMappings->stock_id = $newStock->id;
			$newItemMappings->save();

			$newItemIn = new item_in();
			$newItemIn->item_mapping_id = $newItemMappings->id;
			$newItemIn->project_id = $request->project_id;
			$newItemIn->qty = $request->qty;
			if($request->information != NULL) {
				$newItemIn->information = $request->information;
			}
			$newItemIn->save();

			$newOpname = new opname();
			$newOpname->item_mapping_id = $newItemMappings->id;
			$newOpname->is_opname = 0;
			$newOpname->save();
		} else {
			$newItemIn = new item_in();
			$newItemIn->item_mapping_id = $item_mapping->item_mapping_id;
			$newItemIn->project_id = $request->project_id;
			$newItemIn->qty = $request->qty;
			if($request->information != NULL) {
				$newItemIn->information = $request->information;
			}
			$newItemIn->save();

			$oldStock = DB::table('stocks')->find($item_mapping->stock_id);
			$newStock = $oldStock->qty + $request->qty;

			$stocks = stock::find($item_mapping->stock_id);
			$stocks->qty = $newStock;
			$stocks->save();

			$opnames = opname::where('item_mapping_id', $item_mapping->item_mapping_id)->first();
			$opnames->qty = NULL;
			$opnames->is_opname = 0;
			$opnames->save();
		}
		return redirect()->route('list-items.index');
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
        //
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
        //
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
}
