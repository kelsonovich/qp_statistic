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

    public static function getNextForParsing (): Games|null
    {
        return Games::where('status', GameStatusEnum::IN_QUEUE)->first();
    }

    public static function getNextWithError (): Games|null
    {
        return Games::where('status', GameStatusEnum::ERROR)->whereNotIn('number', [
            48260, 38889, 36104, 35858, 35418, 35390, 35411, 27898, 26212, 25469, 24263, 17570, 17321, 17151, 17150,
            17149, 17012, 17011, 17010,
        ])->first();
    }

    public static function setError (Games $game): void
    {
        $game->status = GameStatusEnum::ERROR;
        $game->save();
    }
}
