<?php

use App\Http\Controllers\Zab\StaffController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Zab\TermsAndConditionsController;
use App\Http\Controllers\Zab\ClientController;


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
//Route::post('/termsandconditions', [TermsAndConditionsController::class, 'store']);
Route::put('/termsandconditions/{id}', [TermsAndConditionsController::class, 'update']); 
Route::delete('/termsandconditions/{id}', [TermsAndConditionsController::class, 'delete']);


// client
Route::post('/clients/add', [ClientController::class, 'Insert']);
Route::get('/clients', [ClientController::class, 'getbyall']);
Route::get('/clients/{id}', [ClientController::class, 'getbyid']);
Route::post('/clients/{id}', [ClientController::class, 'update']);
Route::delete('/clients/{id}', [ClientController::class, 'delete']);
Route::get('/clients/{id}', [ClientController::class, 'edit']);


// staff 
Route::post('/staff/add', [StaffController::class, 'Insert']);//
Route::get('/staff', [StaffController::class, 'getbyall']);
Route::get('/staff/{id}', [StaffController::class, 'getbyid']);
Route::get('/staff/{id}', [StaffController::class, 'edit']);
Route::post('/staff/{id}', [StaffController::class, 'update']);
Route::delete('/staff/{id}', [StaffController::class, 'delete']);


