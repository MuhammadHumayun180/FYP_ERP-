@extends('layouts.app')

@section('main-content')

<!-- Begin Page Content -->
<div class="container-fluid">

    {{-- <!-- Content Row --> --}}
    <div class="row">

        {{-- <!-- Area Chart --> --}}
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                {{-- <!-- Card Header - Dropdown --> --}}

                <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                    <h3 class="h3 mb-0 text-gray-800">Edit Payroll</h3>
                    <a href="{{ route('admin.payroll.list') }}" class="btn btn-success">Payroll List</a>
                </div>

                {{-- <!-- Card Body --> --}}
                <div class="card-body rounded-circle">
                    <div class="container-fluid mt-5">

                        <form action="{{ route('admin.payroll.update', $payroll->id) }}" method="POST">
                            @csrf
                            {{-- @method('PUT') --}}

                            {{-- <!-- Employee Information --> --}}
                            <div class="mb-3">
                                <label for="employee_id" class="form-label">Select Employee</label>
                                <select class="form-select form-control @error('employee_id') is-invalid @enderror {{ old('employee_id', $payroll->employee_id) ? 'is-valid' : ' ' }} " id="employee_id" name="employee_id">
                                    <option value="" selected>Select Employee</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" @if(old('employee_id', $payroll->employee_id) == $employee->id) selected @endif>{{ $employee->first_name }} {{ $employee->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <!-- Salary Information --> --}}
                            <div class="mb-3">
                                <label for="basic_salary" class="form-label">Basic Salary</label>
                                <input type="text" class="form-control @error('basic_salary') is-invalid @enderror {{ old('basic_salary', $payroll->basic_salary) ? 'is-valid' : ' ' }}" id="basic_salary" name="basic_salary" value="{{ old('basic_salary', $payroll->basic_salary) }}" readonly>
                                @error('basic_salary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Office Timing -->
                            <div class="mb-3">
                                <label for="office_timing" class="form-label">Office Timing</label>
                                <input type="text" class="form-control  @error('office_timing') is-invalid @enderror {{ old('office_timing', $payroll->office_timing) ? 'is-valid' : ' ' }}" id="office_timing" name="office_timing" value="{{ old('office_timing', $payroll->office_timing) }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="lateness_deductions" class="form-label">Total Late Days</label>
                                <input type="text" class="form-control @error('lateness_deductions') is-invalid @enderror {{ old('lateness_deductions', $payroll->lateness_deductions) ? 'is-valid' : ' ' }}" id="lateness_days" name="lateness_deductions" value="{{ old('lateness_deductions', $payroll->lateness_deductions) }}" readonly >
                                @error('lateness_deductions')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="leave_days_deductions" class="form-label">Total Leave Days</label>
                                <input type="text" class="form-control @error('leave_days_deductions') is-invalid @enderror {{  old('leave_days_deductions', $payroll->leave_days_deductions) ? 'is-valid' : ' ' }}" id="leave_days_deductions" name="leave_days_deductions" value="{{ old('leave_days_deductions', $payroll->leave_days_deductions) }}" readonly >
                                @error('leave_days_deductions')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deductions" class="form-label">Deductions</label>
                                <input type="text" class="form-control @error('deductions') is-invalid @enderror {{ old('deductions', $payroll->deductions) ? 'is-valid' : ' ' }}" id="deductions" name="deductions" value="{{ old('deductions', $payroll->deductions) }}" readonly>
                                @error('deductions')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deducted_salary" class="form-label">Deducted Salary</label>
                                <input type="text" class="form-control @error('deducted_salary') is-invalid @enderror {{ old('deducted_salary', $payroll->deducted_salary) ? 'is-valid' : ' ' }}" id="deducted_salary" name="deducted_salary" value="{{ old('deducted_salary', $payroll->deducted_salary) }}" readonly >
                                @error('deducted_salary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="allowances" class="form-label">Allowances</label>
                                <input type="text" class="form-control @error('allowances') is-invalid @enderror {{ old('allowances', $payroll->allowances) ? 'is-valid' : ' ' }}" id="allowances" name="allowances" value="{{ old('allowances', $payroll->allowances) }}" >
                                @error('allowances')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- <!-- Overtime, Leave, and Lateness Information --> --}}
                            <div class="mb-3">
                                <label for="overtime_earnings" class="form-label">Overtime Earnings</label>
                                <input type="text" class="form-control @error('overtime_earnings') is-invalid @enderror {{ old('overtime_earnings', $payroll->overtime_earnings) ? 'is-valid' : ' ' }}" id="overtime_earnings" name="overtime_earnings" value="{{ old('overtime_earnings', $payroll->overtime_earnings) }}" >
                                @error('overtime_earnings')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="payment_date" class="form-label">Payment Date</label>
                                <input type="date" class="form-control @error('payment_date') is-invalid @enderror {{ old('payment_date', $payroll->payment_date) ? 'is-valid' : ' ' }} " id="payment_date" name="payment_date" value="{{ old('payment_date', $payroll->payment_date) }}" >
                                @error('payment_date')
                                    <div class="invalid-feedback
                                    {{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Update Payroll</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <!-- /.container-fluid --> --}}


        @push('scripts')
        {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
        <script>
            $(document).ready(function () {
                $('#employee_id').on('change', function () {
                    var employeeId = $(this).val();

                    if (employeeId) {
                        // Make an AJAX request to fetch employee details
                        $.ajax({
                            url: '/admin/get-employee-details/' + employeeId,
                            type: 'GET',
                            dataType: 'json',
                            success: function (response) {
                                // Update the basic salary, office timing, and other input fields

                                $('#basic_salary').val(response.basic_salary);
                                $('#office_timing').val(response.office_timing);
                                $('#leave_deductions').val(response.leave_deductions);
                                $('#lateness_days').val(response.late_days_deductions);
                                $('#leave_days_deductions').val(response.leave_days_deductions);
                                $('#deducted_salary').val(response.salary_deduction);
                                $('#deductions').val(response.deductions);

                                // Compare current time with office timing
                                // var currentTime = new Date();
                                // var officeTiming = new Date(response.office_timing);
                                // var latenessMinutes = Math.max(0, (currentTime - officeTiming) / (1000 * 60)); // Lateness is zero or positive value

                                // alert(latenessMinutes);

                                // Update the lateness input field
                                // $('#lateness_deductions').val(latenessMinutes);

                                // Count total lates and update deductions if count is 3 or more
                                // var totalLatesCount = response.total_lates;
                                // if (totalLatesCount > 59) {
                                    // Deduct one day's salary for lateness
                                    // var latenessDeductions = response.basic_salary / 30; // Assuming 30 days in a month
                                    // $('#lateness_deductions').val(latenessDeductions);
                                // } else {
                                    // $('#lateness_deductions').val(0);
                                // }
                            },
                            error: function (error) {
                                console.error('Error fetching employee details:', error);

                                // Reset the input fields if there is an error
                                $('#basic_salary').val('');
                                $('#office_timing').val('');
                                $('#lateness').val('');
                                $('#lateness_deductions').val('');
                            }
                        });
                    } else {
                        // Reset the input fields if no employee is selected
                        $('#basic_salary').val('');
                        $('#office_timing').val('');
                        $('#lateness').val('');
                        $('#lateness_deductions').val('');
                    }
                });
            });
        </script>
        @endpush

        @endsection
