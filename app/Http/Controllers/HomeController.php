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

    // El motivo por el cual se ha obtado por la opción de tener las tablas dividias en diferentes funciones ha sido por temas de carga de datos
    // Al cargar 4 veces las mismas tablas en pruebas no genera problemas, sin embargo, si tenemos más de 50000 tablas esta página sería lenta,
    // ya que estariamos saturando la página de información que no se visualizaria y estaria oculta pero aun así estaría siendo cargada cada vez que recargasemos o interactuasemos en la página.

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Versión 1 parecida a la dos quitando tableAll y tableLikesUser ---- CANCELADA por que la impresión que daba a los usuarios era agobiante con 4 tablas visualizandose a la vez

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////// VERSION 2 //////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // $idUser = Auth()->user()->id;
        // $tableAll = Table::orderBy('id')->paginate(5,['*'],'tableAll');
        // $tableNewest = Table::orderBy('created_at','desc')->where('paid_mode','0')->paginate(5,['*'],'tableNewest');
        // $tablePremium = Table::where('paid_mode','1')->paginate(5,['*'],'tablePremium');
        // $tableLikes = Table::join('likes', 'likes.table_id', '=', 'table_exercises.id')
        //                 ->selectRaw('table_exercises.* , count(likes.id) as likeCount')
        //                 ->where('paid_mode','0')
        //                 ->groupBy('id','user_id','name','image_path','description','created_at','updated_at','paid_mode')
        //                 ->orderBy('likeCount','desc')
        //                 ->paginate(5,['*'],'tableLikes');

        // $tableComments = Table::join('comments', 'comments.table_id', '=', 'table_exercises.id')
        //                     ->selectRaw('table_exercises.* , count(comments.id) as commentCount')
        //                     ->where('paid_mode','0')
        //                     ->groupBy('id','user_id','name','image_path','description','created_at','updated_at','paid_mode')
        //                     ->orderBy('commentCount','desc')
        //                     ->paginate(5,['*'],'tableComments');

        // $tableLikesUser = Table::join('likes', 'likes.table_id', '=', 'table_exercises.id')
        //                     ->selectRaw('table_exercises.* , count(likes.id) as likeCount')
        //                     ->where('likes.user_id',$idUser)
        //                     ->groupBy('id','user_id','name','image_path','description','created_at','updated_at','paid_mode')
        //                     ->orderBy('likeCount','desc')
        //                     ->paginate(5,['*'],'tableLikesUser');
        // return view('homeV2',compact('tableAll','tableNewest','tablePremium','tableLikes','tableComments','tableLikesUser'));

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////// VERSION 3 //////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $tableView = Table::orderBy('id')->paginate(5);
        return view('homeV3',compact('tableView'));
    }


    public function indexNewest()
    {
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////// VERSION 3 //////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $tableView = Table::orderBy('created_at','desc')->where('paid_mode','0')->paginate(5);
        $type = 'new';
        return view('homeV3',compact('tableView'));
    }


    public function indexComment()
    {
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////// VERSION 3 //////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $tableView = Table::join('comments', 'comments.table_id', '=', 'table_exercises.id')
                        ->selectRaw('table_exercises.* , count(comments.id) as commentCount')
                        ->where('paid_mode','0')
                        ->groupBy('id','user_id','name','image_path','description','created_at','updated_at','paid_mode')
                        ->orderBy('commentCount','desc')
                        ->paginate(5);
        return view('homeV3',compact('tableView'));
    }

    public function indexLike()
    {
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////// VERSION 3 //////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $tableView = Table::join('likes', 'likes.table_id', '=', 'table_exercises.id')
                        ->selectRaw('table_exercises.* , count(likes.id) as likeCount')
                        ->where('paid_mode','0')
                        ->groupBy('id','user_id','name','image_path','description','created_at','updated_at','paid_mode')
                        ->orderBy('likeCount','desc')
                        ->paginate(5,['*'],'tableLikes');
        return view('homeV3',compact('tableView'));
    }

    public function indexPremium()
    {
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////// VERSION 3 //////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $tableView = Table::where('paid_mode','1')->paginate(5);
        return view('homeV3',compact('tableView'));
    }

    public function indexLikeUser()
    {
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////// VERSION 3 //////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $idUser = Auth()->user()->id;

        $tableView = Table::join('likes', 'likes.table_id', '=', 'table_exercises.id')
                        ->select('table_exercises.*')
                        ->where('likes.user_id',$idUser)
                        ->paginate(5);
        return view('homeV3',compact('tableView'));
    }
}
