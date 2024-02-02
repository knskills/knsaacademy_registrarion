<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AudienceController;
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
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return "Cleared!";
});


Route::view('/mailtest', 'web.resMail');
Route::post('/audience', [AudienceController::class, 'store'])->name('audience.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

    Route::resource('audiences', AudienceController::class);
    Route::get('/audience/export', [AudienceController::class, 'export'])->name('audiences.export');
    Route::post('/audience/import', [AudienceController::class, 'import'])->name('audiences.import');
    Route::get('/get-audience', [AudienceController::class, 'getAudiance'])->name('get-audience');

    Route::resource('events', EventController::class);
    Route::get('/get-events', [EventController::class, 'getEvents'])->name('get-events');

    Route::resource('messages', MessageController::class);
    Route::resource('templates', TemplateController::class);
    Route::get('/get-templates', [TemplateController::class, 'getTemplates'])->name('get-templates');
    Route::get('/get-message', [TemplateController::class, 'getTemplateMessage'])->name('get-message');
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

// send mail
// Route::get('/send-mail', [PageController::class, 'sendTestEmail'])->name('send-mail');
Route::view('admin.mails.temp', 'admin.mails.temp');

Route::get('/beginnertobillionaire', [PageController::class, 'beginnertobillionaire'])->name('beginnertobillionaire');
// Route::get('/', [PageController::class, 'sales'])->name('sales');
Route::get('/beginnerobillionaire', [PageController::class, 'billionaire'])->name('billionaire');

Route::get('/', function () {
    return redirect('/beginnerobillionaire');
});
