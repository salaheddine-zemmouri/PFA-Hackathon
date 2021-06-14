<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidatedObjective extends Model
{
    use HasFactory;

    protected $table = 'validated_objectives';

    protected $fillable = [
        'objective_id',
        'team_id',
        'note',
    ];
}
