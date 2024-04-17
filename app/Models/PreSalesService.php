<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreSalesService extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'service_type', 'description'];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }


}
