@extends('layouts.app')

@section('main-content')

@push('page-css')
<style>
    /* Add your custom CSS styles here */
</style>
@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                    <h3 class="h3 mb-0 text-gray-800">Sales Services List</h3>
                    <a href="{{ route('admin.crm-salesServices-create') }}" class="btn btn-success">Add Sales Services</a>
                </div>

                <div class="card-body rounded-circle">
                    <div class="container-fluid mt-5">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="sales-services-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product_Name</th>
                                        <th>Customer_Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total_Price</th>
                                        <th>Payment_Status</th>
                                        <th>Transaction_Type</th>
                                        <th>Amount_Paid</th>
                                        <th>Transaction_ID</th>
                                        <th>Payment_Method</th>
                                        <th>BankName</th>
                                        <th>Account_Number</th>
                                        <th>Transaction_Reference</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" style="text-align:right">Grand Total:</th>
                                        <th id="grand-total"></th>
                                        <th colspan="9"></th> <!-- Add colspan for other columns -->
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

<!-- Push a JavaScript script to the 'scripts' stack -->
@push('scripts')
<script>
    $(function() {
        var table = $('#sales-services-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.crm-salesServices-list') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'product_name', name: 'product_name' },
                { data: 'customer_name', name: 'customer_name' },
                { data: 'quantity', name: 'quantity' },
                { data: 'price', name: 'price' },
                { data: 'total_price', name: 'total_price' },
                { data: 'payment_status', name: 'payment_status' },
                { data: 'transaction_type', name: 'transaction_type' },
                { data: 'amount_paid', name: 'amount_paid' },
                { data: 'transaction_id', name: 'transaction_id' },
                { data: 'payment_method', name: 'payment_method' },
                { data: 'bank_name', name: 'bank_name' },
                { data: 'bank_account_number', name: 'bank_account_number' },
                { data: 'transaction_reference', name: 'transaction_reference' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api();

                // Calculate grand total
                var grandTotal = api.column(5, { search: 'applied' }).data()
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
