<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\VPageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\VPageController as AdminVPageController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\VBlogPostController as AdminVBlogPostController;
use App\Http\Controllers\Admin\VLayoutController as AdminVLayoutController;
use App\Http\Controllers\Admin\VFileController as AdminVFileController;
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


// Route::get('/subscription', [PaySubscriptionController::class, 'subscriptionPage']);

Route::group(['prefix' => 'v-page', 'middleware' => 'auth'], function() {

    Route::get('design', [VPageController::class, 'pageDesign'])->name('vPage.pageDesign');
    Route::get('list', [VPageController::class, 'pageList'])->name('vPage.pageList');
    Route::get('url', [VPageController::class, 'createAndSetUrlForm'])->name('vPage.setUrl');
    Route::post('confirm-url-and-store', [VPageController::class, 'confirmUrlAndStore'])->name('vPage.confirmUrlAndStore');
    Route::get('theme-select/{pageId}', [VPageController::class, 'themeSelectForm'])->name('vPage.themeSelectForm');
    Route::post('theme-confirm/{pageId}', [VPageController::class, 'confirmTheme'])->name('vPage.confirmTheme');

});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth']], function() {
    Route::group(['prefix' => 'v-dashboard'], function() {
        Route::get('/', [DashboardController::class, 'home'])->name('dashboard');
        Route::get('user-setting', [DashboardController::class, 'userSetting'])->name('dashboard.userSetting');
        Route::get('user-subscription-record', [DashboardController::class, 'userSubscriptionRecord'])->name('dashboard.userSubscriptionRecord');
    });
});

Route::get('/theme/VBasic', [ThemeController::class, 'design']);

Route::get('/test', [SocialController::class, 'test']);
Route::get('/auth/redirect/{provider}', [SocialController::class, 'redirect']);
Route::get('/callback/{provider}', [SocialController::class, 'callback']);


require __DIR__.'/auth.php';

Route::get('/memory-leak', function() {
    global $previous;
    $current = memory_get_usage();
    $stats = [
        'prev_mem' => $previous,
        'curr_mem' => $current,
        'diff_mem' => $current - $previous,
    ];
    $previous = $current;
    return $stats;
});

Route::get('/about', [VWebController::class, 'about'])->name('about');
Route::get('/privacy', [VWebController::class, 'privacy'])->name('privacy');
Route::get('/terms', [VWebController::class, 'terms'])->name('terms');
Route::get('/contact', [VWebController::class, 'contact'])->name('contact');
Route::get('/pricing', [VWebController::class, 'pricing'])->name('pricing');
Route::get('/select-plan', [VWebController::class, 'selectPlan'])->name('selectPlan');
Route::get('/help', [VWebController::class, 'help'])->name('help');
Route::get('/blog', [VWebController::class, 'blogList'])->name('blogList');
Route::get('/blog/{id}', [VWebController::class, 'blogShow'])->name('blogShow');

Route::group(['prefix' => 'v-subscription', 'middleware' => 'auth'], function() {
    Route::post('period/pay-subscription', [PaySubscriptionController::class, 'paySubscription'])->name('subscription.pay');
    Route::post('period/terminate-subscription', [PaySubscriptionController::class, 'terminateSubscription'])->name('subscription.terminate');
});



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

    Route::group(['prefix' => 'v-file'], function() {
        Route::get('list', [AdminVFileController::class, 'list'])->name('admin.vFile.list');
        Route::delete('/{file_id}/destroy', [AdminVFileController::class, 'destroy'])->name('admin.vFile.destroy');
    });
});
