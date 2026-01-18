<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HeroSectionController;
use App\Http\Controllers\Api\AboutQualixceSectionController;
use App\Http\Controllers\Api\FounderMessageController;
use App\Http\Controllers\Api\UserRegistrationController;
use App\Http\Controllers\Api\ChatSyncController;
use App\Http\Controllers\Api\ChatController;




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

use App\Http\Controllers\Api\OurValueController;

Route::prefix('our-values')->group(function () {
    Route::get('/', [OurValueController::class, 'index']);       // GET all sections
    Route::post('/', [OurValueController::class, 'store']);      // CREATE new section
    Route::get('{ourValueSection}', [OurValueController::class, 'show']);  // GET single section
    Route::put('{ourValueSection}', [OurValueController::class, 'update']); // UPDATE section
    Route::patch('{ourValueSection}', [OurValueController::class, 'update']); // PATCH section
    Route::delete('{ourValueSection}', [OurValueController::class, 'destroy']); // DELETE section
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




Route::apiResource('why-choose-us', WhyChooseUsController::class);
Route::apiResource('why-choose-us', WhyChooseUsController::class);
Route::apiResource('why-choose-us', WhyChooseUsController::class);


use App\Http\Controllers\Api\PartnerController;

Route::get('partners', [PartnerController::class, 'index']);
Route::get('partners/{partner}', [PartnerController::class, 'show']);


use App\Http\Controllers\Api\ArticleController;

Route::get('articles', [ArticleController::class, 'index']);
Route::get('articles/{article}', [ArticleController::class, 'show']);
Route::post('articles', [ArticleController::class, 'store']);
Route::put('articles/{article}', [ArticleController::class, 'update']);
Route::delete('articles/{article}', [ArticleController::class, 'destroy']);

use App\Http\Controllers\Api\TestimonialController;

Route::get('testimonials', [TestimonialController::class, 'index']);
Route::get('testimonials/{testimonial}', [TestimonialController::class, 'show']);
Route::post('testimonials', [TestimonialController::class, 'store']);
Route::put('testimonials/{testimonial}', [TestimonialController::class, 'update']);
Route::delete('testimonials/{testimonial}', [TestimonialController::class, 'destroy']);



Route::post('/user-registration', [UserRegistrationController::class, 'store']);
Route::post('/chat-sync', [ChatSyncController::class, 'sync']);


Route::post('/chat/send', [ChatController::class, 'send']);
