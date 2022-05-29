<?php

namespace App\Http\Controllers\adminControls;

use App\Models\User;


use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

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

    public function userDatatable(){
        if (request()->ajax()) {
            return Datatables::of(User::all())
            ->addIndexColumn()
            ->make(true);
        }

    }


}
