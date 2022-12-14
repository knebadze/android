<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Observer\PageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Interviewer\InterviewerPageController;

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

Route::get('/', function () {
    return view('welcome');
});




Route::get('/admin/index', function () {
    return view('admin/index');
})->middleware(['auth', 'role:admin'])->name('dashboard');



Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function(){
    Route::get('/',[IndexController::class, 'index'])->name('index');
    Route::resource('/roles', RoleController::class);
    Route::post('/roles/{role}/permissions',[RoleController::class, 'givePermission'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}',[RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');

    Route::resource('/permissions', PermissionController::class);
    Route::post('/permission/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.role');
    Route::delete('/permission/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove');

    Route::get('/users',[UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{user}',[UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.role');
    Route::delete('/users/{user}/roles/{role}', [UserController::class, 'RemoveRole'])->name('users.roles.remove');
    Route::post('/users/{user}/permissions', [UserController::class, 'givePermission'])->name('users.permissions');
    Route::delete('/users/{user}/permissions/{permission}', [UserController::class, 'RevokePermission'])->name('users.permissions.revoke');
    // Route::post('/store')
});


Route::middleware(['auth', 'role:observer'])->group(function(){
    Route::get('observer/index',[PageController::class, 'index'])->name('observer.index');
    Route::get('observer/map',[PageController::class, 'map'])->name('observer.map');
});

Route::middleware(['auth', 'role:interviewer'])->group(function(){
    Route::get('interviewer/index',[InterviewerPageController::class, 'index'])->name('interviewer.index');
    // Route::get('observer/map',[PageController::class, 'map'])->name('observer.map');
});



require __DIR__.'/auth.php';
