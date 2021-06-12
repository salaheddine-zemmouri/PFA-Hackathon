<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'competition_id',
    ];
    
    public function competitions()
    {
        return $this->hasMany(Competition::class);
    }

    public function teams()
    {
        return $this->belongsToMany(TeamSubscription::class);
    }
}
