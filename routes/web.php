<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SseitController;
use App\Http\Controllers\TrainingPerceptionController;
use App\Http\Controllers\TrainingUsageController;
use App\Http\Controllers\TrainingUnderstandingController;
use App\Http\Controllers\TrainingManagementController;

// Główna strona kieruje na dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard (GET) -> DashboardController@index
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Auth
// GET /login -> AuthController@showLogin (formularz)
// POST /login -> AuthController@login (logowanie)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// GET /register -> AuthController@showRegister (formularz)
// POST /register -> AuthController@register (rejestracja)
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// POST /logout -> AuthController@logout (wylogowanie)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profil (Statystyki) - jeśli wejdzie gość, obsłuży to kontroler
// GET /profile -> ProfileController@index
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

// SSEIT
// GET /sseit -> SseitController@index (formularz)
// POST /sseit -> SseitController@store (zapis wyniku)
Route::get('/sseit', [SseitController::class, 'index'])->name('sseit');
Route::post('/sseit', [SseitController::class, 'store'])->name('sseit.store');

// Modules
Route::prefix('trening')->name('training.')->group(function () {
    // GET -> index() (pokazuje trening)
    // POST -> store() (zapisuje wynik)
    Route::get('percepcja', [TrainingPerceptionController::class, 'index'])->name('perception');
    Route::post('percepcja', [TrainingPerceptionController::class, 'store'])->name('perception.store');

    Route::get('wykorzystanie', [TrainingUsageController::class, 'index'])->name('usage');
    Route::post('wykorzystanie', [TrainingUsageController::class, 'store'])->name('usage.store');

    Route::get('rozumienie', [TrainingUnderstandingController::class, 'index'])->name('understanding');
    Route::post('rozumienie', [TrainingUnderstandingController::class, 'store'])->name('understanding.store');

    Route::get('zarzadzanie', [TrainingManagementController::class, 'index'])->name('management');
    Route::post('zarzadzanie', [TrainingManagementController::class, 'store'])->name('management.store');
});
