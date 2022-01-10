<?php

use App\Http\Controllers\API\Monitoreo\CameraController;
use App\Http\Controllers\API\Monitoreo\FlawController;
use App\Http\Controllers\API\Monitoreo\DownCameraController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('monitoreo/fallas', [FlawController::class,'index']);
Route::post('downcamera', [DownCameraController::class,'store']);
Route::get('monitoreo/camaras', [CameraController::class,'index']);
