@extends('layouts.app')

@section('main-content')

@push('page-css')
<style>

    table.dataTable thead>tr>th.sorting_asc, table.dataTable thead>tr>th.sorting_desc, table.dataTable thead>tr>th.sorting, table.dataTable thead>tr>td.sorting_asc, table.dataTable thead>tr>td.sorting_desc, table.dataTable thead>tr>td.sorting {
        padding-right: 19px;
    }

    .container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl {
    padding-left: 0.5rem;
    padding-right: -2.5rem;

}


.container,
    .container-fluid,
    .container-lg,
    .container-md,
    .container-sm,
    .container-xl {
        /* Adjust padding using Bootstrap spacing classes */
        padding: 1rem;
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
                    <h3 class="h3 mb-0 text-gray-800">Payroll List</h3>
                    <a href="{{ route('admin.payroll.create') }}" class="btn btn-success">Add Payroll</a>
                </div>

                {{-- <!-- Card Body --> --}}
                <div class="card-body rounded-circle">
                    <div class="container-fluid mt-5">
                        <div class="table-responsive">
                            <table class="table" id="payroll-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Action</th>
                                        <th>Employee</th>
                                        <th>Basic_Salary</th>
                                        <th>Allowances</th>
                                        <th>OverTimes</th>
                                        {{-- <th>Deductions</th> --}}
                                        <th>Lates</th>
                                        <th>Leaves</th>
                                        <th>Deductions</th>
                                        <th>Net_Salary</th>
                                        <th>Payment_Date</th>
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
  <!-- Push a JavaScript script to the 'scripts' stack -->
  @push('scripts')



  <script>
      $(function() {
          $('#payroll-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('admin.payroll.list') }}",
              scrollX: true, // Enable horizontal scrolling
              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                  { data: 'action', name: 'action', orderable: false, searchable: false },
                  { data: 'employee_name', name: 'employee_name', orderable: false, searchable: false },
                  { data: 'basic_salary', name: 'basic_salary' },
                  { data: 'allowances', name: 'allowances' },
                  { data: 'overtime_earnings', name: 'overtime_earnings' },
                //   { data: 'deductions', name: 'deductions' },
                  { data: 'lateness_deductions', name: 'lateness_deductions' },
                  { data: 'leave_days_deductions', name: 'leave_days_deductions' },
                  { data: 'deductions', name: 'deductions' },
                  { data: 'net_salary', name: 'net_salary' },
                  { data: 'payment_date', name: 'payment_date' },

              ]
          });

      });
  </script>

@endpush



@endsection
