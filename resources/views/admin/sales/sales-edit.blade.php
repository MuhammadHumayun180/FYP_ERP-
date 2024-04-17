@extends('layouts.app')

@section('main-content')

<!-- Begin Page Content -->
<div class="container-fluid">

    {{-- <!-- Content Row --> --}}
    <div class="row">

        {{-- <!-- Area Chart --> --}}
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                {{-- <!-- Card Header - Dropdown --> --}}

                <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                    <h3 class="h3 mb-0 text-gray-800">Update Total Sales</h3>
                    <a href="{{ route('admin.sales.automation-list') }}" class="btn btn-success">Sales list</a>
                </div>

                {{-- <!-- Card Body --> --}}
                <div class="card-body rounded-circle">
                    <div class="container-fluid mt-5">

                        <form method="POST" action="{{ route('admin.sales.automation-update', $sales->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="customer">Customer</label>
                                <select name="customer" id="customer" class="form-control @error('customer') is-invalid @enderror">
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ $customer->id == $sales->customer_id ? 'selected' : '' }}>{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                                @error('customer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="product">Product</label>
                                <select name="product" id="product" class="form-control @error('product') is-invalid @enderror">
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ $product->id == $sales->product_id ? 'selected' : '' }}>{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                @error('product')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" min="1" value="{{ $sales->quantity }}" required>
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" min="0.01" step="0.01" value="{{ $sales->price }}" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="total_amount">Total Amount</label>
                                <input type="text" name="total_amount" id="total_amount" class="form-control @error('total_amount') is-invalid @enderror" value="{{ $sales->total_amount }}" readonly>
                                @error('total_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- jQuery (required for toastr.js) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        // Handle change event on the customer dropdown
        $('#customer').on('change', function() {
            var customerId = $(this).val();

            // Make AJAX request to fetch customer's products
            $.ajax({
                url: "{{ route('admin.sales.automation-get-customer-prodcuts') }}",
                type: "GET",
                data: { customer_id: customerId },
                success: function(response) {
                    if (response.success) {
                        // Clear existing options from product dropdown
                        $('#product').empty();

                        // Populate product dropdown with received products
                        $.each(response.data.products, function(index, product) {
                            $('#product').append('<option value="' + product.id + '">' + product.name + '</option>');
                        });
                    } else {
                        // If no products found, display a toastr message
                        toastr.error('No products found for this customer.');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX error
                    console.error('AJAX Error:', error);
                }
            });
        });

        // Function to fetch product data and populate form fields
        $('#product').on('change', function() {
            var productId = $(this).val();

            // Make AJAX request to fetch product data
            $.ajax({
                url: "{{ route('admin.sales.automation-customer-prodcuts-data') }}",
                type: "GET",
                data: { product_id: productId },
                success: function(response) {
                    if (response.success) {
                        // Populate form fields with received product data
                        $('#quantity').val(response.data.product.quantity);
                        $('#price').val(response.data.product.price);
                        $('#total_amount').val(response.data.product.total_price);
                    } else {
                        // Show toastr message if product data not found
                        toastr.error('Product data not found');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX error
                    console.error('AJAX Error:', error);
                }
            });
        });
    });
</script>
@endpush

