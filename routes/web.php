<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwitterController;

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
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/auth/twitter/redirect', [TwitterController::class, 'provider'])->name('auth.twitter');

Route::get('/auth/twitter/callback', [TwitterController::class, 'providerHandler']);

require __DIR__.'/auth.php';
