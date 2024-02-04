<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PublicHolidaysController; 


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
Route::post('/public-holidays', [PublicHolidaysController::class, 'store']);
Route::get('/public-holidays', [PublicHolidaysController::class, 'show']);
Route::put('/public-holidays/{id}', [PublicHolidaysController::class, 'update']);


