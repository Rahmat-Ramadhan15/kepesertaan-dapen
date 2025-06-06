<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\Auditable;

class User extends Authenticatable
{
    use Notifiable, Auditable;

    protected $fillable = [
        'nip', 
        'name', 
        'password', 
        'role',
        'is_blocked',
        'last_password_changed'
    ];

    protected $hidden = [
        'password',
    ];

     // Relasi untuk log audit yang dilakukan oleh user ini
     public function auditLogs()
     {
         return $this->hasMany(AuditLog::class, 'user_id', 'nip');
     }
     
     // Relasi untuk log audit yang terkait dengan model user ini (ketika user diubah)
     public function activityLogs()
     {
         return $this->morphMany(AuditLog::class, 'reference');
     }
}