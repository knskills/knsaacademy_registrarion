<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AudienceController;
use App\Http\Controllers\AutianceSecondController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\LangController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('web.home');
});
Route::view('/mailtest', 'web.resMail');
Route::post('/audience', [AudienceController::class, 'store'])->name('audience.store'); // first
// Route::post('/audience', [AutianceSecondController::class, 'store'])->name('audience.store'); // second
// Route::get('/audience', [AudienceController::class, 'index'])->name('audience.index');
// Route::get('/audience/{audience}', [AudienceController::class, 'show'])->name('audience.show');
// Route::get('/audience/{audience}/edit', [AudienceController::class, 'edit'])->name('audience.edit');
// Route::put('/audience/{audience}', [AudienceController::class, 'update'])->name('audience.update');
// Route::delete('/audience/{audience}', [AudienceController::class, 'destroy'])->name('audience.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AudienceController::class, 'admin'])->name('admin');
    Route::get('/admin/audience', [AudienceController::class, 'adminAudience'])->name('audience');
    Route::get('/admin/audience/{audience}', [AudienceController::class, 'adminShow'])->name('audience.show');
    Route::get('/admin/audience/{audience}/edit', [AudienceController::class, 'adminEdit'])->name('audience.edit');
    Route::put('/admin/audience/{audience}', [AudienceController::class, 'adminUpdate'])->name('audience.update');
    Route::delete('/admin/audience/{audience}', [AudienceController::class, 'adminDestroy'])->name('audience.destroy');
    Route::get('/audiences', [App\Http\Controllers\AudienceController::class, 'index'])->name('audiences');
});

Route::get('/terms', [AudienceController::class, 'terms'])->name('terms');
Route::get('/privacy', [AudienceController::class, 'privacy'])->name('privacy');

Auth::routes();

Route::get('register', function () {
    return redirect('/');
})->name('register');


// Clear Cache
Route::get('clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    return "Cleared!";
});

Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');
