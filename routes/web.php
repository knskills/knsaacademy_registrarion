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
// Route::post('/audience', [AutianceSecondController::class, 'store'])->name('audience.store'); // second
// Route::get('/audience', [AudienceController::class, 'index'])->name('audience.index');
// Route::get('/audience/{audience}', [AudienceController::class, 'show'])->name('audience.show');
// Route::get('/audience/{audience}/edit', [AudienceController::class, 'edit'])->name('audience.edit');
// Route::put('/audience/{audience}', [AudienceController::class, 'update'])->name('audience.update');
// Route::delete('/audience/{audience}', [AudienceController::class, 'destroy'])->name('audience.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AudienceController::class, 'dashboard'])->name('dashboard');
    // Route::get('/audiences', [AudienceController::class, 'index'])->name('audiences');
    Route::resource('audiences', AudienceController::class);
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

Route::post('/sendMobileSms', [MessageController::class, 'sendMobileSms'])->name('sendMobileSms');
Route::get('/create-message', [MessageController::class, 'create'])->name('create-message');


// Route::view('/nice', 'admin/nice/index');
Route::get('setwer',function(){
    return view('admin/nice/index');
})->name('nice');
