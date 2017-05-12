<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\etc_items;

class ExtraCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = DB::table('projects')->get();

        return view('project.extra_cost.create', compact('projects'));
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
            'project_id' => 'required',
            'price' => 'required'
        ]);

        $extra_cost = new etc_items();
        $extra_cost->name = $request->name;
        $extra_cost->project_id = $request->project_id;
        $extra_cost->price = $request->price;
        $extra_cost->save();

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
        $extra_cost = DB::table('etc_items')
                            ->where('etc_items.id', $id)
                            ->first();

        $projects = DB::table('projects')->get();
                            
        return view('project.extra_cost.edit', compact('extra_cost', 'projects'));  
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
            'project_id' => 'required',
            'price' => 'required'
        ]);

        $extra_cost = etc_items::find($id);
        $extra_cost->name = $request->name;
        $extra_cost->project_id = $request->project_id;
        $extra_cost->price = $request->price;
        $extra_cost->save();

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
}
