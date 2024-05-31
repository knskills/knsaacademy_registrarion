<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AudienceController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\WhatsappController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\WebhookController;

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
Route::post('/payment/response', [AudienceController::class, 'handlePaymentResponse'])->name('payment.response');

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
    // Route::resource('chat', ChatController::class);

    Route::group(['prefix' => 'whatsapp', 'as' => 'whatsapp.'], function () {
        Route::resource('chat', ChatController::class);
    });


    // Whatsapp Cloud Api

    //================================== Whatsapp Api ====================
    // profile
    Route::post('/whatsapp/update-profile', [WhatsappController::class, 'updateProfile'])->name('whatsapp.update-profile');
    Route::get('/whatsapp/setting', [WhatsappController::class, 'create'])->name('whatsapp.setting');
    Route::get('/whatsapp/get-profile', [WhatsappController::class, 'getProfile'])->name('whatsapp.get-profile');
    Route::get('/whatsapp/getSubscribedApps', [WhatsappController::class, 'getSubscribedApps'])->name('whatsapp.getSubscribedApps');
    Route::get('/whatsapp/getMessageTemplate/{templateName}', [WhatsappController::class, 'getMessageTemplate'])->name('whatsapp.getMessageTemplates');

    // Message
    Route::post('/whatsapp/text-message', [WhatsappController::class, 'sendTextMessage'])->name('whatsapp.text-message');

    Route::post('/whatsapp/send-message', [WhatsappController::class, 'sendMessage'])->name('whatsapp.send-message');

    // Mark as a read
    Route::get('/whatsapp/mark-as-read/{messageid}', [WhatsappController::class, 'markAsRead'])->name('whatsapp.mark-as-read');

    //testing msg
    Route::get('/send-message', [PageController::class, 'sendFBMessage'])->name('sendMessage');
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
Route::get('/registration', [PageController::class, 'registration'])->name('registration');
// Route::get('/send-message', [PageController::class, 'sendMessage'])->name('sendMessage');

// send mail
Route::view('admin.mails.temp', 'admin.mails.temp');

Route::get('/beginnertobillionaire', [PageController::class, 'beginnertobillionaire'])->name('beginnertobillionaire');
Route::get('/beginnerobillionaire', [PageController::class, 'billionaire'])->name('billionaire');

Route::get('/', function () {
    return redirect('/beginnerobillionaire');
});

// webhook routes
Route::match(['get', 'post'], '/webhook', [WebhookController::class, 'setupWebhook']);
// Route::match(['get', 'post'], '/webhook', [WhatsappController::class, 'setupWebhook']);
