<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryCourseController;
use App\Http\Controllers\CourseSectionController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SectionVideoController;

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


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Protected routes
// Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'categories'], function () {
        // categories
        Route::post('/store', [CategoryController::class, 'store']);
        Route::put('{id}/update', [CategoryController::class, 'update']);
        Route::delete('{id}/delete', [CategoryController::class, 'delete']);

        // category courses
        Route::post('{slug}/courses/store', [CategoryCourseController::class, 'store']);
        Route::put('{slug}/courses/update', [CategoryCourseController::class, 'update']);
        Route::delete('courses/{id}/delete', [CategoryCourseController::class, 'delete']);
    });
    // Course Sections
    Route::post('course/{slug}', [CourseSectionController::class, 'store']);
    Route::put('course/{slug}', [CourseSectionController::class, 'update']);
    Route::delete('section/{id}', [CourseSectionController::class, 'delete']);
    
    // Section Videos
    Route::post('section/{slug}/videos', [SectionVideoController::class, 'store']);
    Route::put('section/{slug}/videos/update', [SectionVideoController::class, 'update']);
    Route::delete('{id}/videos/delete', [SectionVideoController::class, 'delete']);
    
    // logout
    Route::post('logout', [AuthController::class, 'logout']);
// });


// public routes
Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{slug}/courses', [CategoryCourseController::class, 'index']);
Route::get('course/{slug}', [CourseSectionController::class, 'index']);
Route::get('section/{slug}/videos', [SectionVideoController::class, 'index']);
Route::get('course/{slug}/firstvideo', [CourseSectionController::class, 'show']);


// Independent Controllers without relationships
Route::get('courses', [CourseController::class, 'index']);
Route::get('sections', [SectionController::class, 'index']);
Route::get('videos', [VideoController::class, 'index']);