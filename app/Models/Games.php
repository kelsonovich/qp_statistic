<?php

namespace App\Models;

use App\Enum\GameStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Games extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'place',
        'thematic_id',
        'number',
        'package',
        'start_date',
        'result_hash',
        'status',
    ];


    public static function isExists (int $number): bool
    {
        return Games::where('number', $number)->count() > 0;
    }

    public static function getNextForParsing (): Games
    {
        return Games::where('status', GameStatusEnum::IN_QUEUE)->first();
    }

    public static function setError (Games $game): void
    {
        $game->status = GameStatusEnum::ERROR;
        $game->save();
    }
}
