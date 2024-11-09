<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json('this is UniTech API');
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('projects')->group(function () {
    Route::post('/', [ProjectController::class, 'store']);        // Create a new project with full details
    Route::get('/', [ProjectController::class, 'index']);         // List all projects
    Route::get('/{id}', [ProjectController::class, 'show']);      // Show a specific project with full details
});
