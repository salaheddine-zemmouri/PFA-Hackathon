<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Administrator extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'administrators';

    protected $guard = 'administrator';


    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function competitions()
    {
        return $this->hasMany(Competition::class);
    }
}
