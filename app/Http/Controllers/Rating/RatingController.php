<?php

namespace App\Http\Controllers\Rating;

use App\Models\Rating;
use App\Models\Thematics;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class RatingController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(Request $request)
    {
        $thematics = Thematics::all();
        $thematicId = $request->get('thematic') ?? $thematics->first()->id;

        $teams = Rating::getByThematic($thematicId);

        return view('rating.table', compact('thematics', 'teams'));
    }
}
