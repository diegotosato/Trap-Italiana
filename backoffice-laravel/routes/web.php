<?php

use App\Http\Controllers\ArtistController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('artists', ArtistController::class);
});
