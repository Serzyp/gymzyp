<?php

namespace App\Http\Controllers;

use App\Models\User;


class AdminController extends Controller
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
    public function index(){
        $contUser = User::all()->count();
        return view('admin.home');
    }
}
