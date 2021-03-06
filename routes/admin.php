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

//PAYMENTS
Route::get('/payments', [App\Http\Controllers\adminControls\PaymentsAdminController::class, 'index'])->name('admin.payments');
Route::get('/payments/getDatatable', [App\Http\Controllers\adminControls\PaymentsAdminController::class, 'getDatatable'])->name('admin.payments.getDatatable');

//EXPORTACIÓN
Route::post('/export',[App\Http\Controllers\ExcelExportController::class,'user'])->name('admin.user.export');
Route::post('/exportPayments',[App\Http\Controllers\ExcelExportController::class,'payment'])->name('admin.payment.export');
