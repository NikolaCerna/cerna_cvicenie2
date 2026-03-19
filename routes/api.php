<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\CategoryApiController;
use Illuminate\Support\Facades\Route;

Route::apiResource('notes', NoteController::class);
Route::apiResource('categories', CategoryApiController::class);


Route::get('notes/stats/status', [NoteController::class, 'statsByStatus']);

Route::patch('notes/actions/archive-old-drafts', [NoteController::class, 'archiveOldDrafts']);

Route::get('users/{userId}/notes', [NoteController::class, 'userNotesWithCategories']);

Route::get('notes-actions/search', [NoteController::class, 'search']);

Route::patch('notes/{id}/publish', [NoteController::class, 'publish']);

Route::patch('notes/{id}/pin', [NoteController::class, 'pin']);

Route::patch('notes/{id}/unpin', [NoteController::class, 'unpin']);

Route::get('notes/actions/pinned', [NoteController::class, 'pinnedNotes']);
