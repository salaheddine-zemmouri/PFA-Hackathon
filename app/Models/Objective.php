<?php

namespace App\Models;

use App\Models\Evaluator;
use App\Models\Competition;
use App\Models\Administrator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Objective extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'administrator_id',
    ];

    public function administrator(){
        return $this->belongsTo(Administrator::class,'administrator_id','id');
    }

    public function competitions(){
        return $this->belongsToMany(Competition::class,'competition_evaluator_objectives');
    }

    public function evaluators(){
        return $this->belongsToMany(Evaluator::class,'competition_evaluator_objectives');
    }

    public function validatedObjectives(){
        return $this->hasMany(ValidatedObjective::class,'objective_id','id');
    }
}
