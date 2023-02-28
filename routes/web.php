<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/package', [\App\Http\Controllers\Package\PackageController::class, 'list'])->name('package-list');
Route::get('/package/{number}', [\App\Http\Controllers\Package\PackageController::class, 'show'])->name('package-detail');
Route::get('/{thematics?}', [\App\Http\Controllers\Rating\RatingController::class, 'index'])->name('rating-table');
Route::get('/team/{team}/{thematics?}', [\App\Http\Controllers\Team\TeamController::class, 'show'])->name('team-detail');
Route::get('/game/{game}', [\App\Http\Controllers\Game\GameController::class, 'show'])->name('game-detail');


Route::get('/test', function () {
    ini_set('max_execution_time', 0);

//    \App\Service\Parsing\GameListParsingService::start();

    $games = \App\Models\Game::getInQueueResult();

    foreach ($games as $game) {
        DB::beginTransaction();
        try {
            foreach ($game->results as $result) {
                $teamRating = \App\Models\Rating::getTeam($result->team_id, $game->thematic_id);

                $teamRating->points += $result->total;
                $teamRating->games  += 1;
                $teamRating->wins   += ((int) $result->place === 1) ? 1 : 0;
                $teamRating->average = round($teamRating->points / $teamRating->games, 2);

                $teamRating->save();
            }

            \App\Models\Game::setResultFinished($game);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            \App\Models\Game::setResultError($game);
        }
    }
});


