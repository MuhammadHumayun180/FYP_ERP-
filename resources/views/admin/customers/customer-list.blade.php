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
                    <h3 class="h3 mb-0 text-gray-800">Customers List</h3>
                    <a href="{{ route('admin.customer-create') }}" class="btn btn-success">Add Customer</a>
                </div>

                {{-- <!-- Card Body --> --}}
                <div class="card-body rounded-circle">
                    <div class="container-fluid mt-5">

                            <div class="table-responsive">
                                <table class="table" id="employee-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>ZipCode</th>
                                            <th>IDCardNumber</th>
                                            <th>Other Details</th>
                                            <th>Action  </th>
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
              ajax: "{{ route('admin.customer-list') }}",
              scrollX: true, // Enable horizontal scrolling
              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                  { data: 'name', name: 'name', orderable: false, searchable: false },
                  { data: 'email', name: 'email' },
                  { data: 'phone', name: 'phone' },
                  { data: 'address', name: 'address' },
                  { data: 'city', name: 'city' },
                  { data: 'state', name: 'state' },
                  { data: 'zip_code', name: 'zip_code' },
                  { data: 'id_card_number', name: 'id_card_number' },
                  { data: 'other_details', name: 'other_details' },

                  { data: 'action', name: 'action', orderable: false, searchable: false },
              ]
          });

        //   'name', 'email', 'phone', 'address', 'city', 'state', 'zip_code',
        // 'id_card_number', 'company_id','other_details',


      });
  </script>

@endpush



@endsection
