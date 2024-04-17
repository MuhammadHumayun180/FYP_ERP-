@extends('layouts.app')

@section('main-content')

@push('page-css')
<style>
    /* Add your custom CSS styles here */
</style>
@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    {{-- <!-- Content Row --> --}}
    <div class="row">

        {{-- <!-- Area Chart --> --}}
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow">
                {{-- <!-- Card Header - Dropdown --> --}}

                <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                    <h3 class="h3 mb-0 text-gray-800">Product List</h3>
                    <a href="{{ route('admin.product-create') }}" class="btn btn-success">Add Product</a>
                </div>

                {{-- <!-- Card Body --> --}}
                <div class="card-body rounded-circle">

                    <div class="container-fluid mt-5">
                        <div class="table-responsive">
                            <table class="table" id="product-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Supplier</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total_Price</th>
                                        <th>Payment_Amount</th>
                                        <th>Transaction_Type</th>
                                        <th>Payment_Status</th>
                                        <th>Transaction_ID</th>
                                        <th>Payment_Method</th>
                                        <th>Bank_Name</th>
                                        <th>Bank_Account_Number</th>
                                        <th>Transaction_Reference</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th colspan="8" style="text-align:right">Grand Total:</th>
                                        <th id="grand-total"></th>
                                        <th colspan="8"></th>
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
        $('#product-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.product-list') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'category', name: 'category' },
                { data: 'brand', name: 'brand' },
                { data: 'supplier.name', name: 'supplier.name' }, // Supplier Name
                { data: 'quantity', name: 'quantity' },
                { data: 'price', name: 'price' },
                { data: 'total_price', name: 'total_price' },
                { data: 'payments.0.amount', name: 'payments.0.amount' }, // Payment Amount
                { data: 'payments.0.transaction_type', name: 'payments.0.transaction_type' }, // Transaction Type
                { data: 'payments.0.payment_status', name: 'payments.0.payment_status' }, // Payment Status
                { data: 'payments.0.transaction_id', name: 'payments.0.transaction_id' }, // Transaction ID
                { data: 'payments.0.payment_method', name: 'payments.0.payment_method' }, // Payment Method
                { data: 'payments.0.bank_name', name: 'payments.0.bank_name' }, // Bank Name
                { data: 'payments.0.bank_account_number', name: 'payments.0.bank_account_number' }, // Bank Account Number
                { data: 'payments.0.transaction_reference', name: 'payments.0.transaction_reference' }, // Transaction Reference
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api();

                // Compute the sum of total_price
                var grandTotal = api.column(7).data().reduce(function (acc, val) {
                    return acc + parseFloat(val);
                }, 0);

                $('#grand-total').text(grandTotal.toFixed(2));
            }
        });
    });
</script>
@endpush


@endsection
