<?php

use App\Http\Controllers\FocusArtistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/artists/{slug}', [FocusArtistController::class, 'getArtist']);
Route::post('/artists', [FocusArtistController::class, 'getFilteredArtists']);
