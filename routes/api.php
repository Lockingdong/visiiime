<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VPageController;
use App\Http\Controllers\Api\VFileController;
use App\Http\Controllers\Api\VBasicLinkItemController;
use App\Http\Controllers\Api\VLayoutController;
use App\Http\Controllers\Api\VTrackEventController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\PaySubscriptionController;
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

    Route::post('redirect-dashboard', function() {
        return redirect()->route('dashboard');
    });


    Route::group(['prefix' => 'user', 'middleware' => 'auth:sanctum'], function() {
        Route::post('logout', [UserController::class, 'logout'])->name('api-user.logout');
        Route::post('verify-email', [UserController::class, 'verifyEmail'])->name('api-user.verifyEmail')->middleware(['throttle:1,1']);
    });

    Route::group(['prefix' => 'v-page', 'middleware' => 'auth:sanctum'], function() {

        Route::get('test/{pageId}', [VPageController::class, 'test'])->name('vPage.pageTest');
        Route::post('page-create', [VPageController::class, 'pageCreate'])->name('vPage.pageCreate');
        Route::post('profile-update', [VPageController::class, 'profileUpdate'])->name('vPage.profileUpdate');
        Route::post('social-links-update', [VPageController::class, 'socialLinksUpdate'])->name('vPage.socialLinksUpdate');
        Route::post('update-page-data', [VPageController::class, 'updatePageData'])->name('vPage.updatePageData');
        Route::get('/ori/{pageId}', [VPageController::class, 'getPageDataOri'])->name('vPage.getPageData');
        Route::post('layout-update', [VPageController::class, 'layoutUpdate'])->name('vPage.layoutUpdate');
        Route::post('custom-data-update', [VPageController::class, 'customDataUpdate'])->name('vPage.customDataUpdate');
        Route::post('page-uri-update', [VPageController::class, 'pageUriUpdate'])->name('vPage.pageUriUpdate');
        Route::post('page-analystic-update', [VPageController::class, 'pageAnalysticUpdate'])->name('vPage.pageAnalysticUpdate');
        Route::post('page-seo-update', [VPageController::class, 'pageSeoUpdate'])->name('vPage.pageSeoUpdate');
        Route::post('page-online-update', [VPageController::class, 'pageOnlineUpdate'])->name('vPage.pageOnlineUpdate');
        Route::post('page-status-update', [VPageController::class, 'pageStatusUpdate'])->name('vPage.pageStatusUpdate');

    });

    Route::group(['prefix' => 'v-file', 'middleware' => 'auth:sanctum'], function() {
        Route::post('image-upload', [VFileController::class, 'imageUpload'])->name('vFile.imageUpload');
    });

    Route::group(['prefix' => 'v-basic-link-item', 'middleware' => 'auth:sanctum'], function() {
        Route::post('link-item-create', [VBasicLinkItemController::class, 'linkItemStore'])->name('vPage.linkItemStore');
        Route::post('link-item-delete', [VBasicLinkItemController::class, 'linkItemDelete'])->name('vPage.linkItemDelete');
        Route::post('link-item-update', [VBasicLinkItemController::class, 'linkItemUpdate'])->name('vPage.linkItemUpdate');
        Route::post('link-item-content-update', [VBasicLinkItemController::class, 'linkItemContentUpdate'])->name('vPage.linkItemContentUpdate');
        Route::post('link-items-order-update', [VBasicLinkItemController::class, 'linkItemsOrderUpdate'])->name('vPage.linkItemsOrderUpdate');
        Route::post('link-item-start-end-time-update', [VBasicLinkItemController::class, 'linkItemStartEndTimeUpdate'])->name('vPage.linkItemStartEndTimeUpdate');
        Route::post('link-item-display-update', [VBasicLinkItemController::class, 'linkItemDisplayUpdate'])->name('vPage.linkItemDisplayUpdate');
        Route::post('link-item-pwd-update', [VBasicLinkItemController::class, 'linkItemPwdUpdate'])->name('vPage.linkItemPwdUpdate');
        Route::post('link-items-update', [VBasicLinkItemController::class, 'linkItemsUpdate'])->name('vPage.linkItemsUpdate');
    });

    Route::group(['prefix' => 'v-layouts', 'middleware' => 'auth:sanctum'], function() {
        Route::get('/{themeName}', [VLayoutController::class, 'availableLayouts'])->name('vLayout.availableLayouts');
    });

    Route::group(['prefix' => 'v-sub-records', 'middleware' => 'auth:sanctum'], function() {
        Route::get('/{mer_order_no}', [DashboardController::class, 'subRecords'])->name('vSubRecords.subRecords');
    });

    Route::group(['prefix' => 'v-event-track'], function() {
        Route::post('event-create', [VTrackEventController::class, 'eventCreate'])->name('vTrackEvent.create');
        Route::post('get-week-data', [VTrackEventController::class, 'getWeekData'])->name('vTrackEvent.getWeekData');

    });

    Route::group(['prefix' => 'v-basic-link-item'], function() {
        Route::post('link-item-check-pwd-correct', [VBasicLinkItemController::class, 'linkItemCheckPwdCorrect'])->name('vPage.linkItemCheckPwdCorrect');
    });

    Route::post('v-subscription/period/callback', [PaySubscriptionController::class, 'paySubscriptionCallback']);

});


