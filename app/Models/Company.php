<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'industry', 'size', 'address', 'email', 'phone', 'city', 'state', 'zip_code'];

    public function customers() {
        return $this->hasMany(Customer::class);
    }

}
