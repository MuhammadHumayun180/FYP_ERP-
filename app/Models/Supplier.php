<?php

namespace App\Models;

use App\Models\Procurement;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contact_person', 'contact_number'];

    public function procurements()
    {
        return $this->hasMany(Procurement::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }


}
