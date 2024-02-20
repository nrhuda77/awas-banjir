<?php

use App\Http\Controllers\BanjirController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InfluencerController;
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

Route::get('/', [DashboardController::class, 'index']);
Route::get('/harian', [DashboardController::class, 'ajaxData']);

// influencer
Route::get('/influencer', [InfluencerController::class, 'index']);
Route::post('/influencer', [InfluencerController::class, 'save']);
Route::get('/influencer/{id}', [InfluencerController::class, 'getEdit']);
Route::post('/influencer-update', [InfluencerController::class, 'update']);
Route::delete('/influencer/{id}', [InfluencerController::class, 'delete']);
Route::post('/get-influencer', [InfluencerController::class, 'getList']);


// whatsapp
Route::get('/whatsapp', [WhatsappController::class, 'index']);
Route::post('/whatsapp', [WhatsappController::class, 'save']);

// Banjir
Route::get('/banjir', [BanjirController::class, 'index']);
Route::get('/banjir-data', [BanjirController::class, 'ajaxData']);
Route::get('/banjir/{id}', [BanjirController::class, 'getEdit']);
Route::post('/get-banjir', [BanjirController::class, 'getList']);

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::get('/login', function () {
    return view('login');
});
