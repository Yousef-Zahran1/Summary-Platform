<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\DownloadsSummaryController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\AuthController;

route::get('/' , [SummaryController::class , 'index'])->name('summaries.index');
route::get('/summaries/create' , [SummaryController::class , 'create'])->name('summaries.create');
route::get('/summaries/edit' , [SummaryController::class , 'edit'])->name('summaries.edit');
route::get('/summaries/{summary}' , [SummaryController::class , 'show'])->name('summaries.show');
route::post('/summaries' , [SummaryController::class , 'store'])->name('summaries.store');

route::get('/login' , [AuthController::class , 'login'])->name('login');
route::get('/register' , [AuthController::class , 'register'])->name('register');

route::get('/departments/{department}' , [DepartmentsController::class , 'show'])->name('departments.show');

route::get('/subjects/{subject}' , [SubjectsController::class , 'show'])->name('subjects.show');

route::get('/profile' , [ProfileController::class, 'show'])->name('profile.show');
route::get('/settings' , [SettingsController::class, 'index'])->name('settings.index');
route::get('/downloads' , [DownloadsSummaryController::class, 'index'])->name('downloads.index');

route::post('/summaries/{summary}/like', [LikeController::class, 'toggle'])->name('summaries.like');