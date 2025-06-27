<?php
    use App\Http\Controllers\ApiController;
    use App\Http\Middleware\MyApiAuth;
    use Illuminate\Support\Facades\Route;

    Route::middleware([ MyApiAuth::class ])->group(function () {
        Route::get('profile', [ ApiController::class, 'profile' ]);

        Route::get('/registration', [ ApiController::class, 'registration' ])
            ->withoutMiddleware([ MyApiAuth::class ]);
    });
