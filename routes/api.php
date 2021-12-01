<?php

use App\Http\Controllers\Api\v1\AuthorController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\v1\AuthController;
use \App\Http\Controllers\Api\v1\BookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('books')->group(function () {
        Route::get('/', [BookController::class, 'index']);
        Route::get('/{book}', [BookController::class, 'show'])->missing(function () {
            return Redirect::route('not_found');
        });
        Route::post('/', [BookController::class, 'store']);
        Route::put('/{book}', [BookController::class, 'update'])->missing(function () {
            return Redirect::route('not_found');
        });
        Route::delete('/{book}', [BookController::class, 'destroy'])->missing(function () {
            return Redirect::route('not_found');
        });;
    });

    Route::prefix('authors')->group(function () {
        Route::get('/', [AuthorController::class, 'index']);
        Route::get('/{author}', [AuthorController::class, 'show'])->missing(function () {
            return Redirect::route('not_found');
        });
        Route::get('/{author}/books', [AuthorController::class, 'showAuthorBooks'])->missing(function () {
            return Redirect::route('not_found');
        });
        Route::post('/', [AuthorController::class, 'store']);
        Route::put('/{author}', [AuthorController::class, 'update'])->missing(function () {
            return Redirect::route('not_found');
        });
        Route::delete('/{author}', [AuthorController::class, 'destroy'])->missing(function () {
            return Redirect::route('not_found');
        });;
    });
});


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('404', function () {
    return response()->json(['status' => 'Failed', 'message' => 'Not found'], 404);
})->name('not_found');

Route::fallback(function () {
    return Redirect::route('not_found');
});

