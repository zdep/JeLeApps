<?php
    use App\Http\Controllers\ApiController;

    Route::post('registration', [ ApiController::class, 'registration']);
    Route::get('profile', [ ApiController::class, 'profile']);
