<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DataController;

Route::get('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/productcategories', [DataController::class, 'getProductCategories']);
    Route::get('/products', [DataController::class, 'getProducts']);
    Route::get('/projectcategories', [DataController::class, 'getProjectCategories']);
    Route::get('/projects', [DataController::class, 'getProjects']);
    Route::get('/sliders', [DataController::class, 'getSliders']);
    Route::get('/mediagalleries', [DataController::class, 'getMediaGalleries']);
    Route::get('/news', [DataController::class, 'getNews']);
    Route::get('/references', [DataController::class, 'getReferences']);
    Route::get('/popup', [DataController::class, 'getPopup']);
});
