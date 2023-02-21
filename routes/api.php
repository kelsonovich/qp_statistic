<?php

use App\Service\Parsing\GameListParsingService;
use App\Service\Parsing\GameParsingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function () {
    ini_set('max_execution_time', 0);

    foreach (range (1, 100) as $value) {
        GameParsingService::start();
    }
//    GameListParsingService::start();

    dd(\App\Enum\GameStatusEnum::cases());
});

