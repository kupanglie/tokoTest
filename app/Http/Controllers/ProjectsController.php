<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\project;
use App\work_mapping;
use App\estimated_work_mapping;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$projects = DB::table('projects')
					->join('categories', 'projects.category_id', '=', 'categories.id')
					->join('status_projects', 'projects.status_id', '=', 'status_projects.id')
					->select('projects.*', 'categories.*', 'status_projects.*', 'projects.id as project_id', 'categories.desc as category_desc', 'status_projects.desc as status_desc')
					->get();

		$payments = DB::table('payments')->get();

        return view('project.index', compact('projects', 'payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$workers = DB::table('workers')->get();
		$sales = DB::table('sales')->get();
		$categories = DB::table('categories')->get();
		$status_projects = DB::table('status_projects')->get();
		$works = DB::table('works')->get();

        return view('project.create', compact('workers', 'sales', 'categories', 'status_projects', 'works'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		// dd($request);
		$this->validate($request, [
			'name' => 'required',
			'address' => 'required',
			'sales' => 'required',
			'status_project' => 'required',
			'estimated_work_id' => 'required',
			'estimated_qty' => 'required'
		]);

		$total_qty = 0;
		foreach ($request->estimated_qty as $qty) {
			$total_qty = $total_qty + $qty;
		}

		$categories = DB::table('categories')->get();
		foreach ($categories as $category) {
			if($category->upper_range == NULL) {
				if($total_qty > $category->lower_range) {
					$category_id = $category->id;
				}
			} else if($category->lower_range == NULL) {
				if($total_qty < $category->upper_range) {
					$category_id = $category->id;
				}
			} else {
				$category_id = $category->id;
			}
		}

		$newProject = new project();
		$newProject->name = $request->name;
		$newProject->address = $request->address;
		$newProject->sales_id = $request->sales;
		$newProject->category_id = $category_id;
		$newProject->status_id = $request->status_project;
		$newProject->start_nego = date('Y-m-d');
		$newProject->save();

		for ($i=0;$i<$request->row_count_estimated;$i++) {
			$newWork = new estimated_work_mapping();
			$newWork->project_id = $newProject->id;
			$newWork->work_id = $request->estimated_work_id[$i];
			$newWork->qty = $request->estimated_qty[$i];
			$newWork->area_desc = $request->area_desc[$i];
			$newWork->save();
		}

		return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$project = DB::table('projects')
					->where('id', $id)
					->first();

		$estimated_works = DB::table('estimated_work_mappings')
							->join('works', 'works.id', '=', 'estimated_work_mappings.work_id')
							->where('estimated_work_mappings.project_id', $id)
							->orderBy('work_id', 'asc')
							->get();

		$total_estimated_work_qty = 0;
		$total_estimated_work_qty_run = 0;
		foreach($estimated_works as $estimated_work) {
			if(strpos($estimated_work->name, 'drop celling') !== false) {
				$total_estimated_work_qty_run = $total_estimated_work_qty_run + $estimated_work->qty;
			} else {
				$total_estimated_work_qty = $total_estimated_work_qty + $estimated_work->qty;
			}
		}

		$real_works = DB::table('work_mappings')
							->join('works', 'works.id', '=', 'work_mappings.work_id')
							->where('work_mappings.project_id', $id)
							->orderBy('work_id', 'asc')
							->get();

		$total_real_work_qty = 0;
		$total_real_work_qty_run = 0;
		foreach($real_works as $real_work) {
			if(strpos($real_work->name, 'drop celling') !== false) {
				$total_real_work_qty_run = $total_real_work_qty_run + $real_work->qty;
			} else {
				$total_real_work_qty = $total_real_work_qty + $real_work->qty;
			}
		}

		$items_out = DB::table('item_outs')
						->join('item_mappings', 'item_mappings.id', '=', 'item_outs.item_mapping_id')
						->join('items', 'items.id', '=', 'item_mappings.item_id')
						->leftjoin('stocks', 'stocks.id', '=', 'item_mappings.stock_id')
						->select('item_outs.*', 'item_outs.qty as item_out_qty', 'item_mappings.*', 'items.*', 'stocks.*')
						->where('item_outs.project_id', $id)
						->get();

		$total_items_out = 0;
		foreach($items_out as $item_out) {
			if(substr($item_out->name, 0, 3) == 'UP-' || substr($item_out->name, 0, 3) == 'LU-' || substr($item_out->name, 0, 3) == 'LK-' || substr($item_out->name, 0, 3) == 'LH-' || substr($item_out->name, 0, 3) == 'LJ-' ) {
				$total_items_out = $total_items_out + ($item_out->item_out_qty * $item_out->actual_length * 0.2);
			}
		}

		$items_in = DB::table('item_ins')
						->join('item_mappings', 'item_mappings.id', '=', 'item_ins.item_mapping_id')
						->join('items', 'items.id', '=', 'item_mappings.item_id')
						->leftjoin('stocks', 'stocks.id', '=', 'item_mappings.stock_id')
						->select('item_ins.*', 'item_ins.qty as item_in_qty', 'item_mappings.*', 'items.*', 'stocks.*')
						->where('item_ins.project_id', $id)
						->get();

		$total_items_in = 0;
		foreach($items_in as $item_in) {
			if(substr($item_in->name, 0, 3) == 'UP-' || substr($item_in->name, 0, 3) == 'LU-' || substr($item_in->name, 0, 3) == 'LK-' || substr($item_in->name, 0, 3) == 'LH-' || substr($item_in->name, 0, 3) == 'LJ-') {
				$total_items_in = $total_items_in + ($item_in->item_in_qty * $item_in->actual_length * 0.2);
			}
		}

		$total_items_used = $total_items_out - $total_items_in;

		$items_used = [];
		foreach($items_out as $item_out) {
			foreach($items_in as $item_in) {
				if($item_out->item_id == $item_in->item_id) {
					$item_out->item_qty = $item_out->item_out_qty - $item_in->item_in_qty;
					array_push($items_used, $item_out);
				}
			}
		}

		$support_items = DB::table('support_items')
							->where('support_items.project_id', $id)
							->get();

		$extra_costs = DB::table('etc_items')
							->where('etc_items.project_id', $id)
							->get();

		$payments = DB::table('payments')
						->where('payments.project_id', $id)
						->get();					
		// dd($project);
        return view('project.show', compact('project', 'estimated_works', 'real_works', 'items_out', 'items_in', 'total_estimated_work_qty', 'total_estimated_work_qty_run', 'total_real_work_qty', 'total_real_work_qty_run', 'total_items_used', 'items_used', 'support_items', 'extra_costs', 'payments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$workers = DB::table('workers')->get();
		$sales = DB::table('sales')->get();
		$categories = DB::table('categories')->get();
		$status_projects = DB::table('status_projects')->get();
		$works = DB::table('works')->get();
		$estimated_work_mappings = DB::table('estimated_work_mappings')
									->where('estimated_work_mappings.project_id', $id)
									->get();
		$work_mappings = DB::table('work_mappings')
							->where('work_mappings.project_id', $id)
							->get();
		$project = DB::table('projects')
					->where('projects.id', $id)
					->first();

		return view('project.edit', compact('workers', 'sales', 'categories', 'status_projects', 'works', 'estimated_work_mappings', 'work_mappings', 'project'));
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
		$this->validate($request, [
			'name' => 'required',
			'address' => 'required',
			'sales' => 'required',
			'status_project' => 'required',
			'estimated_work_id' => 'required',
			'estimated_qty' => 'required',
			// 'real_work_id' => 'required',
			// 'real_qty' => 'required',
		]);

		$total_qty = 0;
		foreach ($request->estimated_qty as $qty) {
			$total_qty = $total_qty + $qty;
		}

		$categories = DB::table('categories')->get();
		foreach ($categories as $category) {
			if($category->upper_range == NULL) {
				if($total_qty > $category->lower_range) {
					$category_id = $category->id;
				}
			} else if($category->lower_range == NULL) {
				if($total_qty < $category->upper_range) {
					$category_id = $category->id;
				}
			} else {
				$category_id = $category->id;
			}
		}

		$newProject = project::find($id);
		$newProject->name = $request->name;
		$newProject->address = $request->address;
		$newProject->sales_id = $request->sales;
		$newProject->category_id = $category_id;
		$newProject->status_id = $request->status_project;
		$newProject->end_nego = $request->end_negotiation;
		$newProject->work_plan = $request->work_plan;
		$newProject->start_working = $request->start_working;
		$end_working_date = strtotime("+".$request->work_plan." days", strtotime($request->start_working));
		$newProject->end_working = date("Y-m-d", $end_working_date);
		$newProject->start_nego = date('Y-m-d');
		$newProject->save();

		$old_estimated_work = estimated_work_mapping::where('project_id', $id)->delete();
		for ($i=0;$i<$request->row_count_estimated;$i++) {
			$newWork = new estimated_work_mapping();
			$newWork->project_id = $newProject->id;
			$newWork->work_id = $request->estimated_work_id[$i];
			$newWork->qty = $request->estimated_qty[$i];
			$newWork->area_desc = $request->estimated_area_desc[$i];
			$newWork->save();
		}

		$old_real_work = work_mapping::where('project_id', $id)->delete();
		for ($i=0;$i<$request->row_count_real;$i++) {
			$newWork = new work_mapping();
			$newWork->project_id = $newProject->id;
			$newWork->work_id = $request->real_work_id[$i];
			$newWork->qty = $request->real_qty[$i];
			$newWork->area_desc = $request->real_area_desc[$i];
			$newWork->save();
		}

		return redirect()->route('projects.index');
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

    public function postOpnameProject(Request $request)
    {
    	$updateProject = project::find($request->project_id);
    	$updateProject->payment_value = $request->payment_value;
		$updateProject->cost_value = $request->cost_value;
		$updateProject->profit = $request->profit;
		$updateProject->omset_sales = $request->omset_sales;
		$updateProject->opname_is = 1;
    	$updateProject->save();
    	
    	return redirect()->route('projects.index');
    }
}
