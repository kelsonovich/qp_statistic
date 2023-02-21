<?php

namespace App\Helper;

use App\Enum\Round\CityEnum;
use App\Enum\Round\PlaceEnum;
use App\Enum\Round\RankEnum;
use App\Enum\Round\RoundEnum;
use App\Enum\Round\RoundTypeEnum;
use App\Enum\Round\TeamEnum;
use App\Enum\Round\TotalEnum;

class EnumHelper
{
    private static array $types = [
//        PlaceEnum::class => RoundTypeEnum::PLACE,
//        RankEnum::class  => RoundTypeEnum::RANK,
//        CityEnum::class  => RoundTypeEnum::CITY,
        TeamEnum::class  => RoundTypeEnum::TEAM,
        RoundEnum::class => RoundTypeEnum::ROUND,
        TotalEnum::class => RoundTypeEnum::TOTALS,
    ];

    public static function getValuesAsArray (string $entity): array
    {
        return array_column($entity::cases(), 'value');
    }

    public static function getType (string $cell): mixed
    {
        $cell = str_replace(range(0, 9), '', $cell);
        $cell = htmlentities(htmlspecialchars($cell));
        $cell = str_replace(['&nbsp;'], '', $cell);
        $cell = trim($cell);

        foreach (self::$types as $enum => $type) {
            $values = EnumHelper::getValuesAsArray($enum);
            foreach ($values as $value) {

                if (stripos($value, $cell) === 0) {
                    return $type;
                }
            }
        }

        return '';
    }
}
