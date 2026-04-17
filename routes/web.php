<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Admin auth (no locale prefix)
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin panel (protected, no locale prefix)
Route::middleware(['auth', 'admin-locale'])->prefix('admin')->name('admin.')->group(function () {
    Route::put('/locale', [AdminController::class, 'updateLocale'])->name('locale.update');

    Route::middleware('section:dashboard')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    });

    Route::middleware('section:analytics')->group(function () {
        Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
        Route::get('/analytics/data', [AdminController::class, 'analyticsData'])->name('analytics.data');
        Route::get('/analytics/visitors', [AdminController::class, 'analyticsVisitors'])->name('analytics.visitors');
        Route::get('/analytics/visitor/{sessionId}', [AdminController::class, 'analyticsVisitorDetail'])->name('analytics.visitor');
    });

    Route::middleware('section:contacts')->group(function () {
        Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts');
        Route::get('/contacts/{contact}', [AdminController::class, 'showContact'])->name('contacts.show');
        Route::post('/contacts/{contact}/archive', [AdminController::class, 'archiveContact'])->name('contacts.archive');
        Route::post('/contacts/{contact}/unarchive', [AdminController::class, 'unarchiveContact'])->name('contacts.unarchive');
        Route::post('/contacts/{contact}/reply', [AdminController::class, 'replyToContact'])->name('contacts.reply');
        Route::post('/contacts/{contact}/reschedule', [AdminController::class, 'rescheduleContact'])->name('contacts.reschedule');
        Route::get('/contacts-archives', [AdminController::class, 'archivedContacts'])->name('contacts.archived');
    });

    Route::middleware('section:password')->group(function () {
        Route::get('/password', [AdminController::class, 'editPassword'])->name('password');
        Route::put('/password', [AdminController::class, 'updatePassword'])->name('password.update');
    });

    Route::middleware('section:smtp')->group(function () {
        Route::get('/smtp', [AdminController::class, 'smtpSettings'])->name('smtp');
        Route::put('/smtp', [AdminController::class, 'updateSmtp'])->name('smtp.update');
        Route::post('/smtp/test', [AdminController::class, 'testSmtp'])->name('smtp.test');
    });

    Route::middleware('section:calendar')->group(function () {
        Route::get('/calendar', [AdminController::class, 'calendar'])->name('calendar');
        Route::get('/calendar/events', [AdminController::class, 'calendarEvents'])->name('calendar.events');
        Route::post('/appointments/{appointment}/cancel', [AdminController::class, 'cancelAppointment'])->name('appointments.cancel');
    });

    Route::middleware('section:schedule')->group(function () {
        Route::get('/schedule', [AdminController::class, 'scheduleSettings'])->name('schedule');
        Route::put('/schedule', [AdminController::class, 'updateSchedule'])->name('schedule.update');
    });

    Route::middleware('section:users')->group(function () {
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
        Route::get('/permissions', [AdminController::class, 'permissions'])->name('permissions');
        Route::put('/permissions', [AdminController::class, 'updatePermissions'])->name('permissions.update');
    });

    Route::middleware('section:files')->group(function () {
        Route::get('/files', [FileController::class, 'index'])->name('files');
        Route::post('/files/upload', [FileController::class, 'upload'])->name('files.upload');
        Route::get('/files/{file}/download', [FileController::class, 'download'])->name('files.download');
        Route::get('/files/{file}/stream', [FileController::class, 'stream'])->name('files.stream');
        Route::get('/files/{file}/preview', [FileController::class, 'preview'])->name('files.preview');
        Route::put('/files/{file}/share', [FileController::class, 'share'])->name('files.share');
        Route::delete('/files/{file}/unshare/{target}', [FileController::class, 'unshare'])->name('files.unshare');
        Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy');
    });
});

// Frontend routes (shared definition)
$frontendRoutes = function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');

    // Product pages
    Route::get('/fonctionnalites', [PageController::class, 'fonctionnalites'])->name('fonctionnalites');
    Route::get('/tarifs', [PageController::class, 'tarifs'])->name('tarifs');
    Route::get('/nous-contacter', [PageController::class, 'contact'])->name('contact');

    // Product pages
    Route::get('/scenarios', [PageController::class, 'scenarios'])->name('scenarios');
    Route::get('/softphone', [PageController::class, 'softphone'])->name('softphone');

    // Legal pages
    Route::get('/conditions-generales-utilisation', [PageController::class, 'cgu'])->name('legal.cgu');
    Route::get('/conditions-generales-vente', [PageController::class, 'cgv'])->name('legal.cgv');
    Route::get('/politique-de-confidentialite', [PageController::class, 'confidentialite'])->name('legal.confidentialite');
};

// API
Route::get('/api/available-slots', [PageController::class, 'availableSlots'])->name('api.available-slots');
Route::post('/api/visit-duration', [PageController::class, 'visitDuration'])->name('api.visit-duration');

// Client area (no locale prefix)
Route::prefix('espace-client')->group(function () {
    Route::get('/login', [ClientAuthController::class, 'showLogin'])->name('client.login');
    Route::post('/login', [ClientAuthController::class, 'login']);
    Route::get('/setup/{token}', [ClientAuthController::class, 'showSetup'])->name('client.setup');
    Route::post('/setup/{token}', [ClientAuthController::class, 'setup']);
    Route::post('/logout', [ClientAuthController::class, 'logout'])->name('client.logout');
    Route::middleware(['auth:client', 'client-locale'])->group(function () {
        Route::get('/', [ClientAuthController::class, 'dashboard'])->name('client.dashboard');
        Route::get('/demande/{contact}', [ClientAuthController::class, 'showContact'])->name('client.contact.show');
        Route::post('/demande/{contact}/reply', [ClientAuthController::class, 'replyToContact'])->name('client.contact.reply');
        Route::post('/demande/{contact}/reschedule', [ClientAuthController::class, 'rescheduleContact'])->name('client.contact.reschedule');
        Route::put('/locale', [ClientAuthController::class, 'updateLocale'])->name('client.locale.update');
    });
});

// French routes (no prefix)
Route::middleware(['set-locale', 'track-visit'])
    ->group($frontendRoutes);

// Localized routes (EN, ES, DE, PL)
Route::middleware(['set-locale', 'track-visit'])
    ->prefix('{locale}')
    ->where(['locale' => 'en|es|de|pl'])
    ->name('l.')
    ->group($frontendRoutes);
