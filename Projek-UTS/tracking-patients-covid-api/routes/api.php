<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientRegistrationController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Start middleware authentication to protect endpoint from unknown user
Route::middleware(['auth:sanctum'])->group(function () {
    // Start endpoint patient registrations
    Route::get('/patients/history', [PatientRegistrationController::class, 'index']);
    Route::get('/patients/history/{id}', [PatientRegistrationController::class, 'show']);
    Route::post('/patients/checkin', [PatientRegistrationController::class, 'checkin']);
    Route::put('/patients/checkout/{id}', [PatientRegistrationController::class, 'checkout']);
    Route::get('/patients/status/{status}', [PatientRegistrationController::class, 'searchByStatus']);
    // End endpoint patient registrations

    // Start endpoint patients
    Route::get('/patients', [PatientController::class, 'index']);
    Route::get('/patients/{id}', [PatientController::class, 'show']);
    Route::get('/patients/search/{name}', [PatientController::class, 'searchByName']);
    Route::post('/patients', [PatientController::class, 'store']);
    Route::put('/patients/{id}', [PatientController::class, 'update']);
    Route::delete('/patients/{id}', [PatientController::class, 'destroy']);
    // End ednpoint patients
});
// End middleware authentication

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);