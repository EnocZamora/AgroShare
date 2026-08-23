<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    'rol_sistema',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

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

    public function paymentMethods(): HasMany
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public function profileChanges(): HasMany
    {
        return $this->hasMany(ProfileChange::class);
    }

    public function chatsAsBuyer(): HasMany
    {
        return $this->hasMany(Chat::class, 'buyer_id');
    }

    public function chatsAsSeller(): HasMany
    {
        return $this->hasMany(Chat::class, 'seller_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
