<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

Route::get('/', [App\http\Controllers\AdminController::class, 'index'])->name('admin.home');
