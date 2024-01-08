<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\zabevent\TermandconditionsController;

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

Route::get('/termandconditions', [TermandconditionsController::class, 'getbyall']);
Route::get('/termandconditions/{id}', [TermandconditionsController::class, 'getbyid']);
Route::get('/termsandconditions/{id}', [TermandconditionsController::class, 'edit']);
Route::post('/termandconditions', [TermandconditionsController::class, 'store']);
Route::put('/termandconditions/{id}', [TermandconditionsController::class, 'update']);
Route::delete('/termandconditions/{id}', [TermandconditionsController::class, 'delete']);