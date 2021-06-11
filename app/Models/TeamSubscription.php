<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamSubscription extends Model
{
    protected $fillable = [
        'contestant_id',
        'team_id',
        'leader',
    ];
    use HasFactory;
}
