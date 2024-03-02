<?php

use App\Http\Controllers\BanjirController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('banjir/{tinggi}', [BanjirController::class, 'apiBanjir']);
Route::post('banjir', [BanjirController::class, 'apiPhoto']);
Route::get('wa-api', [BanjirController::class, 'waApi']);
// Route::get('influencer', [BanjirController::class, 'influencer']);
