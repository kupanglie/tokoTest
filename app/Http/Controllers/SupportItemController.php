<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\support_items;

class SupportItemController extends Controller
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

        return view('project.support_items.create', compact('projects'));
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
            'qty' => 'required',
            'price' => 'required'
        ]);

        $support_items = new support_items();
        $support_items->name = $request->name;
        $support_items->project_id = $request->project_id;
        $support_items->qty = $request->qty;
        $support_items->price = $request->price;
        $support_items->save();

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
        $support_item = DB::table('support_items')
                            ->where('support_items.id', $id)
                            ->first();

        $projects = DB::table('projects')->get();
                            
        return view('project.support_items.edit', compact('support_item', 'projects'));                    
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
            'qty' => 'required',
            'price' => 'required'
        ]);

        $support_items = support_items::find($id);
        $support_items->name = $request->name;
        $support_items->project_id = $request->project_id;
        $support_items->qty = $request->qty;
        $support_items->price = $request->price;
        $support_items->save();

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
