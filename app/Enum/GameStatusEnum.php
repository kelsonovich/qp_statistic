<?php

namespace App\Enum;

enum GameStatusEnum: string
{
    case IN_QUEUE       = 'IN_QUEUE';
    case PROCESSED      = 'PROCESSED';
    case FINISHED       = 'FINISHED';
    case ERROR          = 'ERROR';
    case WITHOUT_RESULT = 'WITHOUT_RESULT';
}
