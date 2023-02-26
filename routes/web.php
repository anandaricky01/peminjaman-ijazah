<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WebcamController;
use App\Http\Controllers\Master\MasterController;
use Illuminate\Http\Request;

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
    return view('admin/login');
});

Route::get('register', [RegisterController::class, 'index'])->name('index');
Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::get('login', [LoginController::class, 'index'])->name('index');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('index', [StudentController::class, 'dashboard']);

Route::get('student', [StudentController::class, 'index']);
Route::get('student-add', [StudentController::class, 'create']);
Route::post('students', [StudentController::class, 'store']);
Route::get('student/{id}/edit', [StudentController::class, 'edit']);
Route::put('student/{id}', [StudentController::class, 'update']);
Route::delete('student/{id}', [StudentController::class, 'destroy']);

Route::get('main', function () {
    return view('admin/layouts/main');
});

Route::get('/master', [MasterController::class, 'index']);
Route::post('/master', [MasterController::class, 'checkNim']);
Route::post('/second', [MasterController::class, 'secondPage']);
Route::post('/third', [MasterController::class, 'dataPeminjam']);
Route::post('/tri', [MasterController::class, 'liatFoto']);

// Route::get('/masterr', function () {
//     return view('masterr');
// });


//  Route::get('/second', function () {
//     return view('user.second');
// });

// Route::get('/tri', function () {
//     return view('user.tri');
// });

Route::get('/insert-sql', [MahasiswaController::class,'insertSql']);

Route::get('/user.master', [MahasiswaController::class,'getView']);


Route::get('webcam', [WebcamController::class, 'index']);
Route::post('webcam', [WebcamController::class, 'store'])->name('webcam.capture');