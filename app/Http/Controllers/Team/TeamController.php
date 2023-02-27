<?php

namespace App\Http\Controllers\Team;

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

    public function show(Request $request, Team $team, Thematics $thematics)
    {
        $rating = Rating::where('team_id', $team->id)->get();

        $results = Result::where('team_id', $team->id)->with(['game' => function ($query) use ($thematics) {
            $query->where('thematic_id', $thematics->id);
            $query->orderBy('number', 'desc');
        }])->get();

        return view('team.show', compact('team', 'thematics', 'rating', 'results'));
    }
}
