<?php

use Illuminate\Support\Facades\Auth;
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
    return view('home');
});
Route::post('/registration', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('registration');

Route::get('/register/{token?}', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistration'])->name('register.link');

Route::prefix('moderator')->middleware(['auth', 'isModerator'])->group(function () {
    Route::get('/question', [App\Http\Controllers\QuestionController::class, 'index'])->name('question');
    Route::post('/store', [App\Http\Controllers\QuestionController::class, 'store'])->name('store');
    Route::put('/update/{id}', [App\Http\Controllers\QuestionController::class, 'update'])->name('update');
    Route::get('/edit/{id}', [App\Http\Controllers\QuestionController::class, 'edit'])->name('edit');
    Route::delete('/delete/{id}', [App\Http\Controllers\QuestionController::class, 'destroy'])->name('delete');
    Route::get('/invitation', [App\Http\Controllers\InvitationController::class, 'index'])->name('invitation');
    Route::post('/register/moderator', [App\Http\Controllers\Auth\RegisterController::class, 'registerModerator'])->name('register.moderator');
    Route::get('/invitation/create', [App\Http\Controllers\InvitationController::class, 'create'])->name('create.invitation');

});

Route::prefix('user')->middleware(['auth', 'isUser'])->group(function () {
    Route::get('/questionnaire', [App\Http\Controllers\QuestionnaireController::class, 'index'])->name('questionnaire');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
