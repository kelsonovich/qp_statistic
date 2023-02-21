<?php

namespace App\Enum\Round;

enum RoundTypeEnum: string
{
    case PLACE  = 'PLACE';
    case CITY   = 'CITY';
    case RANK   = 'RANK';
    case TEAM   = 'TEAM';
    case ROUND  = 'ROUND';
    case TOTALS = 'TOTALS';
}
