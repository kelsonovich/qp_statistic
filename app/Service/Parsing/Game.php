<?php

namespace App\Service\Parsing;

use App\Enum\GameStatusEnum;
use App\Models\Game as GameModel;

class Game
{
    private static int    $package;
    private static string $title = '';
    private static string $place = '';

    public static function start (int $number, object $card): void
    {
        self::setTitleAndPackage($card);
        self::setPlace($card);

        self::create($number);
    }

    private static function create (int $number): void
    {
        GameModel::create([
            'title'   => self::$title,
            'package' => self::$package,
            'number'  => $number,
            'place'   => self::$place,
            'status'  => GameStatusEnum::IN_QUEUE,
        ]);
    }

    public static function setTitleAndPackage (object $page): void
    {
        [$title, $package] = $page->find('div.schedule-block-top div.h2-game-card')->plaintext;

        $package = (int) str_replace(['#'], '', $package);

        [self::$title, self::$package] = [$title, $package];
    }

    public static function setPlace (object $page): void
    {
        $place = $page->find('div.schedule-block-info-bar', 0)->plaintext;

        self::$place = trim(str_replace('Где это?', '', $place));
    }
}
