<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoadmapChapterController;
use App\Http\Controllers\RoadmapMakerController;
use App\Http\Controllers\RoadmapPlannerController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('/roadmap')->name('roadmap.')->group(function () {
        Route::get('/maker', RoadmapMakerController::class)->name('maker');
        Route::resource('/planner', RoadmapPlannerController::class);
        Route::get('/chapter/{chapter}', RoadmapChapterController::class)->name('chapter');
    });
});

require __DIR__ . '/auth.php';
