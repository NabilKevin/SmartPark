<?php

use App\Http\Controllers\Authentication;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\User;
use App\Http\Controllers\Dashboard\ParkingBook;
use App\Http\Controllers\Dashboard\Summary;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isUser;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('/register', [Authentication\Post::class, 'register']);
    Route::post('/login', [Authentication\Post::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [Authentication\Get::class, 'me']);
    Route::post('/logout', [Authentication\Post::class, 'logout']);
    Route::put('/update-profile', [Authentication\Put::class, 'update']);

    Route::middleware(isUser::class)->group(function() {
        Route::get('/parking-lots', [User\ParkingLot\Get::class, 'index']);
        Route::get('/parking-histories', [User\ParkingBook\Get::class, 'getParkingHistories']);
        Route::get('/parking-spots/{id}', [User\ParkingSpot\Get::class, 'index']);
        Route::post('/book', [User\ParkingBook\Post::class, 'store']);
        Route::post('/checkout/{id}', [User\ParkingBook\Post::class, 'checkout']);
    });

    Route::middleware(isAdmin::class)->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::get('/summary', [Summary\Get::class, 'index']);
            Route::prefix('parking-lots')->group(function () {
                Route::post('/', [Dashboard\ParkingLot\Post::class, 'store']);
                Route::put('/{id}', [Dashboard\ParkingLot\Put::class, 'update']);
                Route::get('/all', [Dashboard\ParkingLot\Get::class, 'index']);
                Route::get('/', [Dashboard\ParkingLot\Get::class, 'getParkingLotOnly']);
                Route::post('/deactivate/{id}', [Dashboard\ParkingLot\Post::class, 'deactivateParkingLot']);
                Route::post('/activate/{id}', [Dashboard\ParkingLot\Post::class, 'activateParkingLot']);
            });
            Route::prefix('parking-spots')->group(function () {
                Route::post('/', [Dashboard\ParkingSpot\Post::class, 'store']);
                Route::put('/{id}', [Dashboard\ParkingSpot\Put::class, 'update']);
                Route::get('/', [Dashboard\ParkingSpot\Get::class, 'index']);
                Route::post('/activate/{id}', [Dashboard\ParkingSpot\Post::class, 'activateParkingSpot']);
                Route::post('/deactivate/{id}', [Dashboard\ParkingSpot\Post::class, 'deactivateParkingSpot']);
            });
            Route::prefix('users')->group(function () {
                Route::post('/', [Dashboard\User\Post::class, 'store']);
                Route::put('/{id}', [Dashboard\User\Put::class, 'update']);
                Route::delete('/{id}', [Dashboard\User\Delete::class, 'destroy']);
                Route::get('/', [Dashboard\User\Get::class, 'index']);
            });
            Route::prefix('parking-books')->group(function () {
                Route::post('/', [ParkingBook\Post::class, 'store']);
                Route::post('/relocate', [ParkingBook\Post::class, 'relocateBooking']);
                Route::post('/cancel', [ParkingBook\Post::class, 'cancelBooking']);
                // Route::put('/{id}', [Dashboard\ParkingBook\Put::class, 'update']);
                // Route::delete('/{id}', [Dashboard\ParkingBook\Delete::class, 'destroy']);
                // Route::get('/', [Dashboard\ParkingBook\Get::class, 'index']);
            });
        });
    });
});