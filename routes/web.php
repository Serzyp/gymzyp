<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//Vista Inicio con todas las tablas
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Vista Inicio con todas las tablas ordenadas de más reciente a más antiguas
Route::get('/newTables', [App\Http\Controllers\HomeController::class, 'indexNewest'])->name('home.new');

//Vista Inicio con todas las tablas comentadas de más comentarios a menos
Route::get('/commentTables', [App\Http\Controllers\HomeController::class, 'indexComment'])->name('home.comment');

//Vista Inicio con todas las tablas con likes de más likes a menos
Route::get('/likeTables', [App\Http\Controllers\HomeController::class, 'indexLike'])->name('home.like');

//Vista Inicio con todas las tablas premium
Route::get('/premiumTables', [App\Http\Controllers\HomeController::class, 'indexPremium'])->name('home.premium');

//Vista Inicio con todas las tablas a las que el usuario ha dado like
Route::get('/userLikeTables', [App\Http\Controllers\HomeController::class, 'indexLikeUser'])->name('home.userlike');


//Selecttor de lenguaje
Route::get('/set_language/{lang}', [App\Http\Controllers\Controller::class, 'set_language'])->name('set_language');


//Configuración de usuario
Route::get('/config', [App\Http\Controllers\UserController::class, 'config'])->name('config');
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::get('/user/avatar/{filename}', [App\Http\Controllers\UserController::class, 'getImage'])->name('user.avatar');

//Login con GOOGLE

Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
})->name('loginGoogle');

Route::get('/google-callback', function () {
    $user = Socialite::driver('google')->user();

    $userExists = User::where('external_id',$user->id)->where('external_auth', 'google')->first();

    if($userExists){
        Auth::login(($userExists));
    }else{

        $emailuserExists = User::where('email',$user->email)->first();

        if(!$emailuserExists){

            $userNew = User::create([
                'name' => $user->name,
                'nick' => $user->nickname,
                'email' => $user->email,
                'external_id' => $user->id,
                'external_auth' => 'google',
            ]);

            Auth::login(($userNew));
        }
    }

    return redirect()->route('home');
    // $user->token
});



//Vista para las mis tablas

Route::resource('myTables',App\Http\Controllers\TableController::class)->names('table');
Route::get('/myTables/image/{filename}', [App\Http\Controllers\TableController::class, 'getImage'])->name('table.image');


//Vista de una tabla con los ejercicios y los dias
Route::get('/table/exerciseDatatable/{cod}', [App\Http\Controllers\ExerciseController::class, 'exerciseDatatable'])->name('table.exerciseDatatable');
Route::get('/myTable/{id}', [App\Http\Controllers\ExerciseController::class, 'index'])->name('table.exercises');
Route::post('/table/save', [App\Http\Controllers\ExerciseController::class, 'store'])->name('exercises.store');
Route::get('/table/edit/{id}', [App\Http\Controllers\ExerciseController::class, 'edit'])->name('exercises.edit');
Route::delete('/table/destroy/{id}', [App\Http\Controllers\ExerciseController::class, 'destroy'])->name('exercises.destroy');


//Sistema de likes

Route::get('/like/{table_id}', [App\Http\Controllers\LikeController::class,'like'])->name('like.save');
Route::get('/dislike/{table_id}', [App\Http\Controllers\LikeController::class,'dislike'])->name('like.delete');
Route::get('/reload/{id}', [App\Http\Controllers\LikeController::class,'reload'])->name('like.reload');

//Sistema de comentarios

Route::post('/comment/save', [App\Http\Controllers\CommentController::class, 'save'])->name('comment.save');
Route::get('/comment/delete/{id}', [App\Http\Controllers\CommentController::class, 'delete'])->name('comment.delete');

//Sistema de pagos

Route::get('/paypal', [App\Http\Controllers\PayPalController::class,'index'])->name('paypal.index');
Route::get('/paypal/completed', [App\Http\Controllers\PayPalController::class,'indexCompleted'])->name('paypal.completed');
Route::get('/paypal/failed', [App\Http\Controllers\PayPalController::class,'indexFailed'])->name('paypal.failed');

Route::get('/paypal/process/{order_id}', [App\Http\Controllers\PayPalController::class,'process'])->name('paypal.process');

//Vista par ver tablas de otras personas

Route::get('/table/show/{id}',[App\Http\Controllers\TableController::class,'show'])->name('table.show');

//Exportación
Route::post('/export',[App\Http\Controllers\ExcelExportController::class,'table'])->name('table.export');

//Centro de ayuda
Route::get('/info',[App\Http\Controllers\InfoController::class,'index'])->name('info.index');
