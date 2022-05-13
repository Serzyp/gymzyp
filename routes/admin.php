<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [App\http\Controllers\AdminController::class, 'index'])->name('admin.home');

Route::get('/user-list', [App\http\Controllers\adminControls\UserAdminController::class, 'index'])->name('admin.users');
