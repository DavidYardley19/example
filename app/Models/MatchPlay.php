<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchPlay extends Model
{
    protected $fillable = [
        'home_team',
        'away_team',
        'location',
        'match_date',
        'home_team_score',
        'away_team_score'
    ];
}