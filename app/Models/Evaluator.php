<?php

namespace App\Models;

use App\Models\Objective;
use App\Models\Competition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluator extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'evaluators';

    protected $guard = 'evaluator';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function competitions(){
        return $this->belongsToMany(Competition::class,'competition_evaluator_objectives');
    }

    public function objectives(){
        return $this->hasMany(Objective::class,'objective_id','id');
    }
}
