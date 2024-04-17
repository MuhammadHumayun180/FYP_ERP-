<!-- resources/views/admin/time_attendance_reports/time_attendance_reports-edit.blade.php -->

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
                    <h3 class="h3 mb-0 text-gray-800">Edit Time and Attendance Report</h3>
                    <a href="{{ route('admin.time-attendance-reports.list') }}" class="btn btn-success">Back to Reports</a>
                </div>

                {{-- <!-- Card Body --> --}}
                <div class="card-body rounded-circle">
                    <div class="container-fluid mt-5">

                        <form action="{{ route('admin.time-attendance-reports.update', $timeAttendanceReport->id) }}" method="POST">
                            @csrf
                            {{-- @method('PUT') --}}

                            {{-- <!-- Employee Information --> --}}
                            <div class="mb-3">
                                <label for="employee_id" class="form-label">Select Employee</label>
                                <select class="form-select form-control @error('employee_id') is-invalid @enderror {{ old('employee_id',$timeAttendanceReport->employee_id) ? 'is-valid' : ' ' }}" id="employee_id" name="employee_id">
                                    <option value="" selected>Select Employee</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" @if($timeAttendanceReport->employee_id == $employee->id) selected @endif>{{ $employee->first_name }} {{ $employee->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <!-- Report Information --> --}}
                            <div class="mb-3">
                                <label for="report_date" class="form-label">Report Date</label>
                                <input type="date" class="form-control @error('report_date') is-invalid @enderror {{ old('report_date',$timeAttendanceReport->report_date) ? 'is-valid' : ' ' }} " id="report_date" name="report_date" value="{{ old('report_date', $timeAttendanceReport->report_date) }}" >
                                @error('report_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="check_in_time" class="form-label">Check In Time</label>
                                <input type="time" class="form-control @error('check_in_time') is-invalid @enderror  {{ old('check_in_time',$timeAttendanceReport->check_in_time) ? 'is-valid' : ' ' }} " id="check_in_time" name="check_in_time" value="{{ old('check_in_time', $timeAttendanceReport->check_in_time) }}" >
                                @error('check_in_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="hours_worked" class="form-label">Hours Worked</label>
                                <input type="text" class="form-control @error('hours_worked') is-invalid @enderror  {{ old('hours_worked',$timeAttendanceReport->hours_worked) ? 'is-valid' : ' ' }} " id="hours_worked" name="hours_worked" value="{{ old('hours_worked', $timeAttendanceReport->hours_worked) }}" >
                                @error('hours_worked')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="overtime_hours" class="form-label">Overtime Hours</label>
                                <input type="text" class="form-control @error('overtime_hours') is-invalid @enderror {{ old('overtime_hours',$timeAttendanceReport->overtime_hours) ? 'is-valid' : ' ' }}" id="overtime_hours" name="overtime_hours" value="{{ old('overtime_hours', $timeAttendanceReport->overtime_hours) }}" >
                                @error('overtime_hours')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="leaves_taken" class="form-label">Leaves Taken</label>
                                <input type="text" class="form-control @error('leaves_taken') is-invalid @enderror {{ old('leaves_taken',$timeAttendanceReport->leaves_taken) ? 'is-valid' : ' ' }}" id="leaves_taken" name="leaves_taken" value="{{ old('leaves_taken', $timeAttendanceReport->leaves_taken) }}" >
                                @error('leaves_taken')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="lateness_minutes" class="form-label">Lateness Minutes</label>
                                <input type="text" class="form-control @error('lateness_minutes') is-invalid @enderror {{ old('lateness_minutes',$timeAttendanceReport->lateness_minutes) ? 'is-valid' : ' ' }}" id="lateness_minutes" name="lateness_minutes" value="{{ old('lateness_minutes', $timeAttendanceReport->lateness_minutes) }}" >
                                @error('lateness_minutes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update Report</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <!-- /.container-fluid --> --}}

@endsection
