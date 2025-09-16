<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // Specify the fields that are mass assignable
    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'address'
    ];

    public function repairJobs()
    {
        return $this->hasMany(RepairJob::class);
    }
}
