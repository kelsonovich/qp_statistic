<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'game_id',
        'team_id',
        'place',
        'round_1',
        'round_2',
        'round_3',
        'round_4',
        'round_5',
        'round_6',
        'round_7',
        'round_8',
        'round_9',
        'round_10',
        'round_11',
        'round_12',
        'round_13',
        'round_14',
        'round_15',
        'total',
    ];
}
