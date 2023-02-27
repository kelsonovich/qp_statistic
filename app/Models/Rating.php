<?php

namespace App\Models;

use App\Helper\GameTypeHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'team_id',
        'points',
        'games',
        'average',
        'wins',
        'total',
        'thematic_id',
    ];

    public function thematic(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Thematics::class);
    }

    public function team(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public static function getTeam(int $teamId, int $thematicId): Rating
    {
        return Rating::firstOrCreate(['team_id' => $teamId, 'thematic_id' => $thematicId]);
    }

    public static function getByThematic (mixed $thematic): \Illuminate\Database\Eloquent\Collection|null
    {
//        return Rating::whereIn('thematic_id', GameTypeHelper::getThematicIds($thematic))->orderBy('points', 'DESC')->get();
        return Rating::whereIn('thematic_id', GameTypeHelper::getThematicIds($thematic))->orderBy('points', 'DESC')->limit(50)->get();
    }
}
