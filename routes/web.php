<?php

use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Middleware\isAdmin;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/detail', [HomeController::class, 'detail'])->name('detail');




Route::get('/admin/login', function () {
    return view('admin.adminloginform');
})->name('login');


Route::post('/admin/login', [UserController::class, 'adminLogin'])->name('adminLogin');

Route::middleware(['isAdmin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/user/add', function () {
        return view('user.addUser');
    })->name('user.add');
    Route::post('/user/added', [UserController::class, 'addUser'])->name('user.added');

    Route::get('/user/show', [UserController::class, 'showUser'])->name('user.show');
    Route::get('/user/{id}/edit', [UserController::class, 'editUser'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'deleteUser'])->name('user.delete');


});
