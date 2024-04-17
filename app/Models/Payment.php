<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Customer;
use App\Models\SalesService;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'customer_id',
        'sales_service_id',
        'amount',
        'transaction_type',
        'payment_status',
        'transaction_id',
        'payment_method',
        'bank_name',
        'bank_account_number',
        'transaction_reference',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function salesService()
    {
        return $this->belongsTo(SalesService::class);
    }


}
