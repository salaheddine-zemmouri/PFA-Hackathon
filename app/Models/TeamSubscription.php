<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'contestant_id',
        'team_id',
        'leader',
    ];
    
    public function competitions()
    {
        return $this->belongsToMany(Competition::class);
    }

    public function participants()
    {
        return $this->belongsToMany(Participant::class);
    }

    public function contestants()
    {
        return $this->belongsTo(Contestant::class);
    }
}
