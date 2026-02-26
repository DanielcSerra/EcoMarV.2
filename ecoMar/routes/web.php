<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\CommentController;

use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\EventSuggestionController;
use App\Http\Controllers\SponsorSignupController;
use App\Http\Controllers\SponsorController;

use App\Http\Controllers\TestimonyController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CampaignAdminController;
use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Admin\DonationAdminController;
use App\Http\Controllers\Admin\EventAdminController;
use App\Http\Controllers\Admin\EventCategoryAdminController;
use App\Http\Controllers\Admin\EventRegistrationAdminController;
use App\Http\Controllers\Admin\EventSuggestionAdminController;
use App\Http\Controllers\Admin\NewsAdminController;
use App\Http\Controllers\Admin\NewsCategoryAdminController;
use App\Http\Controllers\Admin\NewsletterAdminController;
use App\Http\Controllers\Admin\SponsorAdminController;
use App\Http\Controllers\Admin\SponsorCategoryAdminController;
use App\Http\Controllers\Admin\SponsorSignupAdminController;
use App\Http\Controllers\Admin\TestimonyAdminController;
use App\Http\Controllers\Admin\CommentAdminController;
use App\Http\Controllers\Admin\UserAdminController;


/*
|--------------------------------------------------------------------------
| Auth + Email Verification
|--------------------------------------------------------------------------
|
*/

Auth::routes(['verify' => true]);

Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'Enviámos um novo email de verificação.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


/*
|--------------------------------------------------------------------------
| Páginas públicas (estáticas)
|--------------------------------------------------------------------------
*/
Route::get('/', [IndexController::class, 'index'])->name('home');
Route::view('/sobre-nos', 'sobrenos')->name('sobre-nos');
Route::view('/equipa', 'equipa')->name('equipa');
Route::view('/termos', 'termos')->name('termos');
Route::view('/maremrisco', 'maremrisco')->name('maremrisco');
Route::view('/como-ajudar', 'comoajudar')->name('como-ajudar');

Route::view('/contactos', 'contactos')->name('contactos');
Route::view('/faq', 'faq')->name('faq');
Route::view('/cookies', 'cookies')->name('cookies');

Route::get('/home', fn() => redirect()->route('home'))->name('dashboard');

/*
|--------------------------------------------------------------------------
| Páginas públicas (dinâmicas)
|--------------------------------------------------------------------------
*/
Route::get('/doar', [DonationController::class, 'index'])->name('doar');
Route::get('/eventos', [EventsController::class, 'index'])->name('eventos');
Route::get('/noticias', [NewsController::class, 'index'])->name('noticias');
Route::get('/noticias/{id}/comentarios', [CommentController::class, 'show'])->name('noticias.comentarios');
Route::get('/campanhas', [CampaignController::class, 'index'])->name('campanhas');

Route::get('/voluntarios', [TestimonyController::class, 'index'])->name('voluntarios');
Route::get('/voluntarios/depoimentos', [TestimonyController::class, 'all'])->name('voluntarios.depoimentos.all');

Route::post('/comentarios/store', [CommentController::class, 'store'])->name('coments.store');

Route::post('/voluntarios/testimonies', [TestimonyController::class, 'store'])
    ->middleware('auth')
    ->name('voluntarios.testimonies.store');

Route::get('/patrocinadores', [SponsorController::class, 'index'])
    ->name('patrocinadores');
Route::get('/patrocinar', [SponsorController::class, 'form'])
    ->name('patrocinar');


Route::post('/patrocinar', [SponsorController::class, 'store'])
    ->name('sponsor.submit');

Route::post('/comentarios', [CommentController::class, 'store'])
    ->name('comentarios.store');





/*
|--------------------------------------------------------------------------
| Resources públicos
|--------------------------------------------------------------------------
|
*/

Route::get('/campaigns/load-more', [CampaignController::class, 'loadMore'])->name('campaigns.loadMore');
Route::resource('campaigns', CampaignController::class)->only(['show']);



Route::resource('news', NewsController::class)->only(['index', 'show']);

Route::resource('contacts', ContactController::class)->only(['store']);
Route::resource('donations', DonationController::class)->only(['store']);
Route::resource('newsletters', NewsletterController::class)->only(['store']);

/*
|--------------------------------------------------------------------------
| Rotas autenticadas (utilizador normal)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('event-registrations', EventRegistrationController::class)->only(['store', 'destroy']);
    Route::resource('event-suggestions', EventSuggestionController::class)->only(['create', 'store']);
    Route::resource('sponsor-signups', SponsorSignupController::class)->only(['create', 'store']);
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::prefix('_admin')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::post('sponsor-signups/{signup}/approve', [SponsorSignupAdminController::class, 'approve'])
            ->name('sponsor-signups.approve');
        Route::resource('sponsor-signups', SponsorSignupAdminController::class);
        Route::resource('users', UserAdminController::class);
        Route::resource('users', UserAdminController::class);
        Route::resource('event-categories', EventCategoryAdminController::class);
        Route::resource('events', EventAdminController::class);
        Route::resource('event-registrations', EventRegistrationAdminController::class);
        Route::resource('event-suggestions', EventSuggestionAdminController::class);
        Route::resource('campaigns', CampaignAdminController::class);
        Route::resource('news-categories', NewsCategoryAdminController::class);
        Route::resource('news', NewsAdminController::class);
        Route::resource('comments', CommentAdminController::class);
        Route::resource('sponsor-categories', SponsorCategoryAdminController::class);
        Route::resource('sponsors', SponsorAdminController::class);
        Route::resource('contacts', ContactAdminController::class);
        Route::resource('donations', DonationAdminController::class);
        Route::resource('newsletters', NewsletterAdminController::class);
        Route::resource('testimonies', TestimonyAdminController::class);
    });
