<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\QuestionerController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Controllers\SubscriptionController;
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

    Route::get('/admin-dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->middleware('role:admin')->name('admin.dashboard');

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/form', function () {

        return Inertia::render('Form', [
            'occupations' => Occupation::all()
        ]);
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

Route::post('stripe/webhook', [StripeWebhookController::class, 'handleWebhook']);

Route::post('/create-subscription', [SubscriptionController::class, 'create']);

// Include Auth Routes
require __DIR__.'/auth.php';
