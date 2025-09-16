<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepairJob extends Model
{
    protected $fillable = [
        'customer_id',
        'device_type',
        'device_brand',
        'issue_description',
        'status',
        'repair_date',
        'completion_date',
        'total_cost'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
