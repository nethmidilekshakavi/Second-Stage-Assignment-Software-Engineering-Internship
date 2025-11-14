<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'name',
        'email',
        'tel',
        'occupation',
        'salary',
        'paysheet_uri',
        'submitted_at',
        'status',
        'user_id'
    ];
}
