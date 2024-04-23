<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\feedbackController;
use Illuminate\Foundation\Application;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'flash' => [
            'message' => 'You are Logged Out'
        ],
    ]);
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [FeedbackController::class, 'FeedbackAll'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';





Route::get('/feedback', [FeedbackController::class, 'CreateFeedback'])->name('feedback');


Route::post('/feedback', [feedbackController::class, 'store'])->name('feedback.store');

Route::post('/like/{id}', [feedbackController::class, 'Liked'])->name('feedback.like');


Route::post('/comment/{id}', [feedbackController::class, 'Comments'])->name('feedback.comment');








