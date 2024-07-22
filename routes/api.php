<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TareaController;

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

// Rutas para la API de Tareas
Route::prefix('v1')->group(function () {
    Route::get('/tareas', [TareaController::class, 'index']);
    Route::post('/tareas', [TareaController::class, 'store']);
    Route::get('/tareas/{id}', [TareaController::class, 'show']);
    Route::put('/tareas/{id}', [TareaController::class, 'update']);
    Route::delete('/tareas/{id}', [TareaController::class, 'destroy']);
});

// Ruta de prueba
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});
