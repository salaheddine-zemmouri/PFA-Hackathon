<?php

namespace App\Models;

use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\ContestantController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function objectives(){
        return $this->belongsToMany(Objective::class,'validated_objectives');
    }

    public function projects(){
        return $this->belongsToMany(Project::class,'participants');
    }
    
    

    
}
