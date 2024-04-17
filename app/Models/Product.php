<?php

namespace App\Models;

use App\Models\Inventory;
use App\Models\Procurement;
use App\Models\SalesService;
use App\Models\Payment;
use App\Models\Supplier;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'sku', 'description', 'category', 'brand', 'model', 'quantity', 'price','total_price'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function procurements()
    {
        return $this->hasMany(Procurement::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function sales()
    {
        return $this->hasMany(SalesService::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}
