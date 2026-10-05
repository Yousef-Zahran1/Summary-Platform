<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\DownloadsSummaryController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\SummariesController;
use App\Http\Controllers\admin\SubjectController;
use App\Http\Controllers\admin\DepartmentController;



//breeze
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


route::get('/', [SummaryController::class, 'index'])->name('summaries.index');
route::get('/departments/{department}', [DepartmentsController::class, 'show'])->name('departments.show');
route::get('/subjects/{subject}', [SubjectsController::class, 'show'])->name('subjects.show');


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    route::get('/users', [UsersController::class, 'index'])->name('admin.users.index');
    route::get('/summaries', [SummariesController::class, 'index'])->name('admin.summaries.index');
    
    route::get('/subjects', [SubjectController::class, 'index'])->name('admin.subjects.index');
    route::get('/subjects/create', [SubjectController::class, 'create'])->name('admin.subjects.create');
    route::post('/subjects', [SubjectController::class, 'store'])->name('admin.subjects.store');

    route::get('/departments', [DepartmentController::class, 'index'])->name('admin.departments.index');
    route::get('/departments/create', [DepartmentController::class, 'create'])->name('admin.departments.create');
    route::post('/departments', [DepartmentController::class, 'store'])->name('admin.departments.store');
});


Route::middleware(['auth', 'not-admin'])->group(function () {
    route::get('/summaries/create', [SummaryController::class, 'create'])->name('summaries.create');
    route::post('/summaries', [SummaryController::class, 'store'])->name('summaries.store');
    route::get('/summaries/{summary}/edit', [SummaryController::class, 'edit'])->name('summaries.edit');
    route::put('/summaries/{summary}', [SummaryController::class, 'update'])->name('summaries.update');

    route::get('/downloads', [DownloadsSummaryController::class, 'index'])->name('downloads.index');

    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    route::get('/settings', [ProfileController::class, 'edit'])->name('settings');
    route::patch('/settings/profile', [ProfileController::class, 'update'])->name('settings.profile.update');

    route::delete('/settings/profile/avatar', [ProfileController::class, 'destroyAvatar'])->name('settings.profile.avatar.delete');
    route::post('/settings/profile/avatar', [ProfileController::class, 'storeAvatar'])->name('settings.profile.avatar.store');

    route::get('/summaries/{summary}', [SummaryController::class, 'show'])->name('summaries.show');
    route::delete('/summaries/{summary}', [SummaryController::class, 'destroy'])->name('summaries.destroy');

    route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
});



require __DIR__ . '/auth.php';
