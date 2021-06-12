<?php

namespace App\Models;

use App\Http\Controllers\TeamController;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Contestant extends Authenticatable
{
    use HasFactory, Notifiable;
    

    protected $table = 'contestants';

    protected $guard = 'contestant';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function teams()
    {
        return $this->hasMany(TeamSubscription::class);
    }

}
