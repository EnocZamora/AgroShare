<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name', 
    'email', 
    'password', 
    'phone', 
    'preferred_language', 
    'department', 
    'municipality', 
    'profile_photo',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ==========================================
    // Métodos Helper para Verificación de Roles
    // ==========================================

    public function esAdmin(): bool
    {
        return $this->rol_sistema === 'ADMINISTRADOR';
    }

    public function esAuditor(): bool
    {
        return $this->rol_sistema === 'AUDITOR';
    }

    public function esUsuario(): bool
    {
        return $this->rol_sistema === 'USUARIO';
    }

    // ==========================================
    // Relaciones de Eloquent
    // ==========================================

    /**
     * Relación: Un usuario puede tener registrados varios métodos de pago.
     */
    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    /**
     * Relación: Un usuario puede tener múltiples registros de cambios de perfil.
     */
    public function profileChanges()
    {
        return $this->hasMany(ProfileChange::class);
    }
}