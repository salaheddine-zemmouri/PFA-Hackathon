<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'administrator_id',
        'competition_id',
    ];

    public function administrator(){
        return $this->belongsTo(Administrator::class,'administrator_id','id');
    }

    public function competition(){
        return $this->belongsTo(Competition::class,'competition_id','id');
    }
}
