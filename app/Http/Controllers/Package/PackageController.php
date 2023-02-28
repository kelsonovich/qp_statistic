<?php

namespace App\Http\Controllers\Package;

use App\Models\Game;
use App\Models\Result;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function list()
    {
        $games = Game::select('title', 'package', DB::raw('CONCAT(title, " #", package) as name'))
            ->groupBy('name')
            ->orderBy('number', 'desc')
            ->limit(20)
            ->get()
            ->toArray();

        foreach ($games as &$game) {
            $package = Game::where('title', $game['title'])->where('package', $game['package'])->get();
            foreach ($package as $packageGame) {
                $game['ids'][] = $packageGame->id;
            }

            if (count($game['ids']) > 0) {
//                $game['results'] = Result::whereIn('game_id', $game['ids'])->orderBy('total')->with('team')->get();
            }

            $game['name'] = ($game['package'] > 0) ? $game['title'] . ' #' . $game['package'] : $game['title'];
            $game['name'] = $game->getPackageTitle();

            $game['link'] = implode(',', $game['ids']);
        }

        return view('package.list', compact('games'));
    }

    public function show(Request $request, string $package)
    {
        $gameIds = explode(',', $package);

        $game = Game::where('id', $gameIds[0])->first();

        $results = Result::whereIn('game_id', $gameIds)->orderBy('total', 'desc')->with('team')->get();

        $roundCount = 0;
        foreach ($results->first()->toArray() as $key => $result) {
            $roundCount += (mb_stripos($key, 'round_') === 0 && $result > 0) ? 1 : 0;
        }

        $results = $results->values()->all();

        return view('package.detail', compact('game', 'results', 'roundCount'));
    }
}
