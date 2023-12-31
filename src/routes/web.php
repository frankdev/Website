<?php

use App\Http\Controllers\Articles\ShowController;
use App\Http\Controllers\Courses\IndexController as CourseIndexController;
use App\Http\Controllers\Courses\ShowController as CourseShowController;
use App\Http\Controllers\Courses\WatchController as CourseWatchController;
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

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::prefix('articles')->group(function () {
    Route::get('{slug}', ShowController::class)
        ->name('articles.show');
});

Route::prefix('courses')->group(function () {
    Route::get('/', CourseIndexController::class)
        ->name('courses.index');
    Route::get('/{slug}', CourseShowController::class)
        ->name('courses.show');
    Route::get('/watch/{course}/{lesson}', CourseWatchController::class)
        ->name('courses.watch');
});

require __DIR__.'/auth.php';
