<?php

namespace App\Models;

use App\Models\FingerDevice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['finger_device_id', 'uid', 'emp_id', 'state', 'attendance_time', 'attendance_date', 'type', 'status'];

    public function fingerDevice()
    {
        return $this->belongsTo(FingerDevice::class);
    }


}
