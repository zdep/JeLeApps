<?php
    use App\Http\Controllers\ApiController;
    use App\Http\Middleware\MyApiAuth;
    use Illuminate\Support\Facades\Route;

    Route::post('/registration', [ ApiController::class, 'registration' ]);

    Route::middleware([ MyApiAuth::class ])->group(function () {
        Route::get('profile', [ ApiController::class, 'profile' ]);
    });
