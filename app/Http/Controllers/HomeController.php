<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
    public function index()
    {
        $tableNewest = Table::orderBy('created_at','desc')->where('paid_mode','0')->paginate(5,['*'],'tableNewest');

        $tablePremium = Table::where('paid_mode','1')->paginate(5,['*'],'tablePremium');

        $tableLikes = Table::join('likes', 'likes.table_id', '=', 'table_exercises.id')
                        ->selectRaw('table_exercises.* , count(likes.id) as likeCount')
                        ->where('paid_mode','0')
                        ->groupBy('id','user_id','name','image_path','description','created_at','updated_at','paid_mode')
                        ->orderBy('likeCount','desc')
                        ->paginate(5,['*'],'tableLikes');

        $tableComments = Table::join('comments', 'comments.table_id', '=', 'table_exercises.id')
                            ->selectRaw('table_exercises.* , count(comments.id) as commentCount')
                            ->where('paid_mode','0')
                            ->groupBy('id','user_id','name','image_path','description','created_at','updated_at','paid_mode')
                            ->orderBy('commentCount','desc')
                            ->paginate(5,['*'],'tableComments');

        return view('home',compact('tableNewest','tablePremium','tableLikes','tableComments'));
    }
}
