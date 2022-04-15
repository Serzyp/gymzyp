<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/set_language/{lang}', [App\Http\Controllers\Controller::class, 'set_language'])->name('set_language');

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
        $userNew = User::create([
            'name' => $user->name,
            'nick' => $user->nickname,
            'email' => $user->email,
            'external_id' => $user->id,
            'external_auth' => 'google',
        ]);

        Auth::login(($userNew));
    }

    return redirect()->route('home');
    // $user->token
});

Route::get('/admin', [App\http\Controllers\AdminController::class, 'index'])->name('admin.home');
