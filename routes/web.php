<?php

use App\Http\Controllers\CrawlController;
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
    return view('welcome');
});
Route::get('/lot', [CrawlController::class, 'lotsView']);
Route::get('/related', [CrawlController::class, 'related']);
Route::get('/care', [CrawlController::class, 'care']);
