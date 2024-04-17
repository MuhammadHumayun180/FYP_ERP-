<?php

namespace App\Models;

use App\Models\Salary;
use App\Models\TimeAttendanceReport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;


    protected $table = 'employees';


    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'national_id',
        'social_security_number',
        'contact_number',
        'email',
        'address',
        'employee_id',
        'position',
        'department',
        'date_of_hire',
        'employment_status',
        'employment_type',
        // ... add more fields as needed
    ];



    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }

    public function time_attendance_reports()
    {
        return $this->hasMany(TimeAttendanceReport::class);
    }



}
