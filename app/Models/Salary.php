<?php

namespace App\Models;

use App\Models\Employee;
use App\Models\TimeAttendanceReport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'basic_salary',
        'office_timing',
        'lateness_deductions',
        'leave_days_deductions',
        'deductions',
        'deducted_salary',
        'allowances',
        'overtime_earnings',
        'net_salary',
        'payment_date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function time_attendance_reports()
{
    return $this->hasMany(TimeAttendanceReport::class);
}


}
