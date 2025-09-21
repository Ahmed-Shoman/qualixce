<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HeroSectionController;

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

// HeroSection CRUD API
Route::prefix('hero-sections')->group(function () {
    Route::get('/', [HeroSectionController::class, 'index']);         // GET /api/hero-sections
    Route::get('/{heroSection}', [HeroSectionController::class, 'show']); // GET /api/hero-sections/{id}
    Route::post('/', [HeroSectionController::class, 'store']);       // POST /api/hero-sections
    Route::put('/{heroSection}', [HeroSectionController::class, 'update']); // PUT /api/hero-sections/{id}
    Route::delete('/{heroSection}', [HeroSectionController::class, 'destroy']); // DELETE /api/hero-sections/{id}
});