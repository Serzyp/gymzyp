<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
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
    public function reload($id)
    {

        $likes = Like::where('table_id',$id)->count();
        // $table = Table::find($id);

        // // Averiguar cuantos likes tiene la tabla y si el usuaria que esta viendo la pagina ha dado o no like
        // $userlike = false;
        // foreach ($table->likes as $like){
        //     if ($like->user->id == Auth::user()->id){
        //         $userlike = true;
        //     }
        // }

        // if ($userlike){
        //     $prelike = "<a href='javascript:void(0)' class='btn btn-danger dislike' data-id= $id>";
        //     $prelike .= "<i class='fa-solid fa-heart'></i>";
        // }else{
        //     $prelike = "<a href='javascript:void(0)' class='btn btn-danger like' data-id= $id>";
        //     $prelike .= "<i class='fa-regular fa-heart'></i>";
        // }



        return $likes;
    }

    public function like($table_id){
		// Recoger datos del usuario y la imagen
		$user = Auth::user();

		// Condicion para ver si ya existe el like y no duplicarlo
		$isset_like = Like::where('user_id', $user->id)
				            ->where('table_id', $table_id)
							->count();

		if($isset_like == 0){
			$like = new Like();
			$like->user_id = $user->id;
			$like->table_id = (int)$table_id;

			// Guardar
			$like->save();

			return response()->json([
				'like' => $like
			]);
		}else{
			return response()->json([
				'message' => 'El like ya existe'
			]);
		}

	}

	public function dislike($table_id){
		// Recoger datos del usuario y la imagen
		$user = Auth::user();

		// Condicion para ver si ya existe el like y no duplicarlo
		$like = Like::where('user_id', $user->id)
				            ->where('table_id', $table_id)
							->first();

		if($like){

			// Eliminar like
			$like->delete();

			return response()->json([
				'like' => $like,
				'message' => 'Has dado dislike correctamente'
			]);
		}else{
			return response()->json([
				'message' => 'El like no existe'
			]);
		}
	}
}
