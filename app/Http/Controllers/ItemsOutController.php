<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\item_out;

class ItemsOutController extends Controller
{
	public function getLengthCategory(Request $request) {
		$data = DB::table('item_mappings')
		->join('items', 'item_mappings.item_id', '=', 'items.id')
		->join('stocks', 'item_mappings.stock_id', '=', 'stocks.id')
		->join('lengths', 'stocks.length_id', '=', 'lengths.id')
		->join('thicks', 'stocks.thick_id', '=', 'thicks.id')
		->where('item_mappings.item_id', '=', $request->item_id)
		->get();

		return response()->json($data);
	}

	public function getActualLength(Request $request) {
		$data = DB::table('item_mappings')
		->join('items', 'item_mappings.item_id', '=', 'items.id')
		->join('stocks', 'item_mappings.stock_id', '=', 'stocks.id')
		->join('lengths', 'stocks.length_id', '=', 'lengths.id')
		->join('thicks', 'stocks.thick_id', '=', 'thicks.id')
		->where('item_mappings.item_id', '=', $request->item_id)
		->where('stocks.length_id', '=', $request->length_id)
		->get();

		return response()->json($data);
	}

	public function getThickCategory(Request $request) {
		$data = DB::table('item_mappings')
		->join('items', 'item_mappings.item_id', '=', 'items.id')
		->join('stocks', 'item_mappings.stock_id', '=', 'stocks.id')
		->join('lengths', 'stocks.length_id', '=', 'lengths.id')
		->join('thicks', 'stocks.thick_id', '=', 'thicks.id')
		->where('item_mappings.item_id', '=', $request->item_id)
		->where('stocks.length_id', '=', $request->length_id)
		->where('stocks.actual_length', '=', $request->actual_length)
		->get();

		return response()->json($data);
	}

	public function getQuantity(Request $request) {
		$data = DB::table('item_mappings')
		->join('items', 'item_mappings.item_id', '=', 'items.id')
		->join('stocks', 'item_mappings.stock_id', '=', 'stocks.id')
		->join('lengths', 'stocks.length_id', '=', 'lengths.id')
		->join('thicks', 'stocks.thick_id', '=', 'thicks.id')
		->where('item_mappings.item_id', '=', $request->item_id)
		->where('stocks.length_id', '=', $request->length_id)
		->where('stocks.actual_length', '=', $request->actual_length)
		->where('stocks.thick_id', '=', $request->thick_id)
		->get();

		return response()->json($data);
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$itemsOut = DB::table('item_outs')
		->join('item_mappings', 'item_outs.item_mapping_id', '=', 'item_mappings.id')
		->join('items', 'item_mappings.item_id', '=', 'items.id')
		->join('stocks', 'item_mappings.stock_id', '=', 'stocks.id')
		->join('lengths', 'stocks.length_id', '=', 'lengths.id')
		->join('thicks', 'stocks.thick_id', '=', 'thicks.id')
		->join('projects', 'item_outs.project_id', '=', 'projects.id')
		->select('items.name', 'lengths.upper_length', 'lengths.lower_length', 'thicks.thick', 'stocks.actual_length', 'item_outs.qty', 'item_outs.created_at', 'projects.name as project_name')
		->get();
        return view('stock_management.items_out.index', compact('itemsOut'));
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

        return view('stock_management.items_out.create', compact('items', 'length_categories', 'thick_categories', 'projects'));
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
			// 'length_id' => 'required',
			// 'length' => 'required',
			// 'thick_id' => 'required',
			'qty' => 'required'
		]);

		if(isset($request->length_id)) {
			$item_mapping = DB::table('item_mappings')
			->join('items', 'item_mappings.item_id', '=', 'items.id')
			->join('stocks', 'item_mappings.stock_id', '=', 'stocks.id')
			->join('lengths', 'stocks.length_id', '=', 'lengths.id')
			->join('thicks', 'stocks.thick_id', '=', 'thicks.id')
			->where('items.id', '=', $request->name)
			->where('stocks.length_id', '=', $request->length_id)
			->where('stocks.actual_length', '=', $request->length)
			->where('stocks.thick_id', '=', $request->thick_id)
			->select('items.*', 'stocks.*', 'lengths.*', 'thicks.*', 'item_mappings.*', 'item_mappings.id as item_mapping_id')
			->first();
			
			$newItemOut = new item_out();
			$newItemOut->project_id = $request->project_id;
			$newItemOut->item_mapping_id = $item_mapping->item_mapping_id;
			$newItemOut->qty = $request->qty;
			if($request->information != NULL) {
				$newItemOut->information = $request->information;
			}
			$newItemOut->save();
		} else {
			$item_mapping = DB::table('item_mappings')
			->join('items', 'item_mappings.item_id', '=', 'items.id')
			->leftjoin('stocks', 'item_mappings.stock_id', '=', 'stocks.id')
			->where('items.id', '=', $request->name)
			->first();

			$newItemOut = new item_out();
			$newItemOut->project_id = $request->project_id;
			$newItemOut->item_mapping_id = $item_mapping->item_mapping_id;
			$newItemOut->qty = $request->qty;
			if($request->information != NULL) {
				$newItemOut->information = $request->information;
			}
			$newItemOut->save();
		}

		$oldStock = DB::table('stocks')->find($item_mapping->stock_id);
		$newStock = $oldStock->qty - $request->qty;
		DB::table('stocks')
		->where('stocks.id', '=', $item_mapping->stock_id)
		->update(['qty' => $newStock]);

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
