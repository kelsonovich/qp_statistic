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
        $thematics = GameTypeHelper::getButtons();

        $ratings = Rating::where('team_id', $team->id)->get();

        $results = Result::where('team_id', $team->id)->with('game')->get();

        if (! $thematic) {
            $thematic = $thematics->first()['value'];
        }

        $thematicIds = GameTypeHelper::getThematicIds($thematic);
        $results = $results->filter(function ($result) use ($thematicIds) {
            return in_array((int) $result->game->thematic_id, $thematicIds);
        });

        $rating = [
            'games'      => 0,
            'points'     => 0,
            'average'    => 0,
            'wins'       => 0,
            'percentage' => 0,
        ];

        foreach ($ratings as $teamRating) {
            if (in_array($teamRating->thematic_id, $thematicIds)) {
                foreach ($rating as $key => &$value) {
                    $value += (float) $teamRating->$key;
                }
            }
        }

        if ($rating['games'] > 0) {
            $rating['percentage'] = round(100 * $rating['wins'] / $rating['games'], 2);
            $rating['average'] = round($rating['points'] / $rating['games'], 2);
        }

        $rating = collect($rating);

        $results = $results->sortByDesc(function ($result) {
            return $result->game->number;
        })->values()->all();


        return view('team.show', compact('thematics', 'team', 'rating', 'results'));
    }
}
