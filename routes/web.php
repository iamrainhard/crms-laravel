<?php

use App\Http\Controllers\ChurchController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\FinanceRecordController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return redirect('/dashboard');
});


Auth::routes();
Route::get('/register', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//json routes
Route::post('/get-church-by-region', [\App\Http\Controllers\UserController::class, 'getChurch']);
Route::get('/users/{user}/delete',  [\App\Http\Controllers\UserController::class, 'destroy']);
Route::get('/profile',  [\App\Http\Controllers\UserController::class, 'profile']);
Route::put('/profile/{id}',  [\App\Http\Controllers\UserController::class, 'updateProfile']);
Route::get('/churches/{church}/delete',  [\App\Http\Controllers\ChurchController::class, 'destroy']);
Route::get('/finances/{finance}/delete',  [\App\Http\Controllers\FinanceController::class, 'destroy']);
Route::get('/records/{record}/delete',  [\App\Http\Controllers\FinanceRecordController::class, 'destroy']);

Route::resources([
    'users' => UserController::class,
    'churches' => ChurchController::class,
    'members' => MemberController::class,
    'finances' => FinanceController::class,
    'records' => FinanceRecordController::class,
]);
