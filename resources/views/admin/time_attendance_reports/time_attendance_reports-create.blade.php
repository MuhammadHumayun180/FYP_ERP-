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
                    <h3 class="h3 mb-0 text-gray-800">Add Time and Attendance Report</h3>
                    <a href="{{ route('admin.time-attendance-reports.list') }}" class="btn btn-success">Back to Reports</a>
                </div>

                {{-- <!-- Card Body --> --}}
                <div class="card-body rounded-circle">
                    <div class="container-fluid mt-5">

                        <form action="{{ route('admin.store.time-attendance-reports') }}" method="POST">
                            @csrf

                            {{-- <!-- Employee Information --> --}}
                            <div class="mb-3">
                                <label for="employee_id" class="form-label">Select Employee</label>
                                <select class="form-select form-control @error('employee_id') is-invalid @enderror {{ old('employee_id') ? 'is-valid' : ' ' }} " id="employee_id" name="employee_id" onchange="fetchOfficeTime()">
                                    <option value="" selected>Select Employee</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" @if(old('employee_id') == $employee->id) selected @endif>{{ $employee->first_name }} {{ $employee->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="office_timing" class="form-label">Office Timing</label>
                                <input type="text" class="form-control" id="office_timing" name="office_timing" value="" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="check_in_time" class="form-label">Check-in Time</label>
                                <input type="time" class="form-control" id="check_in_time" name="check_in_time" onchange="calculateLateness()">
                            </div>

                            {{-- <!-- Report Information --> --}}
                            <div class="mb-3">
                                <label for="report_date" class="form-label">Report Date</label>
                                <input type="date" class="form-control @error('report_date') is-invalid @enderror {{ old('report_date') ? 'is-valid' : ' ' }}" id="report_date" name="report_date" value="{{ old('report_date') }}" onchange="calculateLateness()" >
                                @error('report_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="hours_worked" class="form-label">Hours Worked</label>
                                <input type="text" class="form-control @error('hours_worked') is-invalid @enderror {{ old('hours_worked') ? 'is-valid' : ' ' }}" id="hours_worked" name="hours_worked" value="{{ old('hours_worked') }}"  onchange="calculateLateness()" >
                                @error('hours_worked')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="overtime_hours" class="form-label">Overtime Hours</label>
                                <input type="text" class="form-control @error('overtime_hours') is-invalid @enderror {{ old('overtime_hours') ? 'is-valid' : ' ' }}" id="overtime_hours" name="overtime_hours" value="{{ old('overtime_hours') }}" >
                                @error('overtime_hours')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="leaves_taken" class="form-label">Leaves Taken</label>
                                <input type="text" class="form-control @error('leaves_taken') is-invalid @enderror {{ old('leaves_taken') ? 'is-valid' : ' ' }}" id="leaves_taken" name="leaves_taken" value="{{ old('leaves_taken') }}" >
                                @error('leaves_taken')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="lateness_minutes" class="form-label">Lateness Minutes</label>
                                <input type="text" class="form-control @error('lateness_minutes') is-invalid @enderror {{ old('lateness_minutes') ? 'is-valid' : ' ' }}" id="lateness_minutes" name="lateness_minutes" value="{{ old('lateness_minutes') }}" >
                                @error('lateness_minutes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Add Report</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <!-- /.container-fluid --> --}}


@push('scripts')

<script>
    function fetchOfficeTime() {
        var employeeId = $('#employee_id').val();

        if (employeeId) {
            $.ajax({
                url: '/admin/get-office-time/' + employeeId,
                type: 'GET',
                success: function (data) {
                    $('#office_timing').val(data.office_timing);
                    calculateLateness();
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    }

    function calculateLateness()
    {
                var officeTiming = $('#office_timing').val(); // Assuming format HH:MM AM/PM
                var checkInTime = $('#check_in_time').val(); // Assuming format HH:MM

        // Convert office timing and check-in time to Date objects
        var officeTime = parseTimeString(officeTiming);
        var checkIn = parseTimeString(checkInTime);

        // Check if the office time is greater than the check-in time
        // if (officeTime > checkIn)
        // {
        //         var officeTiming = $('#office_timing').val(' '); // Assuming format HH:MM AM/PM
        //         var checkInTime = $('#check_in_time').val(' '); // Assuming format HH:MM
        //         $('#lateness_minutes').val(' ');
        //     alert("Office timing cannot be greater than check-in time.");
        //     return; // Exit the function to prevent further processing
        // }

        // Check if the check-in time is earlier than the office timing
        if (checkIn < officeTime) {
            // If so, add a day to the check-in time to account for the next day
            checkIn.setDate(checkIn.getDate() + 1);
        }

        // Calculate lateness in minutes
        var latenessInMinutes = Math.max(0, (checkIn - officeTime) / (1000 * 60));

        // Output the results
        console.log("Office Timing:", officeTiming);
        console.log("Check-in Time:", checkInTime);
        console.log("Office Time:", officeTime);
        console.log("Check-in Time:", checkIn);
        console.log("Lateness in Minutes:", latenessInMinutes);

        $('#lateness_minutes').val(latenessInMinutes);
        // Function to parse time string with AM/PM format
        function parseTimeString(timeString) {
            var timeComponents = timeString.split(':');
            var hours = parseInt(timeComponents[0]);
            var minutes = parseInt(timeComponents[1]);

            if (timeString.includes('PM') && hours < 12) {
                hours += 12;
            } else if (timeString.includes('AM') && hours === 12) {
                hours = 0;
            }
            return new Date(2000, 0, 1, hours, minutes, 0);
        }

    }
</script>

@endpush

@endsection
