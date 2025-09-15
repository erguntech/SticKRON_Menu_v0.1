<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SystemSettingsController;
use App\Http\Controllers\StoreSettingsController;
use App\Http\Controllers\MaintenanceModeController;
use App\Http\Controllers\DigitalMenuContentController;
use App\Http\Controllers\DigitalMenuCategoryController;
use App\Http\Controllers\DigitalMenuCampaignController;
use App\Http\Controllers\DigitalMenuController;

Route::get('/maintenance', [MaintenanceModeController::class, 'maintenanceMode'])->name('MaintenanceMode');

Route::prefix('menu')->group(function () {
    Route::get('/r/{code}', [DigitalMenuController::class, 'resolveByCode'])
        ->whereNumber('code')->name('menu.resolve');

    Route::get('/{slug}', [DigitalMenuController::class, 'showBySlug'])
        ->where('slug', '[A-Za-z0-9\-]+')->name('menu.slug');
});

Route::group(['middleware' => ['maintenance_mode']], function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/account/deactivated', [StatusController::class, 'userDeactivated'])->name('UserDeactivated');
        Route::group(['middleware' => ['status.active']], function () {
            // DashboardController Start
            Route::get('/', [DashboardController::class, 'index'])->name('Dashboards.Index');
            // DashboardController End

            // ClientController Start
            Route::resource('clients', ClientController::class, [
                'names' => ['index' => 'Clients.Index', 'show' => 'Clients.Show', 'create' => 'Clients.Create', 'store' => 'Clients.Store', 'edit' => 'Clients.Edit', 'update' => 'Clients.Update', 'destroy' => 'Clients.Destroy']
            ]);
            // ClientController End

            // DigitalMenuContentController Start
            Route::resource('contents', DigitalMenuContentController::class, [
                'names' => ['index' => 'DigitalMenuContents.Index', 'create' => 'DigitalMenuContents.Create', 'store' => 'DigitalMenuContents.Store', 'edit' => 'DigitalMenuContents.Edit', 'update' => 'DigitalMenuContents.Update', 'destroy' => 'DigitalMenuContents.Destroy']
            ]);
            Route::get('/sorting/contents', [DigitalMenuContentController::class, 'sortIndex'])->name('DigitalMenuContents.Sort.Index');
            Route::post('/sorting/contents', [DigitalMenuContentController::class, 'sortUpdate'])->name('DigitalMenuContents.Sort.Update');
            // DigitalMenuContentController End

            // DigitalMenuCategoryController Start
            Route::resource('categories', DigitalMenuCategoryController::class, [
                'names' => ['index' => 'DigitalMenuCategories.Index', 'create' => 'DigitalMenuCategories.Create', 'store' => 'DigitalMenuCategories.Store', 'edit' => 'DigitalMenuCategories.Edit', 'update' => 'DigitalMenuCategories.Update', 'destroy' => 'DigitalMenuCategories.Destroy']
            ]);
            Route::get('/sorting/categories', [DigitalMenuCategoryController::class, 'sortIndex'])->name('DigitalMenuCategories.Sort.Index');
            Route::post('/sorting/categories', [DigitalMenuCategoryController::class, 'sortUpdate'])->name('DigitalMenuCategories.Sort.Update');
            // DigitalMenuCategoryController End

            // DigitalMenuCampaignController Start
            Route::resource('campaigns', DigitalMenuCampaignController::class, [
                'names' => ['index' => 'DigitalMenuCampaigns.Index', 'create' => 'DigitalMenuCampaigns.Create', 'store' => 'DigitalMenuCampaigns.Store', 'edit' => 'DigitalMenuCampaigns.Edit', 'update' => 'DigitalMenuCampaigns.Update', 'destroy' => 'DigitalMenuCampaigns.Destroy']
            ]);
            Route::get('/sorting/campaigns', [DigitalMenuCampaignController::class, 'sortIndex'])->name('DigitalMenuCampaigns.Sort.Index');
            Route::post('/sorting/campaigns', [DigitalMenuCampaignController::class, 'sortUpdate'])->name('DigitalMenuCampaigns.Sort.Update');
            // DigitalMenuCampaignController End

            // SystemSettingsController Start
            Route::get('/settings/system', [SystemSettingsController::class, 'index'])->name('Settings.System.Index');
            Route::post('/settings/system', [SystemSettingsController::class, 'update'])->name('Settings.System.Update');
            // SystemSettingsController End

            // StoreSettingsController Start
            Route::get('/settings/store', [StoreSettingsController::class, 'index'])->name('Settings.Store.Index');
            Route::post('/settings/store', [StoreSettingsController::class, 'update'])->name('Settings.Store.Update');
            // StoreSettingsController End
        });
    });
});
