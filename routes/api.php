<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1');
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/logout-all', [AuthController::class, 'logoutAll']);
        Route::post('/change-password', [AuthController::class, 'changePassword']);
        Route::put('/profile', [AuthController::class, 'updateProfile']);
    });
    Route::middleware(['auth:sanctum','verified'])->group(function () {

        Route::get('/verified', function () {
            return 'OK';
        });

    });
});

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('categories', CategoryApiController::class)
        ->only(['index','show']);

    Route::middleware('admin')->group(function () {

        Route::apiResource('categories', CategoryApiController::class)
            ->except(['index','show']);

    });

});

Route::apiResource('notes', NoteController::class);
Route::apiResource('notes.tasks', TaskController::class);

Route::get('notes/stats/status', [NoteController::class, 'statsByStatus']);

Route::patch('notes/actions/archive-old-drafts', [NoteController::class, 'archiveOldDrafts']);

Route::get('users/{userId}/notes', [NoteController::class, 'userNotesWithCategories']);

Route::get('notes-actions/search', [NoteController::class, 'search']);

Route::patch('notes/{id}/publish', [NoteController::class, 'publish']);

Route::patch('notes/{id}/pin', [NoteController::class, 'pin']);

Route::patch('notes/{id}/unpin', [NoteController::class, 'unpin']);

Route::get('notes/actions/pinned', [NoteController::class, 'pinnedNotes']);
