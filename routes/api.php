<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HeroSectionController;
use App\Http\Controllers\Api\AboutQualixceSectionController;
use App\Http\Controllers\Api\FounderMessageController;   // ✅ الصح 



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



Route::prefix('about-qualixce')->group(function () {
    Route::get('/', [AboutQualixceSectionController::class, 'index']);      // GET all sections
    Route::post('/', [AboutQualixceSectionController::class, 'store']);     // CREATE new section
    Route::get('/{aboutQualixceSection}', [AboutQualixceSectionController::class, 'show']);   // GET single section
    Route::put('/{aboutQualixceSection}', [AboutQualixceSectionController::class, 'update']); // UPDATE section
    Route::delete('/{aboutQualixceSection}', [AboutQualixceSectionController::class, 'destroy']); // DELETE section
});

use App\Http\Controllers\Api\OurValueSectionController;

Route::prefix('our-values')->group(function () {
    Route::get('/', [OurValueSectionController::class, 'index']);       // GET all sections
    Route::post('/', [OurValueSectionController::class, 'store']);      // CREATE new section
    Route::get('{ourValueSection}', [OurValueSectionController::class, 'show']);  // GET single section
    Route::put('{ourValueSection}', [OurValueSectionController::class, 'update']); // UPDATE section
    Route::patch('{ourValueSection}', [OurValueSectionController::class, 'update']); // PATCH section
    Route::delete('{ourValueSection}', [OurValueSectionController::class, 'destroy']); // DELETE section
});

use App\Http\Controllers\Api\WhyChooseUsController;

Route::apiResource('why-choose-us', WhyChooseUsController::class);

use App\Http\Controllers\Api\OurServiceController;

Route::apiResource('our-services', OurServiceController::class);

use App\Http\Controllers\Api\ProvenProcessController;

Route::apiResource('proven-processes', ProvenProcessController::class);

use App\Http\Controllers\Api\ExcellenceAreaController;

Route::apiResource('excellence-areas', ExcellenceAreaController::class);

use App\Http\Controllers\Api\GetYourConsultationController;

Route::apiResource('get-your-consultations', GetYourConsultationController::class)
    ->only(['index', 'store', 'show', 'destroy']);

    use App\Http\Controllers\Api\FoundationMessageController;

Route::apiResource('founder-messages', FounderMessageController::class);
