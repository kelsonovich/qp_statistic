<?php

namespace App\Http\Controllers\Game;

use App\Models\Game;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class GameController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function show(Request $request, Game $game)
    {
        $roundCount = 0;
        foreach ($game->results->first()->toArray() as $key => $result) {
            $roundCount += (mb_stripos($key, 'round_') === 0 && $result > 0) ? 1 : 0;
        }

        return view('game.table', compact('game', 'roundCount'));
    }
}
