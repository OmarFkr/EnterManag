<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends User
{
    use HasFactory;

    protected $fillable = [
        'address', 'phone', 'birthdate', 'account_status'
    ];

    /**
     * Get the Company.
     */
    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }

}
