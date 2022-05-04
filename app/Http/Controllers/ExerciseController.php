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
        ->addIndexColumn()
        ->addColumn('Actions', function () {


            $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm editExpenseLin"><i class="fas fa-edit"></i></a>
            <a href="javascript:void(0)"  class="btn btn-danger btn-sm deleteExpenseLin"><i class="fas fa-minus-square"></i></a>';

            return $btn;
        })
        ->addColumn('details', function () {
            return null;
        })
        ->addColumn('header', function () {
            return  " YA ";
        })
        ->addColumn('headerButtons', function () {
            //$header = $data->codExpense;
            $header = "";

                $header .= '&nbsp;&nbsp;<a class="btn btn-success btn-sm createNewExpenseLin" href="javascript:void(0)"> <i class="fas fa-plus"></i></a>';

                $header .= '&nbsp;&nbsp;<a class="edit btn btn-primary btn-sm editExpense"  href="javascript:void(0)" ><i class="fas fa-pen"></i></a>';

                $header .= '&nbsp;&nbsp;<a href="javascript:void(0)" class="link btn btn-warning btn-sm validateExpense"><i class="fas fa-check"></i></a>';

                $header .= '&nbsp;&nbsp;<a href="javascript:void(0)"  class="btn btn-danger btn-sm deleteExpense"><i class="fas fa-trash-alt"></i></a>';
            $header .= '&nbsp;&nbsp;<a class="link btn btn-info btn-sm" target="_blank"><span style="font-size: 1em;"><i class="fas fa-file-pdf"></i></span></a>';
            //$header .= '&nbsp;&nbsp;' . Carbon::parse($data->month_year)->formatLocalized('%B %Y');
            //$header .= '&nbsp;&nbsp;' . $data->validationStatus . " V: " . $data->validator . " D: " . $data->director;

            $header .= '&nbsp;&nbsp;| aaaaaaaaaaaaaaaaaaaaaaaaaa';
            return $header;
        })
        ->rawColumns(['Actions', 'details', 'headerButtons', 'header'])
        ->make(true);


    }
}
