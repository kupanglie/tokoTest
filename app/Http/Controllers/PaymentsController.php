<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\payment;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** 
            O => Empty Space
            X => Wall
            1 => Gunman
        **/
        $room = 
        [
            ['O', 'X', 'O', 'X', 'O', 'X', 'O', 'X'],
            ['O', 'O', 'O', 'O', 'O', 'X', 'O', 'O'],
            ['X', 'O', 'X', 'O', 'O', 'X', 'O', 'X'],
            ['O', 'O', 'O', 'O', 'O', 'O', 'O', 'O'],
            ['O', 'X', 'O', 'X', 'O', 'X', 'O', 'X'],
            ['O', 'O', 'O', 'X', 'O', 'O', 'O', 'O'],
            ['O', 'X', 'O', 'O', 'O', 'O', 'O', 'O'],
            ['O', 'O', 'O', 'O', 'X', 'O', 'X', 'O'],
        ];        

        $room_edited = $room;

        public function checkRowToRight($i, $j)
        {
            if($room_edited[$i][$j+1] == 'X') {
                checkColumnToBottom()
            }
        }

        for ($i=0; $i < count($room_edited); $i++) { 
            for ($j=0; $j < count($room_edited[$i]); $j++) { 
                // Check place right now
                if($i == 0) {
                    if($j == 0){
                        if($room_edited[$i][$j] == 'O') {
                            checkRowToRight($i, $j);
                        }
                    }
                }
            }
        }

        return view('welcome', compact('room'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = DB::table('projects')->get();

        return view('project.payments.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newPayment = new payment();
        $newPayment->project_id = $request->project_id;
        $newPayment->payment_value = $request->payment_amount;
        $newPayment->payer_name = $request->payer_name;
        $newPayment->reciever_name = $request->reciever_name;
        $newPayment->save();

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
