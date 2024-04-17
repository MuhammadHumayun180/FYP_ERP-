<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerService extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'service_name', 'description', 'status'];

    // Define relationships if any
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
