<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\VPageController;
use App\Http\Controllers\Admin\VPageController as AdminVPageController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\VBlogPostController as AdminVBlogPostController;
use App\Http\Controllers\Admin\VLayoutController as AdminVLayoutController;
use App\Http\Controllers\Admin\VBlogCategoryController as AdminVBlogCategoryController;
use App\Http\Controllers\PaySubscriptionController;
use App\Http\Controllers\VWebController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [VWebController::class, 'home']);

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/subscription', [PaySubscriptionController::class, 'subscriptionPage']);

Route::group(['prefix' => 'v-page', 'middleware' => 'auth'], function() {

    Route::get('design', [VPageController::class, 'pageDesign'])->name('vPage.pageDesign');
    Route::get('list', [VPageController::class, 'pageList'])->name('vPage.pageList');
    Route::get('url', [VPageController::class, 'createAndSetUrlForm'])->name('vPage.setUrl');
    Route::post('confirm-url-and-store', [VPageController::class, 'confirmUrlAndStore'])->name('vPage.confirmUrlAndStore');
    Route::get('theme-select/{pageId}', [VPageController::class, 'themeSelectForm'])->name('vPage.themeSelectForm');
    Route::post('theme-confirm/{pageId}', [VPageController::class, 'confirmTheme'])->name('vPage.confirmTheme');

});

Route::group(['prefix' => 'v-subscription', 'middleware' => 'auth'], function() {
    Route::post('period/pay-subscription', [PaySubscriptionController::class, 'paySubscription'])->name('subscription.pay');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/theme/VBasic', [ThemeController::class, 'design']);

Route::get('/test', [SocialController::class, 'test']);
Route::get('/auth/redirect/{provider}', [SocialController::class, 'redirect']);
Route::get('/callback/{provider}', [SocialController::class, 'callback']);


require __DIR__.'/auth.php';

Route::get('/{pageUrl}', [VPageController::class, 'personalPage'])->name('personalPage');




Route::group(['prefix' => 'v-admin', 'middleware' => ['auth', 'is_admin']], function() {

    Route::get('dashboard', function () {
        return view('components.admin.dashboard.index');
    })->name('admin.dashboard');

    Route::group(['prefix' => 'v-page'], function() {
        Route::get('list', [AdminVPageController::class, 'list'])->name('admin.vPage.list');
        Route::get('/{page_id}', [AdminVPageController::class, 'show'])->name('admin.vPage.show');
        Route::post('/{page_id}/update', [AdminVPageController::class, 'update'])->name('admin.vPage.update');
    });

    Route::group(['prefix' => 'user'], function() {
        Route::get('list', [AdminUserController::class, 'list'])->name('admin.user.list');
        Route::get('/{user_id}', [AdminUserController::class, 'show'])->name('admin.user.show');
        Route::post('/{user_id}/update', [AdminUserController::class, 'update'])->name('admin.user.update');
    });

    Route::group(['prefix' => 'v-blog-post'], function() {
        Route::get('list', [AdminVBlogPostController::class, 'list'])->name('admin.vBlogPost.list');
        Route::get('create', [AdminVBlogPostController::class, 'create'])->name('admin.vBlogPost.create');
        Route::post('store', [AdminVBlogPostController::class, 'store'])->name('admin.vBlogPost.store');
        Route::get('/{post_id}/edit', [AdminVBlogPostController::class, 'edit'])->name('admin.vBlogPost.edit');
        Route::post('/{post_id}/update', [AdminVBlogPostController::class, 'update'])->name('admin.vBlogPost.update');
    });

    Route::group(['prefix' => 'v-blog-category'], function() {
        Route::get('list', [AdminVBlogCategoryController::class, 'list'])->name('admin.vBlogCategory.list');
        Route::get('create', [AdminVBlogCategoryController::class, 'create'])->name('admin.vBlogCategory.create');
        Route::post('store', [AdminVBlogCategoryController::class, 'store'])->name('admin.vBlogCategory.store');
        Route::get('/{cate_id}/edit', [AdminVBlogCategoryController::class, 'edit'])->name('admin.vBlogCategory.edit');
        Route::post('/{cate_id}/update', [AdminVBlogCategoryController::class, 'update'])->name('admin.vBlogCategory.update');
    });

    Route::group(['prefix' => 'v-layout'], function() {
        Route::get('list', [AdminVLayoutController::class, 'list'])->name('admin.vLayout.list');
        Route::get('create', [AdminVLayoutController::class, 'create'])->name('admin.vLayout.create');
        Route::post('store', [AdminVLayoutController::class, 'store'])->name('admin.vLayout.store');
        Route::get('/{layout_id}/edit', [AdminVLayoutController::class, 'edit'])->name('admin.vLayout.edit');
        Route::post('/{layout_id}/update', [AdminVLayoutController::class, 'update'])->name('admin.vLayout.update');
    });
});
