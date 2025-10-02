<?php

use App\Http\Controllers\API\RegistrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Student Registration API Routes (Public)
Route::get('registrations', [RegistrationController::class, 'index'])->name('api.registrations.index');
Route::post('registrations', [RegistrationController::class, 'store'])->name('api.registrations.store');
Route::prefix('registration')->group(function () {
    Route::post('/', [RegistrationController::class, 'store'])->name('api.registration.store');
    Route::get('success', [RegistrationController::class, 'success'])->name('api.registration.success');
    Route::get('{id}', [RegistrationController::class, 'show'])->name('api.registration.show');
    Route::get('programs', [RegistrationController::class, 'getPrograms'])->name('api.registration.programs');
    Route::get('classes/{program}', [RegistrationController::class, 'getClasses'])->name('api.registration.classes');
    Route::post('validate-step', [RegistrationController::class, 'validateStep'])->name('api.registration.validate-step');
    Route::get('admission-waves/{level}', [RegistrationController::class, 'getAdmissionWaves'])->name('api.registration.admission-waves');
});

// Health Check
Route::get('health', function () {
    return response()->json([
        'status' => 'ok',
        'service' => 'Main API',
        'version' => '1.0.0',
        'timestamp' => now()->toISOString()
    ]);
});