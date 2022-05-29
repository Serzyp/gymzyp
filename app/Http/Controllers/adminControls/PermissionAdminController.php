<?php

namespace App\Http\Controllers\adminControls;

use App\Models\User;


use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PermissionAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userList = User::all();

        return view('admin.permission',compact('userList'));
    }

    public function getDatatable(){
        if (request()->ajax()) {
            return Datatables::of(User::all())
            ->addIndexColumn()
            ->addColumn('Actions', function ($row) {

                $btn = '<a href="javascript:void(0)" data-iduser='.$row->id.' class="edit btn btn-primary btn-sm editUser">Change role <i class="fas fa-edit"></i></a>';

                return $btn;
            })
            ->rawColumns(['Actions'])
            ->make(true);
        }
    }

    public function edit($id){
        if (request()->ajax()) {
            return response()->json(
                ['user' => User::find($id)]
            );
        }
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'email' => 'required',
            'role' => 'required',
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

                $user = User::updateOrCreate(
                    ['id' => $request->id],$data
                );

                //updateOrCreate hace un update
                if (!$user->wasRecentlyCreated && $user->wasChanged()) {
                    DB::commit();
                    return response()->json(['submit_store_success' => 'User role updated successfully']);

                }
                //updateOrCreate hace update sin realizar cambios
                else if (!$user->wasRecentlyCreated && !$user->wasChanged()) {
                    DB::commit();
                    return response()->json(['submit_store_success' => 'User role not changed']);

                }
                //updateOrCreate hace create
                else if ($user->wasRecentlyCreated) {
                    DB::commit();
                    return response()->json(['submit_store_success' => 'User role created successfully']);

                }
            }
            //Error sentencia SQL
            catch (\Exception $myException) {
                DB::rollback();

                return response()->json(['submit_store_error' =>json_encode($myException)]);
            }
        }
    }



}
