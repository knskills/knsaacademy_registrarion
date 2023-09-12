<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AudienceController;
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
Route::post('/audience', [AudienceController::class, 'store'])->name('audience.store');
Route::get('/audience', [AudienceController::class, 'index'])->name('audience.index');
Route::get('/audience/{audience}', [AudienceController::class, 'show'])->name('audience.show');
Route::get('/audience/{audience}/edit', [AudienceController::class, 'edit'])->name('audience.edit');
Route::put('/audience/{audience}', [AudienceController::class, 'update'])->name('audience.update');
Route::delete('/audience/{audience}', [AudienceController::class, 'destroy'])->name('audience.destroy');


Auth::routes();

Route::get('register', function () {
    return redirect('/');
})->name('register');

Route::get('/home', [App\Http\Controllers\AudienceController::class, 'index'])->name('home');

// Clear Cache
Route::get('clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    return "Cleared!";
});

Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');
