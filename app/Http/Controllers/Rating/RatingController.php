<?php

namespace App\Http\Controllers\Rating;

use App\Helper\GameTypeHelper;
use App\Models\Rating;
use App\Models\Thematics;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class RatingController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(Request $request, string $thematic = null)
    {
        $thematics = GameTypeHelper::getButtons();
        $thematic = $thematic ?? $thematics->first()['value'];

        $teams = Rating::getByThematic($thematic);

        return view('rating.table', compact('thematics','thematic', 'teams'));
    }
}
