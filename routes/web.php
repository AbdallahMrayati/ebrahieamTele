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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();


Route::group(['middleware' => ['auth']], function () {

    //  dashboard
    Route::get('/dashboard', function () {
        return view('layouts.admin');
    })->name('dashboard');


    // users
    Route::resource('users', UserController::class);
    // Route::get('user/createUser', [UserController::class, 'create'])->name('create-User');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/testPermissions', function () {
    $roleId = 2;

    $role = Role::with('permissions.permissionType')->find($roleId);
    return $role;
});
