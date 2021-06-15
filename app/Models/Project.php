<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'team_id',
        'file_id',
    ];
    
    public function file()
    {
        return $this->hasOne(File::class);
    }
}
