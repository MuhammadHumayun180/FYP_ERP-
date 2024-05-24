@extends('layouts.app')

@section('main-content')

@push('page-css')
<style>
/* Add your custom CSS styles here */

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
                    <h3 class="h3 mb-0 text-gray-800">Supplier List</h3>
                    <a href="{{ route('admin.supplier-create') }}" class="btn btn-success">Add Supplier</a>
                </div>

                {{-- <!-- Card Body --> --}}
                <div class="card-body rounded-circle">
                    <div class="container-fluid mt-5">
                        <table class="table" id="supplier-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Contact Person</th>
                                    <th>Contact Number</th>
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
{{-- <!-- /.container-fluid --> --}}

<!-- Push a JavaScript script to the 'scripts' stack -->
@push('scripts')
<script>
    $(function() {
        $('#supplier-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.supplier-list') }}",
            scrollX: true, // Enable horizontal scrolling
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'contact_person', name: 'contact_person' },
                { data: 'contact_number', name: 'contact_number' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>
@endpush

@endsection
