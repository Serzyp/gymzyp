<?php

namespace App\Http\Controllers;


use Yajra\DataTables\DataTables;
use App\Models\Exercise;



class ExerciseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {

        return view('tables.myTableConfig', ['codTable' => $id]);
    }

    public function exerciseDatatable($cod){

        return Datatables::of(Exercise::join('day', 'day.id', '=', 'exercise.day_id')
        ->select('exercise.*','day.day','day.moment')
        ->where('exercise.table_id','=',$cod)
        ->get())

            ->make(true);


    }
}
