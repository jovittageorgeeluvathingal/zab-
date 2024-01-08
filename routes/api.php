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

Route::get('/termsandconditions', [TermsAndConditionsController::class, 'getbyall']);
Route::get('/termsandconditions/{id}', [TermsAndConditionsController::class, 'getbyid']);
Route::post('/termsandconditions/add', [TermsAndConditionsController::class, 'Insert']);

Route::get('/termsandconditions/{id}', [TermsAndConditionsController::class, 'edit']); // {id means the individal editing }
Route::post('/termsandconditions', [TermsAndConditionsController::class, 'store']);
Route::put('/termsandconditions/{id}', [TermsAndConditionsController::class, 'update']);
Route::delete('/termsandconditions/{id}', [TermsAndConditionsController::class, 'delete']);
