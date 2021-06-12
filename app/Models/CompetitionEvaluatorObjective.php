<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionEvaluatorObjective extends Model
{
    use HasFactory;

    protected $fillable = [
        'competition_id',
        'evaluator_id',
        'objective_id',
    ];
}
