<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MemberController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/gestion', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/articles', [ArticleController::class,'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class,'create'])->name('articles.create');
    Route::get('/articles/show/{article}', [ArticleController::class,'show'])->name('articles.show');
    Route::get('/articles/edit/{article}', [ArticleController::class,'edit'])->name('articles.edit');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    Route::get('/members', [MemberController::class, 'index'])->name('members.index');
    Route::get('/members/create', [MemberController::class, 'create'])->name('members.create');
    Route::get('/members/edit/{member}', [MemberController::class, 'edit'])->name('members.edit');
    Route::post('/members', [MemberController::class, 'store'])->name('members.store');
    Route::post('/members/{member}/post', [MemberController::class, 'update'])->name('members.update');
    Route::delete('/members/{member}', [MemberController::class, 'destroy'])->name('members.destroy'); 
});