<?php

use App\Http\Controllers\ProfileController;
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
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return redirect()->route('projects.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('projects', App\Http\Controllers\ProjectController::class);
    Route::get('tasks/export', [App\Http\Controllers\TaskController::class, 'export'])->name('tasks.export');
    Route::get('tasks/export-csv', [App\Http\Controllers\TaskController::class, 'exportCsv'])->name('tasks.export.csv');
    Route::get('tasks/exports/{export}', [App\Http\Controllers\TaskController::class, 'downloadExport'])->name('tasks.export.download');
    Route::resource('tasks', App\Http\Controllers\TaskController::class);
});

require __DIR__.'/auth.php';
