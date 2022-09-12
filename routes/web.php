<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\PlauktsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect('/profile/'.auth()->user()->username);
})->middleware(['auth'])->name('dashboard');

/***   Profils   ***/
Route::get('/profile/{username}', [ProfileController::class, 'index'])->middleware(['auth'])->name('profile.show');
Route::get('/profile/{username}/edit', [ProfileController::class, 'edit'])->middleware(['auth'])->name('profile.edit');
Route::put('/profile/{username}', [ProfileController::class, 'update'])->middleware(['auth'])->name('profile.update');

// Meklēšana
Route::post('/profiles/search', [ProfileController::class, 'filter'])->middleware(['auth']);
Route::get('/profiles/search', function(){
    return view('search-profile');
})->middleware(['auth']);

/***   Grāmatas   ***/
Route::resource('books', BookController::class);
Route::get('books', [BookController::class, 'show_filter'])->middleware(['auth']);
Route::post('books', [BookController::class, 'filter'])->middleware(['auth']);
Route::delete('books', [BookController::class, 'destroy'])->middleware(['auth']);

Route::get('b/create', [BookController::class, 'create'])->middleware(['auth'])->name('books.create');
Route::post('b', [BookController::class, 'store'])->middleware(['auth'])->name('books.store');

Route::get('b/{id}', [BookController::class, 'show'])->middleware(['auth'])->name('books.show');

/***   Atsauksmes   ***/
Route::resource('review', ReviewController::class);
Route::get('review/{book_id}/create', [ReviewController::class, 'create'])->middleware(['auth'])->name('review.create');


/***   Plaukti   ***/
Route::resource('plaukti', PlauktsController::class);
Route::get('u/{username}/plaukti', [PlauktsController::class, 'index'])->middleware(['auth'])->name('plaukts.index');
Route::post('u/{username}/plaukti', [PlauktsController::class, 'store'])->middleware(['auth'])->name('plaukts.store');
Route::get('/plaukti/{id}/edit', [PlauktsController::class, 'edit'])->middleware(['auth'])->name('plaukts.edit');

Route::get('/plaukti/{id}', [PlauktsController::class, 'show'])->middleware(['auth'])->name('plaukts.show');
Route::put('/plaukti/{id}/edit', [PlauktsController::class, 'update'])->middleware(['auth'])->name('plaukts.update');
Route::delete('b/plaukts', [PlauktsController::class, 'destroy_user_book'])->middleware(['auth']);

Route::post('b/plaukts', [PlauktsController::class, 'store_book'])->middleware(['auth']);

require __DIR__.'/auth.php';
