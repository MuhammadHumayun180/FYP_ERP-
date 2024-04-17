<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutomationAction extends Model
{
    use HasFactory;

    protected $fillable = ['rule_id', 'action_type', 'parameters'];

    public function rule()
    {
        return $this->belongsTo(AutomationRule::class);
    }


}
