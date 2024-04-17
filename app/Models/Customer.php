<?php

namespace App\Models;

use App\Models\Company;
use App\Models\SalesService;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'address', 'city', 'state', 'zip_code',
        'id_card_number', 'company_id','other_details',
    ];

    public function sales()
    {
        return $this->hasMany(SalesService::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }



}
