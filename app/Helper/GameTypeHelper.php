<?php

namespace App\Helper;

use App\Enum\GameTypeEnum;
use App\Models\Thematics;

class GameTypeHelper
{
    const GAMES = [
        GameTypeEnum::casual->name   => ['Классические игры', 'Тематические игры'],
        GameTypeEnum::media->name    => ['Кино-музыкальные игры', 'Тематические кино-музыкальные игры'],
        GameTypeEnum::teens->name    => ['Teens'],
        GameTypeEnum::english->name  => ['English, please!'],
        GameTypeEnum::stream->name   => 'стрим',
        GameTypeEnum::closed->name   => ['Закрытые игры'],
    ];

    public static function getThematicIds (string $name): array
    {
        $thematics = ($name === GameTypeEnum::stream->name)
            ? Thematics::where('title', 'like', '%' . self::GAMES[$name] . '%')->get()
            : Thematics::whereIn('title', self::GAMES[$name])->get();

        $ids = [];
        foreach ($thematics as $thematic) {
            $ids[] = $thematic->id;
        }

        return $ids;
    }

    public static function getButtons (): \Illuminate\Support\Collection
    {
        $buttons = [];
        foreach (GameTypeEnum::cases() as $case) {
            $buttons[] = [
                'title' => $case->value,
                'value' => $case->name,
            ];
        }

        return collect($buttons);
    }
}
