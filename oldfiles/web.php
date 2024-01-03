<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AudienceController;
use App\Http\Controllers\AutianceSecondController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\LangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
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

Route::view('/mailtest', 'web.resMail');
Route::post('/audience', [AudienceController::class, 'store'])->name('audience.store'); // first

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AudienceController::class, 'admin'])->name('admin');
    Route::get('/admin/audience', [AudienceController::class, 'adminAudience'])->name('audience');
    Route::get('/admin/audience/{audience}', [AudienceController::class, 'adminShow'])->name('audience.show');
    Route::get('/admin/audience/{audience}/edit', [AudienceController::class, 'adminEdit'])->name('audience.edit');
    Route::put('/admin/audience/{audience}', [AudienceController::class, 'adminUpdate'])->name('audience.update');
    // Route::delete('/admin/audience/{audience}', [AudienceController::class, 'adminDestroy'])->name('audience.destroy');
    Route::delete('/admin/audience/{audience}', [AudienceController::class, 'destroy'])->name('audience.destroy');
    Route::get('/audiences', [App\Http\Controllers\AudienceController::class, 'index'])->name('audiences');

    Route::resource('events', EventController::class);
});

Route::get('/terms', [AudienceController::class, 'terms'])->name('terms');
Route::get('/privacy', [AudienceController::class, 'privacy'])->name('privacy');
Route::get('/whatsapp', [AudienceController::class, 'whatsapp'])->name('whatsapp');

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


//======================= Pages =======================//
Route::get('/beginnertobillionaire', [PageController::class, 'beginnertobillionaire'])->name('beginnertobillionaire');
// Route::get('/', [PageController::class, 'sales'])->name('sales');
Route::get('/beginnerobillionaire', [PageController::class, 'billionaire'])->name('billionaire');

Route::get('/', function () {
    return redirect('/beginnerobillionaire');
})->name('register');