<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\QuestionerController;
use App\Models\Occupation;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
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

// Public Routes
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'isAuthenticated' => Auth::check()
    ]);
})->name('home');

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/form/{type}', function ($type) {
//        $occupations = Occupation::all()->pluck('occupation')->toArray();
        return Inertia::render('Form', ['type' => $type, 'occupations' => Occupation::all()]);
    });

    Route::get('/questioner', function () {
        return Inertia::render('Questioner');
    });

    // If using web.php
    Route::post('/submit-answers', [FormController::class, 'submitAnswers']);


    // Form Submission Route
    Route::post('/form-submit', [FormController::class, 'submit']);

    Route::get('/questioners-list', [QuestionerController::class, 'questionersList'])->name('profile.questioners.list');

    Route::get('/questioner/{id}', [QuestionerController::class, 'showQuestioner']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Include Auth Routes
require __DIR__.'/auth.php';
