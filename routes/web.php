<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\DownloadsSummaryController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\LikeController;


route::get('/' , [SummaryController::class , 'index'])->name('summaries.index');
route::get('/departments/{department}' , [DepartmentsController::class , 'show'])->name('departments.show');
route::get('/subjects/{subject}' , [SubjectsController::class , 'show'])->name('subjects.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    route::get('/summaries/create' , [SummaryController::class , 'create'])->name('summaries.create');
    route::post('/summaries' , [SummaryController::class , 'store'])->name('summaries.store');
    route::get('/summaries/{summary}' , [SummaryController::class , 'show'])->name('summaries.show');
    route::get('/summaries/{summary}/edit' , [SummaryController::class , 'edit'])->name('summaries.edit');
    route::put('/summaries/{summary}' , [SummaryController::class , 'update'])->name('summaries.update');
    route::delete('/summaries/{summary}' , [SummaryController::class , 'destroy'])->name('summaries.destroy');


    route::get('/profile/{user}' , [ProfileController::class, 'show'])->name('profile.show');
    route::get('/downloads' , [DownloadsSummaryController::class, 'index'])->name('downloads.index');
    
    
    route::post('/summaries/{summary}/like', [LikeController::class, 'toggle'])->name('summaries.like');
    
    
    
    route::get('/settings' , [ProfileController::class, 'edit'])->name('settings');
    route::patch('/settings/profile', [ProfileController::class, 'update'])->name('settings.profile.update');
    
    route::delete('/settings/profile/avatar', [ProfileController::class, 'destroyAvatar'])->name('settings.profile.avatar.delete');
    route::post('/settings/profile/avatar', [ProfileController::class, 'storeAvatar'])->name('settings.profile.avatar.store');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



