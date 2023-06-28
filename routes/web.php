<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\IjazahController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WebcamController;
use App\Http\Controllers\Master\MasterController;
use App\Http\Controllers\RiwayatPeminjamanController;
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

// User Peminjaman & Pengambilan Routes
Route::get('/', [MasterController::class, 'index'])->name('home');
Route::post('/firstStepPost', [MasterController::class, 'firstStepPost'])->name('firstStepPost');

// step kedua peminjaman
Route::get('/second', [MasterController::class, 'secondPage'])->name('second');
Route::post('/secondStepPost', [MasterController::class, 'secondStepPost'])->name('secondStepPost');

// step ketiga peminjaman
Route::get('/third', [MasterController::class, 'third'])->name('third');
Route::post('/thirdStepPost', [MasterController::class, 'thirdStepPost'])->name('thirdStepPost');

// selesai peminjaman
Route::get('/selesai', [MasterController::class, 'selesai'])->name('selesai');

// test route
Route::post('/test', [MasterController::class, 'test'])->name('test');

// session forget
Route::get('/forget', function(Request $request){
    $request->session()->flush();
    echo "all tokens flushed";
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function(){
    Route::get('/index', [DashboardController::class, 'dashboard'])->name('dashboard');

    // control source person
    Route::resource('/person', PersonController::class)
        ->name('index', 'dashboard.person.index')
        ->name('edit', 'dashboard.person.edit')
        ->name('update', 'dashboard.person.update')
        ->name('destroy', 'dashboard.person.delete');

    Route::resource('/student', StudentController::class)
        ->name('index', 'dashboard.student.index')
        ->name('create', 'dashboard.student.create')
        ->name('store', 'dashboard.student.store')
        ->name('edit', 'dashboard.student.edit')
        ->name('update', 'dashboard.student.update')
        ->name('destroy', 'dashboard.student.delete');

    Route::resource('/ijazah', IjazahController::class)
        ->name('index', 'dashboard.ijazah.index')
        ->name('create', 'dashboard.ijazah.create')
        ->name('store', 'dashboard.ijazah.store')
        ->name('edit', 'dashboard.ijazah.edit')
        ->name('update', 'dashboard.ijazah.update')
        ->name('destroy', 'dashboard.ijazah.delete');

    Route::resource('/employee', EmployeeController::class)
        ->name('index', 'dashboard.employee.index')
        ->name('create', 'dashboard.employee.create')
        ->name('store', 'dashboard.employee.store')
        ->name('edit', 'dashboard.employee.edit')
        ->name('update', 'dashboard.employee.update')
        ->name('destroy', 'dashboard.employee.delete')
        ->except('show');

    Route::get('/riwayat-peminjaman', [RiwayatPeminjamanController::class, 'index'])->name('riwayat-peminjaman');
    Route::get('/riwayat-peminjaman/{id}', [RiwayatPeminjamanController::class, 'show'])->name('riwayat-peminjaman.show');
});

// Route::get('student', [StudentController::class, 'index']);
// Route::get('student-add', [StudentController::class, 'create']);
// Route::post('students', [StudentController::class, 'store']);
// Route::get('student/{id}/edit', [StudentController::class, 'edit']);
// Route::put('student/{id}', [StudentController::class, 'update']);
// Route::delete('student/{id}', [StudentController::class, 'destroy']);

Route::get('main', function () {
    return view('admin/layouts/main');
});

// store photo peminjam
Route::post('webcam', [MasterController::class, 'store'])->name('webcam.capture');

Route::get('/insert-sql', [MahasiswaController::class,'insertSql']);

Route::get('/user.master', [MahasiswaController::class,'getView']);


Route::get('webcam', [WebcamController::class, 'index']);
