<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{

    protected $fillable = [
        'name', 'email', 'tel', 'occupation', 'salary', 'paysheet_uri', 'status'
    ];
}
