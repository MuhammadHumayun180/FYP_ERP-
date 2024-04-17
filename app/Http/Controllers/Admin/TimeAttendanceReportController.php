<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\TimeAttendanceReport;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;


class TimeAttendanceReportController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = TimeAttendanceReport::with('employee')->orderBy('created_at', 'asc')->get();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn = "<div class='d-flex justify-content-center '>
                <a href='".route('admin.time-attendance-reports.edit', $row->id)."' class='edit btn btn-success btn-sm mx-1'>Edit</a>
                <a href='".route('admin.time-attendance-reports.delete', $row->id)."' class='delete btn btn-danger btn-sm mx-1'>Delete</a>
            </div>";
            return $actionBtn;
            })
            ->addColumn('employee_name', function($row){
                return $row->employee->first_name . " " . $row->employee->last_name;
            })
            ->rawColumns(['action'])->make(true);
        }

        return view('admin.time_attendance_reports.time_attendance_reports-list');

    }

    public function create()
    {
        // Your logic to fetch employees or necessary data
        $employees = Employee::all();

        return view('admin.time_attendance_reports.time_attendance_reports-create', compact('employees'));
    }


            // YourController.php
            public function getOfficeTime($employeeId)
            {
                $employee = Employee::find($employeeId);

                return response()->json(['office_timing' => $employee->office_timing]);
            }


    public function store(Request $request)
    {

        // return $request->input();

        // Validate the request data
            $request->validate([
                'employee_id' => 'required|exists:employees,id',
                'report_date' => 'required|date',
                'check_in_time' => 'required',
                'hours_worked' => 'required|integer|min:0',
                'overtime_hours' => 'integer|min:0',
                'leaves_taken' => 'integer|min:0',
                'lateness_minutes' => 'integer|min:0',
            ]);

                // $employee = Employee::findorfail($request->input('employee_id'));
                // $perdaySalary = $employee->basic_salary/30;
                // $leavesTaken = $request->input('leaves_taken');
                // $deductedSalary = $perdaySalary* $leavesTaken;

                // return $employee->basic_salary;

            // Calculate lateness in minutes if necessary
            $latenessMinutes = $request->input('lateness_minutes');

            // Create TimeAttendanceReport record
            TimeAttendanceReport::create([
                'employee_id' => $request->input('employee_id'),
                'report_date' => $request->report_date,
                'check_in_time' => $request->check_in_time,
                // $checkInTime = Carbon::parse($request->input('lateness_minutes'));
                'hours_worked' => $request->input('hours_worked'),
                'overtime_hours' => $request->input('overtime_hours', 0),
                'leaves_taken' => $request->input('leaves_taken', 0),
                'lateness_minutes' => $latenessMinutes,
            ]);



        // $request->validate([
        //     'employee_id' => 'required|exists:employees,id',
        //     'report_date' => 'required|date',
        //     'hours_worked' => 'required|integer|min:0',
        //     'overtime_hours' => 'integer|min:0',
        //     'leaves_taken' => 'integer|min:0',
        //     'lateness_minutes' => 'integer|min:0',
        // ]);
        // // Calculate lateness minutes
        // $employee = Employee::findOrFail($request->input('employee_id'));
        // // $checkInTime = Carbon::parse($request->input('lateness_minutes'));
        // // $fixedCheckInTime = Carbon::parse($employee->check_in_time);/
        // // $latenessMinutes = max(0, $checkInTime->diffInMinutes($fixedCheckInTime));

        // // return $latenessMinutes;
        // // Create TimeAttendanceReport record
        // TimeAttendanceReport::create([
        //     'employee_id' => $request->input('employee_id'),
        //     'report_date' => $request->input('report_date'),
        //     'check_in_time' => $request->input('check_in_time'),
        //     'check_out_time' => $request->input('check_out_time'),
        //     'lateness_minutes' => $request->input('lateness_minutes'),
        //     'hours_worked' => $request->input('hours_worked'),
        //     // Add other fields as needed
        // ]);
        // TimeAttendanceReport::create($request->all());

        return redirect()->route('admin.time-attendance-reports.list')->with('success', 'Time and Attendance report added successfully');
    }

    public function edit(Request $request,$id){
        $timeAttendanceReport = TimeAttendanceReport::findOrFail($id);
        $employees = Employee::all(); // Assuming you have an Employee model

        return view('admin.time_attendance_reports.time_attendance_reports-edit', compact('timeAttendanceReport', 'employees'));
    }

    public function update(Request $request,$id){


        // return $request->input();
        // Validate the form data
            // $request->validate([
            //     'employee_id' => 'required|exists:employees,id',
            //     'report_date' => 'required|date',
            //     'hours_worked' => 'required|numeric|min:0',
            //     'overtime_hours' => 'numeric|min:0',
            //     'leaves_taken' => 'numeric|min:0',
            //     'lateness_minutes' => 'numeric|min:0',
            // ]);

            // // Find the time attendance report by ID
            // $timeAttendanceReport = TimeAttendanceReport::findOrFail($id);

            // // Update the time attendance report record
            // $timeAttendanceReport->update([
            //     'employee_id' => $request->input('employee_id'),
            //     'report_date' => $request->input('report_date'),
            //     'hours_worked' => $request->input('hours_worked'),
            //     'overtime_hours' => $request->input('overtime_hours', 0),
            //     'leaves_taken' => $request->input('leaves_taken', 0),
            //     'lateness_minutes' => $request->input('lateness_minutes', 0),
            // ]);

             // Validate the request data
                $request->validate([
                    'employee_id' => 'required|exists:employees,id',
                    'report_date' => 'required|date',
                    'check_in_time' => 'required',
                    'hours_worked' => 'required|integer|min:0',
                    'overtime_hours' => 'integer|min:0',
                    'leaves_taken' => 'integer|min:0',
                    'lateness_minutes' => 'integer|min:0',
                ]);

                // Find the time attendance report by ID
                $timeAttendanceReport = TimeAttendanceReport::findOrFail($id);

                // Update the time attendance report record
                $timeAttendanceReport->update([
                    'employee_id' => $request->input('employee_id'),
                    'report_date' => $request->input('report_date'),
                    'check_in_time' => $request->input('check_in_time'),
                    'hours_worked' => $request->input('hours_worked'),
                    'overtime_hours' => $request->input('overtime_hours', 0),
                    'leaves_taken' => $request->input('leaves_taken', 0),
                    'lateness_minutes' => $request->input('lateness_minutes', 0),
                ]);


            return redirect()->route('admin.time-attendance-reports.list')->with('success', 'Time and Attendance report updated successfully');
    }

    public function destroy(Request $request,$id){

        $timeAttendanceReport = TimeAttendanceReport::findorFail($id);
        if(!empty($timeAttendanceReport)){
            $timeAttendanceReport->delete();
            return redirect()->route('admin.time-attendance-reports.list')->with('success', 'Time Attendance Report Deleted successfully');
        }
    }
}
