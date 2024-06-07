<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Models\TimeAttendanceReport;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\DB;


class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Salary::with('employee')->orderBy('created_at', 'asc')->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<div class='d-flex justify-content-center '>
                        <a href='".route('admin.payroll.edit', $row->id)."'  class='edit btn  btn-sm mx-1'><i class='fa-solid fa-pen-to-square' style='color:green'></i></a>
                        <a href='".route('admin.payroll.delete', $row->id)."'class='delete btn  btn-sm mx-1'><i class='fa-solid fa-trash'style='color:red'></i></a>
                    </div>";
                    return $actionBtn;
                })
                ->addColumn('employee_name', function($row){
                    return $row->employee->first_name . " " . $row->employee->last_name;
                })
                ->rawColumns(['action', 'employee_name'])
                ->make(true);
        }

        return view('admin.payrolls.payroll-list');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get a list of employees to populate a dropdown in the form
        $employees = Employee::all();
        return view('admin.payrolls.payroll-create', compact('employees'));
    }


    // // get basic salary and office timming function
     public function getEmployeeDetails($id): JsonResponse
    {
        $employee = DB::table('employees')->find($id);

        // return $employee;
        // return response()->json(['data' => $employee], 404);

        if (!$employee) {
            return response()->json(['status'=>false, 'success'=>'Employee not found','error' => $employee], 404);
            // return response()->json(['error' => 'Employee not found'], 404);
        }
        // Get the total count of late arrivals in the past 30 days
        // $totalLatesCount = DB::table('time_attendance_reports')
        //     ->where('employee_id', $id)
        //     // ->where('lateness_minutes', '>', 45)
        //     ->first();

        // $totalLatesCount = DB::table('time_attendance_reports')->latest()->find($id);
        $totalLatesCount = TimeAttendanceReport::where('employee_id', $id)
            ->latest()  // Order by the created_at column in descending order
            ->first();
        if(!$totalLatesCount)
        {
            return response()->json(['status'=>false, 'success'=>'Tiem Attendance Not Found','error' => $totalLatesCount], 404);
        }
        // $totalLatesCount = TimeAttendanceReport::where('employee_id', $id)
        //     ->latest()  // Order by the created_at column in descending order
        //     ->first();
                // return $totalLatesCount;

               $leavesTaken =  $totalLatesCount->leaves_taken;
               $WorkinHours =  $totalLatesCount->hours_worked;

               $leaveTakenMinuts = $leavesTaken*$WorkinHours*60;


        // return response()->json([
        //     'data' => $totalLatesCount,
        //     'leavesTaken' => $leavesTaken,
        //     'total_lates' => $totalLatesCount->lateness_minutes +  $leaveTakenMinuts,
        //     'leaveMinuts' => $leaveTakenMinuts
        // ]);


        // if ($totalLatesCount) {
            // Calculate the number of days to deduct based on the lateness count
            $daysToDeduct = round($totalLatesCount->lateness_minutes / 45);
            // return response()->json([
            //     "days_count" => $daysToDeduct,
            //     'total_lates' => $totalLatesCount->lateness_minutes,
            // ]);
            if($daysToDeduct >= 3)
            {
                // Deduct one day's salary for each instance of lateness exceeding 45 minutes
                $salarPerDay = $employee->basic_salary / 30;

                $deductsalaryDays = ($daysToDeduct+$leavesTaken) *$salarPerDay;

                $salaryDeduction = $employee->basic_salary - $deductsalaryDays;

                return response()->json([
                    'basic_salary' => $employee->basic_salary,
                    'total_lates' => $totalLatesCount->lateness_minutes +  $leaveTakenMinuts,
                    'office_timing' => $employee->office_timing,
                    'deductions' => $deductsalaryDays,
                    'late_days_deductions' => $daysToDeduct ,
                    'leave_days_deductions' => $leavesTaken ,
                    'salary_deduction' => $salaryDeduction,
                ]);
            }else{
                $salarPerDay = $employee->basic_salary / 30;

                $deductsalaryDays = $leavesTaken * $salarPerDay;

                $salaryDeduction = $employee->basic_salary - $deductsalaryDays;

                return response()->json([
                    'basic_salary' => $employee->basic_salary,
                    'total_lates' => $totalLatesCount->lateness_minutes +  $leaveTakenMinuts,
                    'office_timing' => $employee->office_timing,
                    'deductions' => $deductsalaryDays,
                    'late_days_deductions' => $daysToDeduct ,
                    'leave_days_deductions' => $leavesTaken ,
                    'salary_deduction' => $salaryDeduction,
                ]);
            }




        // } else {
        //     return response()->json([
        //         'message' => 'No lateness exceeding 45 minutes found in the past 30 days.',
        //     ]);
        // }

    }





    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    //  return $request->lateness_deductions;
    //  return   $request->input();

                    // Validate the form data
                    $request->validate([
                        'employee_id' => 'required|exists:employees,id',
                        'payment_date' => 'required|date',
                        'basic_salary' => 'required|numeric|min:0',
                        'office_timing' => 'required',
                        'lateness_deductions' => 'required|numeric|min:0',
                        'leave_days_deductions' => 'required|numeric|min:0',
                        'deductions' => 'required|numeric|min:0',
                        'deducted_salary' => 'required|numeric|min:0',
                        'allowances' => 'required|numeric|min:0',
                        'overtime_earnings' => 'required|numeric|min:0',
                    ]);


            // Get employee details
            $netSalary = $request->deductions-$request->input('deducted_salary') + $request->input('allowances') + $request->input('overtime_earnings');

            // return  $netSalary;


            Salary::create([
                'employee_id' => $request->employee_id,
                'basic_salary' => $request->basic_salary,
                'office_timing' => $request->office_timing,
                'lateness_deductions' => $request->lateness_deductions,
                'leave_days_deductions' => $request->leave_days_deductions,
                'deductions' => $request->deductions,
                'deducted_salary' => $request->deducted_salary,
                'allowances' => $request->allowances,
                'overtime_earnings' => $request->overtime_earnings,
                'payment_date' => $request->payment_date,
                'net_salary' => $netSalary,
            ]);


            return redirect()->route('admin.payroll.list')->with('success', 'Payroll added successfully');

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payroll = Salary::findOrFail($id);
        $employees = Employee::all();
        return view('admin.payrolls.payroll-edit', compact('payroll', 'employees'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // return $request->input();
                 // Validate the form data
                 $request->validate([
                    'employee_id' => 'required|exists:employees,id',
                    'payment_date' => 'required|date',
                    'basic_salary' => 'required|numeric|min:0',
                    'office_timing' => 'required',
                    'lateness_deductions' => 'required|numeric|min:0',
                    'leave_days_deductions' => 'required|numeric|min:0',
                    'deductions' => 'required|numeric|min:0',
                    'deducted_salary' => 'required|numeric|min:0',
                    'allowances' => 'required|numeric|min:0',
                    'overtime_earnings' => 'required|numeric|min:0',
                ]);

                    $salary = Salary::findorFail($id);

                    // Get employee details
                    $netSalary = $request->deductions - $request->input('deducted_salary') + $request->input('allowances') + $request->input('overtime_earnings');

                    // Update the salary record
                    $salary->update([
                        'employee_id' => $request->employee_id,
                        'basic_salary' => $request->basic_salary,
                        'office_timing' => $request->office_timing,
                        'lateness_deductions' => $request->lateness_deductions,
                        'leave_days_deductions' => $request->leave_days_deductions,
                        'deductions' => $request->deductions,
                        'deducted_salary' => $request->deducted_salary,
                        'allowances' => $request->allowances,
                        'overtime_earnings' => $request->overtime_earnings,
                        'payment_date' => $request->payment_date,
                        'net_salary' => $netSalary,
                    ]);

                return redirect()->route('admin.payroll.list')->with('success', 'Payroll updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payrollDelete = Salary::findorFail($id);
        $payrollDelete->delete();
        return redirect()->route('admin.payroll.list')->with('success', 'Payroll Deleted successfully');
    }
}
