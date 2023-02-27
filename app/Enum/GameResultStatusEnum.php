<?php

namespace App\Enum;

enum GameResultStatusEnum: string
{
    case IN_QUEUE  = 'IN_QUEUE';
    case PROCESSED = 'PROCESSED';
    case FINISHED  = 'FINISHED';
    case ERROR     = 'ERROR';
}
