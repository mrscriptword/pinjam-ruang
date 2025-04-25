<?php

namespace App;

use App\Models\Room;
use App\Models\Building;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DaftarRuangController;
use App\Http\Controllers\DaftarPinjamController;
use App\Http\Controllers\DashboardRentController;
use App\Http\Controllers\DashboardRoomController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\TemporaryRentController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\RegisterController;

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
    return view('index', [
        'title' => "Home",
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard/overview', function () {
        return view('/dashboard/overview/index', [
            'title' => "Dashboard Admin",
        ]);
    });

    Route::middleware(['checkRole'])->group(function () {
        Route::get('/dashboard/temporaryRents', [TemporaryRentController::class, 'index']);
        Route::get('/dashboard/temporaryRents/{id}/acceptRents', [TemporaryRentController::class, 'acceptRents']);
        Route::get('/dashboard/temporaryRents/{id}/declineRents', [TemporaryRentController::class, 'declineRents']);
        Route::resource('dashboard/rents', DashboardRentController::class);
        Route::get('dashboard/rents-export', [DashboardRentController::class, 'export'])->name('rents.export');
        Route::get('dashboard/rents/{id}/endTransaction', [DashboardRentController::class, 'endTransaction']);
        Route::resource('dashboard/rooms', DashboardRoomController::class);
        Route::resource('dashboard/users', DashboardUserController::class);
        Route::resource('dashboard/admin', DashboardAdminController::class);
        Route::resource('/daftarpinjam', DashboardRentController::class);
        Route::get('dashboard/users/{id}/makeAdmin', [DashboardUserController::class, 'makeAdmin']);
        // Update the method name from 'removeAdmin' to 'demoteToUser'
        Route::get('dashboard/admin/{id}/demote', [DashboardAdminController::class, 'demoteToUser'])->name('admin.demote'); // Renamed route and method
        Route::post('/dashboard/users/import', [DashboardUserController::class, 'import'])->name('users.import');

    });

    Route::resource('/daftarpinjam', DashboardRentController::class);
    Route::get('/daftarruang', [DaftarRuangController::class, 'index']);
    Route::get('/showruang/{room:code}', [DaftarRuangController::class, 'show']);
    Route::get('/daftarpinjam', [DaftarPinjamController::class, 'index']);
    Route::post('/logout', [LoginController::class, 'logout']);
});
