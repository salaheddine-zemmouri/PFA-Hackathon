<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'code',
        'administrator_id',
    ];

    public function administrator()
    {
        return $this->belongsTo(Administrator::class, 'administrator_id', 'id');
    }
}
