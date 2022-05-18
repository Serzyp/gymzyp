<?php

namespace App\Http\Controllers;


use App\Models\Table;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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

    public function save(Request $request)
    {
   		// Validación
		$validate = $this->validate($request, [
			'table_id' => 'integer|required',
			'content' => 'string|required'
		]);

		// Recoger datos
		$user = Auth::user();
		$table_id = $request->input('table_id');
		$content = $request->input('content');

		// Asigno los valores a mi nuevo objeto a guardar
		$comment = new Comment();
		$comment->user_id = $user->id;
		$comment->table_id = $table_id;
		$comment->content = $content;

		// Guardar en la bd
		$comment->save();

		// Redirección
		return redirect()->route('table.exercises', ['id' => $table_id])
						 ->with([
							'message' => 'Has publicado tu comentario correctamente!!'
						 ]);
	}

	public function delete($id){
		// Conseguir datos del usuario logueado
		$user = Auth::user();

		// Conseguir objeto del comentario
		$comment = Comment::find($id);

		// Comprobar si soy el dueño del comentario o de la publicación
		if($user && ($comment->user_id == $user->id || $comment->table->user_id == $user->id)){
			$comment->delete();

			return redirect()->route('table.exercises', ['id' => $comment->table->id])
						 ->with([
							'message' => 'Comentario eliminado correctamente!!'
						 ]);
		}else{
			return redirect()->route('table.exercises', ['id' => $comment->table->id])
						 ->with([
							'message' => 'EL COMENTARIO NO SE HA ELIMINADO!!'
						 ]);
		}
	}
}
