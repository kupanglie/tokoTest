<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\preorder;
use App\expedition_mapping;
use App\supplier_mapping;
use App\preorder_item_mapping;
use App\item;
use App\stock;
use App\item_in;
use App\item_mapping;
use App\opname;

class ListPreordersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$preorders = DB::table('preorders')
		->join('supplier_mappings', 'supplier_mappings.preorder_id', '=', 'preorders.id')
		->join('expedition_mappings', 'expedition_mappings.preorder_id', '=', 'preorders.id')
		->join('suppliers', 'suppliers.id', '=', 'supplier_mappings.supplier_id')
		->join('expeditions', 'expeditions.id', '=', 'expedition_mappings.expedition_id')
		->select('preorders.*', 'supplier_mappings.*', 'expedition_mappings.*', 'suppliers.name as supplier_name', 'expeditions.name as expedition_name')
		->get();

        return view('stock_management.list_preorders.index', compact('preorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$suppliers = DB::table('suppliers')->get();
		$expeditions = DB::table('expeditions')->get();
		$items = DB::table('items')->get();
		$no_preorder = count(DB::table('preorders')->get()) + 1 . '/UD PS/' . date('m') . '/' . date('y');

        return view('stock_management.list_preorders.create', compact('suppliers', 'expeditions', 'items', 'no_preorder'));
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
			'no_preorder' => 'required',
			'supplier_id' => 'required',
			'expedition_id' => 'required',
			'item_id.*' => 'required',
			'qty.*' => 'required'
		]);

		$preorder = new preorder();
		$preorder->no_preorder = $request->no_preorder;
		$preorder->date_request = date('Y-m-d');
		$preorder->save();

		$supplier_mapping = new supplier_mapping();
		$supplier_mapping->preorder_id = $preorder->id;
		$supplier_mapping->supplier_id = $request->supplier_id;
		$supplier_mapping->save();

		$expedition_mapping = new expedition_mapping();
		$expedition_mapping->preorder_id = $preorder->id;
		$expedition_mapping->expedition_id = $request->expedition_id;
		$expedition_mapping->save();

		for($i=0;$i<$request->row_count;$i++)
		{
			$preorder_item_mapping = new preorder_item_mapping();
			$preorder_item_mapping->preorder_id = $preorder->id;
			$preorder_item_mapping->item_id = $request->item_id[$i];
			$preorder_item_mapping->qty = $request->qty[$i];
			$preorder_item_mapping->length = $request->length[$i];
			$preorder_item_mapping->save();
		}

		return redirect()->route('list-preorders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$preorder = DB::table('preorders')
		->join('supplier_mappings', 'supplier_mappings.preorder_id', '=', 'preorders.id')
		->join('expedition_mappings', 'expedition_mappings.preorder_id', '=', 'preorders.id')
		->join('suppliers', 'suppliers.id', '=', 'supplier_mappings.supplier_id')
		->join('expeditions', 'expeditions.id', '=', 'expedition_mappings.expedition_id')
		->select('preorders.*', 'supplier_mappings.*', 'expedition_mappings.*', 'suppliers.name as supplier_name', 'expeditions.name as expedition_name')
		->where('preorders.id', '=', $id)
		->first();

		$preorder_items = DB::table('preorder_item_mappings')
		->join('items', 'preorder_item_mappings.item_id', '=', 'items.id')
		->select('preorder_item_mappings.*', 'items.id as item_id', 'items.name as item_name')
		->where('preorder_item_mappings.preorder_id', '=', $id)
		->get();

        return view('stock_management.list_preorders.show', compact('preorder', 'preorder_items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$preorder = DB::table('preorders')
		->join('supplier_mappings', 'supplier_mappings.preorder_id', '=', 'preorders.id')
		->join('expedition_mappings', 'expedition_mappings.preorder_id', '=', 'preorders.id')
		->join('suppliers', 'suppliers.id', '=', 'supplier_mappings.supplier_id')
		->join('expeditions', 'expeditions.id', '=', 'expedition_mappings.expedition_id')
		->select('preorders.*', 'supplier_mappings.*', 'expedition_mappings.*', 'suppliers.name as supplier_name', 'expeditions.name as expedition_name')
		->where('preorders.id', '=', $id)
		->first();

		$preorder_items = DB::table('preorder_item_mappings')
		->join('items', 'preorder_item_mappings.item_id', '=', 'items.id')
		->select('preorder_item_mappings.*', 'items.id as item_id', 'items.name as item_name')
		->where('preorder_item_mappings.preorder_id', '=', $id)
		->get();

		$length_categories = DB::table('lengths')->get();
		$thick_categories = DB::table('thicks')->get();

        return view('stock_management.list_preorders.edit', compact('preorder', 'preorder_items', 'length_categories', 'thick_categories'));
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
		$expedition_mapping = expedition_mapping::where('preorder_id', $id)->first();
		$expedition_mapping->price = $request->expedition_price;
		$expedition_mapping->save();

		for($i=0;$i<count($request->preorder_item_mapping_id);$i++)
		{
			$preorder_item_mapping = preorder_item_mapping::find($request->preorder_item_mapping_id[$i]);
			$preorder_item_mapping->price = $request->price[$i];
			if(isset($request->length_id[$i])){
				$preorder_item_mapping->length_id = $request->length_id[$i];
			}
			if(isset($request->thick_id[$i])){
				$preorder_item_mapping->thick_id = $request->thick_id[$i];
			}
			$preorder_item_mapping->actual_length = $request->length[$i];
			$preorder_item_mapping->actual_qty = $request->actual_qty[$i];
			$preorder_item_mapping->save();
		}

		$preorder = preorder::find($id);
		$preorder->date_arrive = date('Y-m-d');
		$preorder->save();

		return redirect()->route('list-preorders.index');
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

	public function getPreorderPdf($id)
	{
		$items = DB::table('preorder_item_mappings')
					->join('items', 'preorder_item_mappings.item_id', '=', 'items.id')
					->where('preorder_item_mappings.preorder_id', $id)
					->get();

		$preorder = DB::table('preorders')
					->where('preorders.id', $id)
					->first();

		$preorder_date = date('d F Y', strtotime($preorder->updated_at));

		return view('stock_management.list_preorders.preorder-pdf', compact('items', 'preorder_date', 'preorder'));
	}

	public function getRecapPdf($id)
	{
		$items = DB::table('preorder_item_mappings')
					->join('items', 'preorder_item_mappings.item_id', '=', 'items.id')
					->where('preorder_item_mappings.preorder_id', $id)
					->get();

		$preorder = DB::table('preorders')
					->where('preorders.id', $id)
					->first();

		$preorder_date = date('d F Y', strtotime($preorder->updated_at));

		return view('stock_management.list_preorders.recap-pdf', compact('items', 'preorder_date', 'preorder'));
	}

	public function getEditPreorder($id)
	{
		$suppliers = DB::table('suppliers')->get();
		$expeditions = DB::table('expeditions')->get();
		$items = DB::table('items')->get();

		$preorder = DB::table('preorders')
					->where('preorders.id', $id)
					->first();

		$preorder_items = DB::table('preorder_item_mappings')
						->where('preorder_item_mappings.preorder_id', $id)
						->get();

		$preorder_supplier = DB::table('supplier_mappings')
					->join('suppliers', 'supplier_mappings.supplier_id', '=', 'suppliers.id')
					->where('supplier_mappings.preorder_id', $id)
					->select('supplier_mappings.id as supplier_mapping_id', 'supplier_mappings.*', 'suppliers.*')
					->first();

		$preorder_expedition = DB::table('expedition_mappings')
					->join('expeditions', 'expedition_mappings.expedition_id', '=', 'expeditions.id')
					->where('expedition_mappings.preorder_id', $id)
					->select('expedition_mappings.id as expedition_mapping_id', 'expedition_mappings.*', 'expeditions.*')
					->first();

        return view('stock_management.list_preorders.edit-preorder', compact('suppliers', 'expeditions', 'items', 'preorder', 'preorder_items', 'preorder_supplier', 'preorder_expedition'));
	}

	public function postEditPreorder(Request $request)
	{
		$this->validate($request, [
			'no_preorder' => 'required',
			'supplier_id' => 'required',
			'expedition_id' => 'required',
			'item_id.*' => 'required',
			'qty.*' => 'required'
		]);

		$preorder = preorder::find($request->preorder_id);
		$preorder->no_preorder = $request->no_preorder;
		$preorder->date_request = date('Y-m-d');
		$preorder->save();

		$supplier_mapping = supplier_mapping::find($request->supplier_mapping_id);
		$supplier_mapping->supplier_id = $request->supplier_id;
		$supplier_mapping->save();

		$expedition_mapping = expedition_mapping::find($request->expedition_mapping_id);
		$expedition_mapping->expedition_id = $request->expedition_id;
		$expedition_mapping->save();

		$old_preorder_item_mapping = preorder_item_mapping::where('preorder_id', $request->preorder_id);
		$old_preorder_item_mapping->delete();

		for($i=0;$i<$request->row_count;$i++)
		{
			$preorder_item_mapping = new preorder_item_mapping();
			$preorder_item_mapping->preorder_id = $request->preorder_id;
			$preorder_item_mapping->item_id = $request->item_id[$i];
			$preorder_item_mapping->qty = $request->qty[$i];
			$preorder_item_mapping->length = $request->length[$i];
			$preorder_item_mapping->save();
		}

		return redirect()->route('list-preorders.index');
	}

	public function postVerifyInvoice(Request $request)
	{
		$preorder_item_mappings = DB::table('preorder_item_mappings')
									->where('preorder_id', $request->preorder_id)
									->get();

		foreach($preorder_item_mappings as $preorder_item_mapping) {
			$item_mapping = DB::table('item_mappings')
			->join('items', 'item_mappings.item_id', '=', 'items.id')
			->join('stocks', 'item_mappings.stock_id', '=', 'stocks.id')
			->where('items.id', '=', $preorder_item_mapping->item_id)
			->where('stocks.length_id', '=', $preorder_item_mapping->length_id)
			->where('stocks.actual_length', '=', $preorder_item_mapping->length)
			->where('stocks.thick_id', '=', $preorder_item_mapping->thick_id)
			->select('item_mappings.id as item_mapping_id', 'item_mappings.*', 'items.*', 'stocks.*')
			->first();
			$check_status = count($item_mapping);

			if($check_status == 0) {
				$newStock = new stock();
				$newStock->length_id = $preorder_item_mapping->length_id;
				$newStock->thick_id = $preorder_item_mapping->thick_id;
				$newStock->actual_length = $preorder_item_mapping->actual_length;
				$newStock->buy_price = $preorder_item_mapping->price;
				$newStock->qty = $preorder_item_mapping->actual_qty;
				$newStock->save();

				$newItemMappings = new item_mapping();
				$newItemMappings->item_id = $preorder_item_mapping->item_id;
				$newItemMappings->stock_id = $newStock->id;
				$newItemMappings->save();

				$newItemIn = new item_in();
				$newItemIn->item_mapping_id = $newItemMappings->id;
				$newItemIn->preorder_id = $request->preorder_id;
				$newItemIn->qty = $preorder_item_mapping->actual_qty;
				$newItemIn->save();

				$newOpname = new opname();
				$newOpname->item_mapping_id = $newItemMappings->id;
				$newOpname->is_opname = 0;
				$newOpname->save();
			} else {
				$newItemIn = new item_in();
				$newItemIn->item_mapping_id = $item_mapping->item_mapping_id;
				$newItemIn->preorder_id = $request->preorder_id;
				$newItemIn->qty = $preorder_item_mapping->actual_qty;
				$newItemIn->save();

				$oldStock = DB::table('stocks')->find($item_mapping->stock_id);
				$newStock = $oldStock->qty + $preorder_item_mapping->actual_qty;

				$stocks = stock::find($item_mapping->stock_id);
				$stocks->buy_price = $preorder_item_mapping->price;
				$stocks->qty = $newStock;
				$stocks->save();

				$opnames = opname::where('item_mapping_id', $item_mapping->item_mapping_id)->first();
				$opnames->qty = NULL;
				$opnames->is_opname = 0;
				$opnames->save();
			}
		}

		$preorder = preorder::find($request->preorder_id);
		$preorder->verify_status = '1';
		$preorder->save();

		return redirect()->route('list-preorders.index');
	}
}
