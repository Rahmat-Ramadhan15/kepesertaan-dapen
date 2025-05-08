<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nip', 
        'name', 
        'password', 
        'role',
        'is_blocked'
    ];

    protected $hidden = [
        'password',
    ];

    // Definisi relasi atau method tambahan jika diperlukan
}