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
                    <h3 class="h3 mb-0 text-gray-800">Create Employee</h3>
                    <a href="{{ route('admin.create-employee') }}" class="btn btn-success">Add Employee</a>
                </div>

                {{-- <!-- Card Body --> --}}
                <div class="card-body rounded-circle">
                    <div class="container-fluid mt-5">
                        <div class="table-responsive">

                        <table class="table " id="employee-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Action</th>
                                    <th>FirstName</th>
                                    <th>LastName</th>
                                    <th>Email</th>
                                    <th>HiringDate</th>
                                    <th>Office Time</th>
                                    <th>Gender</th>
                                    <th>IDNumber</th>
                                    <th>Security Number</th>
                                    <th>Contact Number</th>
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
          $('#employee-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('admin.employee.list') }}",
              scrollX: true, // Enable horizontal scrolling
              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                  
                  { data: 'action', name: 'action', orderable: false, searchable: false },
                  { data: 'first_name', name: 'first_name', orderable: false, searchable: false },
                  { data: 'last_name', name: 'last_name' },
                  { data: 'email', name: 'email' },
                  { data: 'date_of_hire', name: 'date_of_hire' },
                  { data: 'office_timing', name: 'office_timing' },
                  { data: 'gender', name: 'gender' },
                  { data: 'national_id', name: 'national_id' },
                  { data: 'social_security_number', name: 'social_security_number' },
                  { data: 'contact_number', name: 'contact_number' },
              ]
          });

        //   'first_name',
        // 'last_name',
        // 'gender',
        // 'date_of_birth',
        // 'national_id',
        // 'social_security_number',
        // 'contact_number',
        // 'email',
        // 'address',
        // 'employee_id',
        // 'position',
        // 'department',
        // 'date_of_hire',
        // 'employment_status',
        // 'employment_type',

      });
  </script>

@endpush



@endsection
