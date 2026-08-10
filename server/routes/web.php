<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentCategoryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentArchiveController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ActivityLogController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::resource('documents', DocumentController::class);
    Route::resource('documents', DocumentController::class)->except(['destroy']);
    Route::patch('documents/{document}/status', [DocumentController::class, 'updateStatus'])->name('documents.status.update');
    Route::get('documents/{document}/assign', [DocumentController::class, 'assignForm'])->name('documents.assign.form');
    Route::post('documents/{document}/assign', [DocumentController::class, 'assign'])->name('documents.assign');
    Route::post('/documents/{document}/assign',[DocumentController::class, 'assign'])->name('documents.assign');
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');


    Route::get('/activity-logs', [ActivityLogController::class, 'index'])
    ->name('activity-logs.index');


    Route::resource('categories', DocumentCategoryController::class);
    Route::resource('categories', DocumentCategoryController::class)->except(['show']);



    Route::get('archive', [DocumentArchiveController::class, 'index'])->name('archive.index');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';
