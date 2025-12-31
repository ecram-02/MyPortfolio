<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\NotificationController;

    // Frontend Routes (Public)
    Route::get('/', [FrontendController::class, 'index'])->name('home');
    Route::get('/article/{slug}', [FrontendController::class, 'showArticle'])->name('frontend.article');
    Route::get('/project/{id}', [FrontendController::class, 'showProject'])->name('frontend.project');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    // Technical Expertise
    Route::resource('skills', SkillController::class);

    // Article Management
    Route::resource('articles', ArticleController::class);
    Route::post('/articles/upload-image', [ArticleController::class, 'uploadImage'])
         ->name('articles.upload-image');
    

    // Publication Management
    Route::resource('publications', PublicationController::class);

    // Research Management
    Route::resource('researches', ResearchController::class);

    // Projects Management
    Route::resource('projects', ProjectController::class);

    // Notifications
    Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
        Route::post('/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
        Route::post('/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
        Route::get('/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unread-count');
    });

    // Messages
    Route::prefix('messages')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('messages.index');
        Route::post('/send', [MessageController::class, 'send'])->name('messages.send');
        Route::post('/{id}/read', [MessageController::class, 'markAsRead'])->name('messages.read');
        Route::get('/unread-count', [MessageController::class, 'getUnreadCount'])->name('messages.unread-count');
        Route::get('/conversation/{userId}', [MessageController::class, 'getConversation'])->name('messages.conversation');
    });

    // Search
    Route::post('/search', [SearchController::class, 'globalSearch'])->name('search.global');

    // Settings
  Route::get('/settings', [SettingController::class,'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class,'update'])->name('settings.update');
});