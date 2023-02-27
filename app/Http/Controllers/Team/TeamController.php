<?php

namespace App\Http\Controllers\Team;

use App\Helper\GameTypeHelper;
use App\Models\Rating;
use App\Models\Result;
use App\Models\Team;
use App\Models\Thematics;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class TeamController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function show(Request $request, Team $team, string $thematic = null)
    {
        $rating = Rating::where('team_id', $team->id)->get();

        $results = Result::where('team_id', $team->id)->with('game')->get();

        if ($thematic) {
            $thematicIds = GameTypeHelper::getThematicIds($thematic);
            $results = $results->filter(function ($result) use ($thematicIds) {
                return in_array((int) $result->game->thematic_id, $thematicIds);
            });
        }

        $results = $results->sortByDesc(function ($result) {
            return $result->game->number;
        })->values()->all();


        return view('team.show', compact('team', 'rating', 'results'));
    }
}
