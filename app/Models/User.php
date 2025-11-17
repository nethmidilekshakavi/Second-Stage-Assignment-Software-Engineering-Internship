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

    /**
     * Get all loan applications for this user
     * FIXED: Using email to match with loan_applications table
     */
    public function loanApplications()
    {
        return $this->hasMany(LoanApplication::class, 'email', 'email');
    }

    /**
     * Get user's role badge color
     */
    public function getRoleBadgeAttribute()
    {
        return match($this->role) {
            'admin' => 'danger',
            'manager' => 'warning',
            default => 'primary',
        };
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is manager
     */
    public function isManager()
    {
        return $this->role === 'manager';
    }

    /**
     * Check if user is regular user
     */
    public function isUser()
    {
        return $this->role === 'user';
    }



}
