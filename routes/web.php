<?php

use App\Http\Controllers\UserController;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermissionType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();


Route::group(['middleware' => ['auth']], function () {

    //  dashboard
    Route::get('/', function () {
        return view('layouts.admin');
    })->name('dashboard');

    // users
    Route::resource('admin/users', UserController::class);
    Route::post('admin/user/{id}/update-state', [UserController::class, 'updateUserState'])->name('updateUserState');
    Route::get('admin/users/permissionsUserPage/{id}', [UserController::class, 'permissionsUserPage'])->name('permissionsUserPage');
    Route::post('admin/users/changePermissions/{id}', [UserController::class, 'changePermissions'])->name('changePermissions');

    Route::post('/user/{id}/reset-password', [UserController::class, 'resetPassword'])->name('resetPassword');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
