<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile_number',
        'address',
        'nic_front_image',
        'nic_back_image',
        'passport_image',
        'role',
        'profile_completed',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'profile_completed' => 'boolean',
        ];
    }


    public function loanApplications()
    {
        return $this->hasMany(LoanApplication::class, 'email', 'email');
    }


    public function getRoleBadgeAttribute()
    {
        return match($this->role) {
            'admin' => 'danger',
            'manager' => 'warning',
            default => 'primary',
        };
    }


    public function isAdmin()
    {
        return $this->role === 'admin';
    }


    public function isManager()
    {
        return $this->role === 'manager';
    }


    public function isUser()
    {
        return $this->role === 'user';
    }



}
