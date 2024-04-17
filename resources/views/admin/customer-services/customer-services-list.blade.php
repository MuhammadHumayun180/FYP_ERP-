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
                    <h3 class="h3 mb-0 text-gray-800">Customer Services</h3>
                    <a href="{{ route('admin.customer.service-create') }}" class="btn btn-success">Add Customer Services</a>
                </div>

                {{-- <!-- Card Body --> --}}
                <div class="card-body rounded-circle">
                    <div class="container-fluid mt-5">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="sales-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
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
          $('#sales-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: '{{ route("admin.sales.automation-list") }}',
              columns: [
                  { data: 'id', name: 'id' },
                  { data: 'customer_name', name: 'customer_name' },
                  { data: 'product_name', name: 'product_name' },
                  { data: 'quantity', name: 'quantity' },
                  { data: 'price', name: 'price' },
                  { data: 'action', name: 'action', orderable: false, searchable: false }
              ]
          });
      });
  </script>
  @endpush


@endsection
