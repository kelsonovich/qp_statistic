<?php

namespace App\Enum;

enum GameTypeEnum: string
{
    case casual = 'Обычные игры';
    case media = 'Кино и музыка';
    case teens =  'Teens';
    case english = 'English, please!';
    case stream = 'Стримы';
}
