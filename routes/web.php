<?php

use App\Http\Controllers\BanjirController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InfluencerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WhatsappController;
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

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/harian', [DashboardController::class, 'ajaxData'])->middleware('auth');

// influencer
Route::get('/influencer', [InfluencerController::class, 'index'])->middleware('auth');
Route::post('/influencer', [InfluencerController::class, 'save'])->middleware('auth');
Route::get('/influencer/{id}', [InfluencerController::class, 'getEdit'])->middleware('auth');
Route::post('/influencer-update', [InfluencerController::class, 'update'])->middleware('auth');
Route::delete('/influencer/{id}', [InfluencerController::class, 'delete'])->middleware('auth');
Route::post('/get-influencer', [InfluencerController::class, 'getList'])->middleware('auth');


// whatsapp
Route::get('/whatsapp', [WhatsappController::class, 'index'])->middleware('auth');
Route::post('/whatsapp', [WhatsappController::class, 'save'])->middleware('auth');

// Banjir
Route::get('/banjir', [BanjirController::class, 'index'])->middleware('auth');
Route::get('/banjir-data', [BanjirController::class, 'ajaxData'])->middleware('auth');
Route::get('/banjir/{id}', [BanjirController::class, 'getEdit'])->middleware('auth');
Route::post('/get-banjir', [BanjirController::class, 'getList'])->middleware('auth');

// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// });

// Route::get('/login', function () {
//     return view('login');
// });
