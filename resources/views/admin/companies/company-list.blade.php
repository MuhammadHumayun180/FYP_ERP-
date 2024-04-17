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
                    <h3 class="h3 mb-0 text-gray-800">Company List</h3>
                    <a href="{{ route('admin.company-create') }}" class="btn btn-success">Add Company</a>
                </div>

                {{-- <!-- Card Body --> --}}
                <div class="card-body rounded-circle">
                    <div class="container-fluid mt-5">
                        <div class="table-responsive">
                        <table class="table" id="employee-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>name</th>
                                    <th>email</th>
                                    <th>phone</th>
                                    <th>industry</th>
                                    <th>address</th>
                                    <th>size</th>
                                    <th>city</th>
                                    <th>state</th>
                                    <th>zip_code</th>
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
  <!-- Push a JavaScript script to the 'scripts' stack -->
  @push('scripts')
  <script>
      $(function() {
          $('#employee-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('admin.company-list') }}",
              columns: [
                  { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                  { data: 'name', name: 'name', orderable: false, searchable: false },
                  { data: 'phone', name: 'phone' },
                  { data: 'email', name: 'email' },
                  { data: 'industry', name: 'industry' },
                  { data: 'address', name: 'address' },
                  { data: 'size', name: 'size' },
                  { data: 'city', name: 'city' },
                  { data: 'state', name: 'state' },
                  { data: 'zip_code', name: 'zip_code' },

                  { data: 'action', name: 'action', orderable: false, searchable: false },
              ]
          });


      });
  </script>

@endpush



@endsection
