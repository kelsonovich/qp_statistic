<?php

namespace App\Models;

use App\Enum\GameResultStatusEnum;
use App\Enum\GameStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
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
        return Game::where('number', $number)->count() > 0;
    }

    public static function getNextForParsing (): Game|null
    {
        return Game::where('status', GameStatusEnum::IN_QUEUE)->first();
    }

    public static function getInQueueResult (): \Illuminate\Database\Eloquent\Collection|null
    {
        return Game::where('result_status', GameResultStatusEnum::IN_QUEUE)->limit(500)->get();
    }

    public static function getNextWithError (): Game|null
    {
        return Game::where('status', GameStatusEnum::ERROR)->whereNotIn('number', [
            48260, 38889, 36104, 35858, 35418, 35390, 35411, 27898, 26212, 25469, 24263, 17570, 17321, 17151, 17150,
            17149, 17012, 17011, 17010,
        ])->first();
    }

    public static function setError (Game $game): void
    {
        $game->status = GameStatusEnum::ERROR;
        $game->save();
    }

    public static function setResultFinished (Game $game): void
    {
        $game->result_status = GameResultStatusEnum::FINISHED->value;
        $game->save();
    }

    public static function setResultError (Game $game): void
    {
        $game->result_status = GameResultStatusEnum::ERROR->value;
        $game->save();
    }

    public function thematic(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Thematics::class);
    }

    public function results(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Result::class);
    }
}
