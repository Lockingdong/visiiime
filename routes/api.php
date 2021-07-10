<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VPageController;
use App\Http\Controllers\Api\VBasicLinkItemController;

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

Route::group(['prefix' => 'v1'], function() {

    Route::group(['prefix' => 'v-page'], function() {

        Route::post('update-page-data', [VPageController::class, 'updatePageData'])->name('vPage.updatePageData');
        Route::get('/ori/{pageId}', [VPageController::class, 'getPageDataOri'])->name('vPage.getPageData');

    });

    Route::group(['prefix' => 'v-basic-link-item'], function() {
        Route::post('link-item-create', [VBasicLinkItemController::class, 'linkItemStore'])->name('vPage.linkItemStore');
        Route::post('link-item-delete', [VBasicLinkItemController::class, 'linkItemDelete'])->name('vPage.linkItemDelete');
        Route::post('link-item-update', [VBasicLinkItemController::class, 'linkItemUpdate'])->name('vPage.linkItemUpdate');

    });

});

