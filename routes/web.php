<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;

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


Route::get('/', [LinkController::class, 'index'])->name('home');
Route::post('/shorten', [LinkController::class, 'shorten'])->name('shorten');
Route::get('/recent-links', [LinkController::class, 'recentLinks'])->name('recent_links');

