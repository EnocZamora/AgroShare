<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'preferred_language',
        'department',
        'municipality',
        'profile_photo',
        'ip_address',
        'user_agent',
    ];

    /**
     * Relación: El cambio de perfil pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}