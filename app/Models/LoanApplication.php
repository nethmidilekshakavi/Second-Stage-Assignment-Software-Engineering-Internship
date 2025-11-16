<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'tel',
        'occupation',
        'salary',
        'paysheet_uri',
        'status',
    ];

    /**
     * The user who submitted the application (nullable for guest submissions).
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
