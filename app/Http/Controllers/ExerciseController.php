<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Table;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



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
        $table = Table::find($id);
        $days = Day::all();
        return view('tables.myTableConfig', ['codTable' => $id, 'table' => $table, 'days' => $days]);
    }

    public function exerciseDatatable($cod){
        if (request()->ajax()) {
            return Datatables::of(Exercise::join('day', 'day.id', '=', 'exercise.day_id')
            ->select('exercise.*','day.day','day.moment')
            ->where('exercise.table_id','=',$cod)
            ->orderby('day.id')
            ->get())
            ->addIndexColumn()
            ->addColumn('Actions', function ($row) {


                $btn = '<a href="javascript:void(0)" data-idexercise='.$row->id.' class="edit btn btn-primary btn-sm editExercise"><i class="fas fa-edit"></i></a>
                <a href="javascript:void(0)" data-idexercise='.$row->id.' class="btn btn-danger btn-sm deleteExercise"><i class="fas fa-minus-square"></i></a>';

                return $btn;
            })
            ->addColumn('details', function () {
                return null;
            })

            ->addColumn('headerButtons', function ($row) {

                $header = '';

                // $header .= '&nbsp;&nbsp;<a class="btn btn-success btn-sm createNewExercise" href="javascript:void(0)"> <i class="fas fa-plus"></i></a>';

                // $header .= '&nbsp;&nbsp;<a class="edit btn btn-primary btn-sm editDay"  href="javascript:void(0)" ><i class="fas fa-pen"></i></a>';

                // $header .= '&nbsp;&nbsp;<a href="javascript:void(0)"  class="btn btn-danger btn-sm deleteDay"><i class="fas fa-trash-alt"></i></a>';

                $header .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

                $header .= $row->day.' - '.$row->moment;

                return $header;
            })
            ->rawColumns(['Actions', 'details', 'headerButtons'])
            ->make(true);
        }

    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'id' => 'nullable',
            'table_id' => 'nullable',
            'day_id' => 'required',
            'content' => 'required',
            'sets' => 'required',
            'reps' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => 0, 'validation_error' => $validator->errors()->toArray()]);
        } else {

            /**
             * La validación tiene X campos, si necesito otro más, debo meterla a otra variable
             */
            $data = $validator->validated();

            try {
                DB::beginTransaction();


                $exercise = Exercise::updateOrCreate(
                    ['id' => $request->id],$data
                );

                //updateOrCreate hace un update
                if (!$exercise->wasRecentlyCreated && $exercise->wasChanged()) {

                    DB::commit();
                    return response()->json(['submit_store_success' => 'Exercise updated successfully']);
                }
                //updateOrCreate hace update sin realizar cambios
                else if (!$exercise->wasRecentlyCreated && !$exercise->wasChanged()) {

                    DB::commit();
                    return response()->json(['submit_store_success' => 'Exercise not changed']);
                }
                //updateOrCreate hace create
                else if ($exercise->wasRecentlyCreated) {
                    DB::commit();
                    return response()->json(['submit_store_success' => 'Exercise created successfully']);
                }
            }
            //Error sentencia SQL
            catch (\Exception $myException) {
                DB::rollback();

                return response()->json(['submit_store_error' =>json_encode($myException)]);
            }
        }
    }

    public function edit($id){

        if (request()->ajax()) {
            return response()->json(
                ['exercise' => Exercise::find($id)]
            );
        }

    }

    public function destroy($id){
        try {
            DB::beginTransaction();
            Exercise::findOrFail($id)->delete();

            DB::commit();
            return response()->json(['submit_delete_success' => 'Exercise deleted successfully.']);
        } catch (\Exception $myException) {
            DB::rollback();

            return response()->json(['submit_delete_error' =>json_encode($myException)]);
        }

    }

}
