<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use App\Models\Table;
use App\Models\Comment;


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

    //Ver vista admin
    public function index(){
        $contUser = User::all()->count();
        $contComment = Comment::all()->count();
        $contLike = Like::all()->count();
        $contTable = Table::all()->count();
        return view('admin.home', compact('contUser','contComment','contLike','contTable'));
    }

}
