<?php

use Illuminate\Support\Facades\Route;

//INDEX
Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');

//USER LIST
Route::get('/user-list', [App\Http\Controllers\adminControls\UserAdminController::class, 'index'])->name('admin.users');
Route::get('/user-list/userDatatable', [App\Http\Controllers\adminControls\UserAdminController::class, 'userDatatable'])->name('admin.users.userDatatable');

//PERMISOS
Route::get('/permissions', [App\Http\Controllers\adminControls\PermissionAdminController::class, 'index'])->name('admin.permissions');
Route::get('/permissions/getDatatable', [App\Http\Controllers\adminControls\PermissionAdminController::class, 'getDatatable'])->name('admin.permissions.getDatatable');
Route::post('/permissions/store', [App\Http\Controllers\adminControls\PermissionAdminController::class, 'store'])->name('admin.permissions.store');
Route::get('/permissions/edit/{id}', [App\Http\Controllers\adminControls\PermissionAdminController::class, 'edit'])->name('admin.permissions.edit');
