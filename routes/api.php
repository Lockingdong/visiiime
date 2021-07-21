<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VPageController;
use App\Http\Controllers\Api\VBasicLinkItemController;
use App\Http\Controllers\Api\VLayoutController;
use App\Http\Controllers\Api\VTrackEventController;
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

// Route::group(['prefix' => 'v1', 'middleware' => 'auth'], function() {
Route::group(['prefix' => 'v1'], function() {

    Route::group(['prefix' => 'v-page', 'middleware' => 'auth:sanctum'], function() {

        Route::get('test/{pageId}', [VPageController::class, 'test'])->name('vPage.pageTest');
        Route::post('profile-update', [VPageController::class, 'profileUpdate'])->name('vPage.profileUpdate');
        Route::post('social-links-update', [VPageController::class, 'socialLinksUpdate'])->name('vPage.socialLinksUpdate');
        Route::post('update-page-data', [VPageController::class, 'updatePageData'])->name('vPage.updatePageData');
        Route::get('/ori/{pageId}', [VPageController::class, 'getPageDataOri'])->name('vPage.getPageData');
        Route::post('layout-update', [VPageController::class, 'layoutUpdate'])->name('vPage.layoutUpdate');

    });

    Route::group(['prefix' => 'v-basic-link-item', 'middleware' => 'auth:sanctum'], function() {
        Route::post('link-item-create', [VBasicLinkItemController::class, 'linkItemStore'])->name('vPage.linkItemStore');
        Route::post('link-item-delete', [VBasicLinkItemController::class, 'linkItemDelete'])->name('vPage.linkItemDelete');
        Route::post('link-item-update', [VBasicLinkItemController::class, 'linkItemUpdate'])->name('vPage.linkItemUpdate');
        Route::post('link-items-update', [VBasicLinkItemController::class, 'linkItemsUpdate'])->name('vPage.linkItemsUpdate');

    });

    Route::group(['prefix' => 'v-layouts', 'middleware' => 'auth:sanctum'], function() {
        Route::get('/{themeName}', [VLayoutController::class, 'availableLayouts'])->name('vLayout.availableLayouts');


    });

    Route::group(['prefix' => 'v-event-track'], function() {
        Route::post('event-create', [VTrackEventController::class, 'eventCreate'])->name('vTrackEvent.create');
        Route::post('get-week-data', [VTrackEventController::class, 'getWeekData'])->name('vTrackEvent.getWeekData');

    });

});

