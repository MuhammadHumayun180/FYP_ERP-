<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
// use Yajra\DataTables\Services\DataTable;

use Yajra\DataTables\Facades\Datatables;

class EmployeeController extends Controller
{

    public function index(Request $request)
    {
        // $data = Employee::orderBy('created_at', 'asc')->get();

        // return $data;
        if($request->ajax()){
            $data = Employee::orderBy('created_at', 'asc')->get();
            return  Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = "<div class='d-flex justify-content-center '>
                <a href='".route('admin.employee.edit',$row->id)."' class='edit btn  btn-sm mx-1'><i class='fa-solid fa-pen-to-square' style='color:green'></i></a>
                <a href='".route('admin.employee.delete',$row->id)."' class='delete btn  btn-sm mx-1'><i class='fa-solid fa-trash'style='color:red'></i></a>
                </div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.employees.employee-list');

    }

    public function create(Request $request){
        return view('admin.employees.employee-create');
    }
    public function store(Request $request)
    {
        // return $request->time('office_timing');
        // Validation rules
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'required|date',
            'employee_id' => 'required|string|unique:employees,employee_id',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'date_of_hire' => 'required|date',
            'employment_type' => 'required|string|max:255',
            'national_id' => 'required|numeric|digits:13|unique:employees,national_id',
            'social_security_number' => 'required|numeric|digits:11|different:contact_number',
            'contact_number' => 'required|numeric||unique:employees,contact_number|digits:11', // Pakistan contact number format
            'basic_salary' => 'required|numeric',
            'office_timing' => 'required', // Adjust the validation as needed
        ]);

        // Create new employee instance
        $addEmployee = new Employee;

        // Assign values from the request
        $addEmployee->first_name = $request->first_name;
        $addEmployee->last_name = $request->last_name;
        $addEmployee->gender = $request->gender;
        $addEmployee->date_of_birth = $request->date_of_birth;
        $addEmployee->national_id = $request->national_id;
        $addEmployee->social_security_number = $request->social_security_number;
        $addEmployee->contact_number = $request->contact_number;
        $addEmployee->email = $request->email;
        $addEmployee->employee_id = $request->employee_id;
        $addEmployee->position = $request->position;
        $addEmployee->department = $request->department;
        $addEmployee->employment_type = $request->employment_type;
        $addEmployee->date_of_hire = $request->date_of_hire;
        $addEmployee->basic_salary = $request->basic_salary;
        $addEmployee->office_timing = $request->office_timing;

        // Save the employee
        if ($addEmployee->save()) {
            return redirect()->route('admin.employee.list')->with('success', 'Employee added successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to add employee');
        }
    }

    public function edit(Request $request,$id){
        $employeeEdit =  Employee::findorFail($id);

        return view('admin.employees.employee-edit', compact('employeeEdit'));
    }

    public function update(Request $request,$id)
    {


        $updateEmployee = Employee::findOrFail($id);

          // Validation rules
          $request->validate( [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'required|date',
            'employee_id' => [
                'required',
                'string',
                Rule::unique('employees')->ignore($updateEmployee->id), // $employee should be the instance of the current record being updated
                // You might need to adjust the 'employees' table name if it's different
            ],

            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'date_of_hire' => 'required|date',
            'employment_type' => 'required|string|max:255',
            'national_id' => 'required|numeric|digits:13',
            'social_security_number' => 'required|numeric|digits:11|different:contact_number',
            'contact_number' => 'required|numeric|digits:11', // Pakistan contact number format
            'basic_salary' => 'required|numeric',
            'office_timing' => 'required', // Adjust the validation as needed

        ]);

        $updateEmployee = Employee::findOrFail($id);

        $updateEmployee->first_name = $request->first_name;
        $updateEmployee->last_name = $request->last_name;
        $updateEmployee->gender = $request->gender;
        $updateEmployee->date_of_birth = $request->date_of_birth;
        $updateEmployee->national_id = $request->national_id;
        $updateEmployee->social_security_number = $request->social_security_number;
        $updateEmployee->contact_number = $request->contact_number;
        $updateEmployee->email = $request->email;
        $updateEmployee->employee_id = $request->employee_id;
        $updateEmployee->position = $request->position;
        $updateEmployee->department = $request->department;
        $updateEmployee->employment_type = $request->employment_type;
        $updateEmployee->date_of_hire = $request->date_of_hire;
        $updateEmployee->basic_salary = $request->basic_salary;
        $updateEmployee->office_timing = $request->office_timing;

        if($updateEmployee->save()){
            return redirect()->route('admin.employee.list')->with('success', 'Employee updated successfully');
        }

                // Update employee fields
                // $updateEmployee->update([
                //     'first_name' => $request->first_name,
                //     'last_name' => $request->last_name,
                //     'email' => $request->email,
                //     'gender' => $request->gender,
                //     'date_of_birth' => $request->date_of_birth,
                //     'employee_id' => $request->employee_id,
                //     'position' => $request->position,
                //     'department' => $request->department,
                //     'date_of_hire' => $request->date_of_hire,
                //     'employment_type' => $request->employment_type,
                //     //'employment_status' => $request->employment_status,
                //     'national_id' => $request->national_id,
                //     'social_security_number' => $request->social_security_number,
                //     'mobile_number' => $request->mobile_number,
                //     'contact_number' => $request->contact_number,
                //     'office_timing' => $request->office_timing,
                //     // Add other fields as needed
                // ]);



    }

    public function destroy(Request $request,$id){
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('admin.employee.list')->with('success', 'Employee deleted successfully');

    }
}
