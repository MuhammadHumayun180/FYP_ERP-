@extends('layouts.app')

@section('main-content')

@push('page-css')
<style>
      
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
                    <h3 class="h3 mb-0 text-gray-800">Procurement List</h3>
                    <a href="{{ route('admin.procurement-create') }}" class="btn btn-success">Add Procurement</a>
                </div>

                {{-- <!-- Card Body --> --}}
                <div class="card-body rounded-circle">
                    <div class="container-fluid mt-5">
                        <div class="table-responsive">
                            <table class="table" id="procurement-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Supplier Name</th>
                                        <th>Quantity</th>
                                        <th>Cost</th>
                                        <th>Other Cost</th>
                                        <th>Total Cost</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                        <th colspan="6" style="text-align:right">Grand Total:</th>
                                        <th id="grand-total"></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
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
        var table = $('#procurement-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.procurement-list') }}",
            scrollX: true, // Enable horizontal scrolling
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'product_name', name: 'product_name' },
                { data: 'supplier_name', name: 'supplier_name' },
                { data: 'quantity', name: 'quantity' },
                { data: 'cost', name: 'cost' },
                { data: 'other_cost', name: 'other_cost' },
                { data: 'total_cost', name: 'total_cost' },
            ],
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api();

                // Calculate grand total
                var grandTotal = api.column(6, { search: 'applied' }).data()
                    .reduce(function (acc, val) {
                        return parseFloat(acc) + parseFloat(val);
                    }, 0);

                // Update grand total cell in the footer
                $('#grand-total').text(grandTotal.toFixed(2));
            }
        });
    });





</script>
@endpush

@endsection
