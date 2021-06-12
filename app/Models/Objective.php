<?php

namespace App\Models;

use App\Models\Evaluator;
use App\Models\Competition;
use App\Models\Administrator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Objective extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'administrator_id',
    ];

    public function administrator(){
        return $this->belongsTo(Administrator::class,'administrator_id','id');
    }

    public function competition(){
        return $this->belongsTo(Competition::class,'competition_id','id');
    }

    public function evaluator(){
        return $this->belongsTo(Evaluator::class,'evaluator_id','id');
    }
}
