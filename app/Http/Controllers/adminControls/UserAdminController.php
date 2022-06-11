<?php

namespace App\Http\Controllers\adminControls;

use Carbon\Carbon;


use App\Models\User;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class UserAdminController extends Controller
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

        return view('admin.userList',compact('userList'));
    }


    // Funcion para mostrar Datatables
    public function userDatatable(){
        if (request()->ajax()) {
            return Datatables::of(User::all())
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                $created = Carbon::parse($row->created_at)->formatLocalized('%d %B %Y');
                return $created;
            })
            ->editColumn('updated_at', function ($row) {
                $updated = Carbon::parse($row->updated_at)->formatLocalized('%d %B %Y');
                return $updated;
            })
            ->make(true);
        }
    }


}
