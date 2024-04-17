<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeAttendanceReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'report_date',
        'check_in_time',
        'hours_worked',
        'overtime_hours',
        'leaves_taken',
        'lateness_minutes',
    ];

    protected $casts = [
        // 'report_date' => 'datetime',
        // 'check_in_time' => 'time',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }



}
