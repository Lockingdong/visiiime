<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\VPageController;



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

Route::get('/', function () {
    return view('welcome');
});





Route::group(['prefix' => 'v-page', 'middleware' => 'auth'], function() {

    Route::get('design', [VPageController::class, 'pageDesign'])->name('vPage.pageDesign');
    Route::get('list', [VPageController::class, 'pageList'])->name('vPage.pageList');
    Route::get('url', [VPageController::class, 'createAndSetUrlForm'])->name('vPage.setUrl');
    Route::post('confirm-url-and-store', [VPageController::class, 'confirmUrlAndStore'])->name('vPage.confirmUrlAndStore');
    Route::get('theme-select/{pageId}', [VPageController::class, 'themeSelectForm'])->name('vPage.themeSelectForm');
    Route::post('theme-confirm/{pageId}', [VPageController::class, 'confirmTheme'])->name('vPage.confirmTheme');

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
