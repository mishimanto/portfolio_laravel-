<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InterestController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ResumeController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Notifications
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/list', [NotificationController::class, 'list'])->name('list');
        Route::patch('/{id}/read', [NotificationController::class, 'markAsRead'])->name('read');
        Route::patch('/mark-all/read', [NotificationController::class, 'markAllAsRead'])->name('mark-all-read');
        Route::get('/unread-count', [NotificationController::class, 'getUnreadCount'])->name('unread-count');
    });

    // About routes
    Route::prefix('about')->name('about.')->group(function () {
        Route::get('/', [AboutController::class, 'index'])->name('index');
        Route::put('/', [AboutController::class, 'updateAbout'])->name('update');
        Route::post('/personal-info', [AboutController::class, 'addPersonalInfo'])->name('personal-info.store');
        Route::put('/personal-info/{id}', [AboutController::class, 'updatePersonalInfo'])->name('personal-info.update');
        Route::delete('/personal-info/{id}', [AboutController::class, 'deletePersonalInfo'])->name('personal-info.destroy');
    });

    // Skills routes
    Route::resource('skills', SkillController::class)->except(['show']);
    Route::post('/skills/reorder', [SkillController::class, 'reorder'])->name('skills.reorder');

    // Interests routes
    Route::resource('interests', InterestController::class)->except(['show']);
    Route::post('/interests/reorder', [InterestController::class, 'reorder'])->name('interests.reorder');

    // Resume routes
    Route::prefix('resume')->name('resume.')->group(function () {
        Route::get('/', [ResumeController::class, 'index'])->name('index');
        Route::post('/education', [ResumeController::class, 'storeEducation'])->name('education.store');
        Route::put('/education/{id}', [ResumeController::class, 'updateEducation'])->name('education.update');
        Route::delete('/education/{id}', [ResumeController::class, 'destroyEducation'])->name('education.destroy');
        Route::post('/experience', [ResumeController::class, 'storeExperience'])->name('experience.store');
        Route::put('/experience/{id}', [ResumeController::class, 'updateExperience'])->name('experience.update');
        Route::delete('/experience/{id}', [ResumeController::class, 'destroyExperience'])->name('experience.destroy');
        Route::post('/education/reorder', [ResumeController::class, 'reorderEducation'])->name('education.reorder');
        Route::post('/experience/reorder', [ResumeController::class, 'reorderExperience'])->name('experience.reorder');
    });

    // Services routes
    Route::resource('services', ServiceController::class)->except(['show']);
    Route::post('/services/reorder', [ServiceController::class, 'reorder'])->name('services.reorder');

    // Portfolio routes
    Route::resource('portfolio', PortfolioController::class)->except(['show']);
    Route::post('/portfolio/reorder', [PortfolioController::class, 'reorder'])->name('portfolio.reorder');

    // Categories routes
    Route::resource('categories', CategoryController::class)->except(['show']);

    // Contact routes
    Route::prefix('contact')->name('contact.')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::put('/info', [ContactController::class, 'updateInfo'])->name('info.update');
        Route::get('/message/{id}', [ContactController::class, 'viewMessage'])->name('message.view');
        Route::delete('/message/{id}', [ContactController::class, 'destroyMessage'])->name('message.destroy');
        Route::patch('/message/{id}/read', [ContactController::class, 'markAsRead'])->name('message.read');
    });

    // Settings routes
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::put('/', [SettingController::class, 'update'])->name('update');

        // Social Media
        Route::prefix('social-media')->name('social-media.')->group(function () {
            Route::post('/', [SocialMediaController::class, 'store'])->name('store');
            Route::put('/{id}', [SocialMediaController::class, 'update'])->name('update');
            Route::delete('/{id}', [SocialMediaController::class, 'destroy'])->name('destroy');
            Route::patch('/{id}/toggle', [SocialMediaController::class, 'toggleStatus'])->name('toggle');
            Route::post('/reorder', [SocialMediaController::class, 'reorder'])->name('reorder');
        });


        Route::prefix('counters')->name('counters.')->group(function () {
            Route::post('/', [CounterController::class, 'store'])->name('store');
            Route::put('/{id}', [CounterController::class, 'update'])->name('update');
            Route::delete('/{id}', [CounterController::class, 'destroy'])->name('destroy');
            Route::post('/reorder', [CounterController::class, 'reorder'])->name('reorder');
        });
    });

    // Profile routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/change-password', function () {
            return view('admin.profile.change-password');
        })->name('change-password');
    });
});
