<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookCylinderController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/book-cylinder',[BookCylinderController::class, 'index'])->name('book-cylinder');
Route::post('/book',[BookCylinderController::class, 'book'])->name('book');

Route::get('/supplier',[BookCylinderController::class, 'supplier'])->name('supplier');

Route::get('/dashboard',[BookCylinderController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboardData',[BookCylinderController::class, 'dashboardData'])->middleware(['auth', 'verified'])->name('dashboardData');
Route::post('/changeStatus',[BookCylinderController::class, 'changeStatus'])->name('changeStatus');
Route::get('/state-counts', [BookCylinderController::class, 'getStateCounts']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
