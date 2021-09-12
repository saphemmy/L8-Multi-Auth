<?php

use Illuminate\Support\Facades\Route;
use App\Models\Admin;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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
Route::prefix('admin')->group(function () {

    Route::get('login', [AdminController::class, 'login'])->name('adminlogin');

    Route::post('login', [AdminController::class, 'authenticate'])->name('postadminlogin');

    Route::post('logout', [AdminController::class, 'logout'])->name('adminLogout');
});



Route::get('/approval', [HomeController::class, 'approval'])->name('approval');





Auth::routes();

Route::get('/admin/home', [AdminController::class, 'index'])->name('adminhome');

Route::middleware(['approved'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});




