<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');

Route::get('/user-list', [App\Http\Controllers\adminControls\UserAdminController::class, 'index'])->name('admin.users');
Route::get('/user-list/userDatatable', [App\Http\Controllers\adminControls\UserAdminController::class, 'userDatatable'])->name('admin.users.userDatatable');
