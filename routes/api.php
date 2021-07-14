<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VPageController;
use App\Http\Controllers\Api\VBasicLinkItemController;
use App\Http\Controllers\Api\VLayoutController;

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
Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function() {

    Route::group(['prefix' => 'v-page'], function() {

        Route::post('profile-update', [VPageController::class, 'profileUpdate'])->name('vPage.profileUpdate');
        Route::post('social-links-update', [VPageController::class, 'socialLinksUpdate'])->name('vPage.socialLinksUpdate');
        Route::post('update-page-data', [VPageController::class, 'updatePageData'])->name('vPage.updatePageData');
        Route::get('/ori/{pageId}', [VPageController::class, 'getPageDataOri'])->name('vPage.getPageData');
        Route::post('layout-update', [VPageController::class, 'layoutUpdate'])->name('vPage.layoutUpdate');

    });

    Route::group(['prefix' => 'v-basic-link-item'], function() {
        Route::post('link-item-create', [VBasicLinkItemController::class, 'linkItemStore'])->name('vPage.linkItemStore');
        Route::post('link-item-delete', [VBasicLinkItemController::class, 'linkItemDelete'])->name('vPage.linkItemDelete');
        Route::post('link-item-update', [VBasicLinkItemController::class, 'linkItemUpdate'])->name('vPage.linkItemUpdate');
        Route::post('link-items-update', [VBasicLinkItemController::class, 'linkItemsUpdate'])->name('vPage.linkItemsUpdate');

    });

    Route::group(['prefix' => 'v-layouts'], function() {
        Route::get('/{themeName}', [VLayoutController::class, 'availableLayouts'])->name('vLayout.availableLayouts');


    });

});

