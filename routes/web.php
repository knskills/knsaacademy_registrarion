<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AudienceController;
use App\Http\Controllers\AutianceSecondController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TemplateController;
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

// Clear Cache
Route::get('clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    return "Cleared!";
});


Route::view('/mailtest', 'web.resMail');
Route::post('/audience', [AudienceController::class, 'store'])->name('audience.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AudienceController::class, 'dashboard'])->name('dashboard');
    Route::post('/sendMobileSms', [MessageController::class, 'sendMobileSms'])->name('sendMobileSms');
    Route::get('/create-message', [MessageController::class, 'create'])->name('create-message');
    Route::resource('audiences', AudienceController::class);
    Route::get('/audience/export', [AudienceController::class, 'export'])->name('audiences.export');
    Route::post('/audience/import', [AudienceController::class, 'import'])->name('audiences.import');
    Route::resource('events', EventController::class);
    Route::resource('messages', MessageController::class);
    Route::resource('templates', TemplateController::class);
});



Auth::routes();
Route::get('register', function () {
    return redirect('/');
})->name('register');


//======================= Pages =======================//
Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/whatsapp', [PageController::class, 'whatsapp'])->name('whatsapp');

Route::get('/beginnertobillionaire', [PageController::class, 'beginnertobillionaire'])->name('beginnertobillionaire');
// Route::get('/', [PageController::class, 'sales'])->name('sales');
Route::get('/beginnerobillionaire', [PageController::class, 'billionaire'])->name('billionaire');

Route::get('/', function () {
    return redirect('/beginnerobillionaire');
});
