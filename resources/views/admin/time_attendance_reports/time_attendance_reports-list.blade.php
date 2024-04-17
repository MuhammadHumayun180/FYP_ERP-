@extends('layouts.app')

@section('main-content')

@push('page-css')
<style>

    table.dataTable thead>tr>th.sorting_asc, table.dataTable thead>tr>th.sorting_desc, table.dataTable thead>tr>th.sorting, table.dataTable thead>tr>td.sorting_asc, table.dataTable thead>tr>td.sorting_desc, table.dataTable thead>tr>td.sorting {
        padding-right: 19px;
    }

    .container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl {
    padding-left: 0.5rem;
    padding-right: 0.5rem;

}



</style>
@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    {{-- <!-- Content Row --> --}}
    <div class="row">

        {{-- <!-- Area Chart --> --}}
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                {{-- <!-- Card Header - Dropdown --> --}}
                <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                    <h3 class="h3 mb-0 text-gray-800">Time and Attendance Reports</h3>
                    <a href="{{ route('admin.create.time-attendance-reports') }}" class="btn btn-success">Add Report</a>
                </div>

                {{-- <!-- Card Body --> --}}
                <div class="card-body rounded-circle">
                    <div class="container-fluid mt-5">
                        <div class="table-responsive">
                                <table class="table" id="time-attendance-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Employee</th>
                                        <th>Report Date</th>
                                        <th>Hours Worked</th>
                                        <th>Overtime Hours</th>
                                        <th>Leaves Taken</th>
                                        <th>Lateness Minutes</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <!-- /.container-fluid --> --}}

@push('scripts')
    <!-- Include DataTables script and your custom script for handling time_attendance_reports data -->
    <script>
        $(function() {
            $('#time-attendance-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.time-attendance-reports.list') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'employee_name', name: 'employee_name', orderable: false, searchable: false },
                    { data: 'report_date', name: 'report_date' },
                    { data: 'hours_worked', name: 'hours_worked' },
                    { data: 'overtime_hours', name: 'overtime_hours' },
                    { data: 'leaves_taken', name: 'leaves_taken' },
                    { data: 'lateness_minutes', name: 'lateness_minutes' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@endpush

@endsection
