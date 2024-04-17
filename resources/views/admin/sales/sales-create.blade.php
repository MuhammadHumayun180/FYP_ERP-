    {{-- resources/views/employees/create.blade.php --}}

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
                        <h3 class="h3 mb-0 text-gray-800">Create Total Sales</h3>
                        <a href="{{ route('admin.sales.automation-list') }}" class="btn btn-success">Sales list</a>
                    </div>

                    {{-- <!-- Card Body --> --}}
                    <div class="card-body rounded-circle">
                        <div class="container-fluid mt-5">

                            <form method="POST" action="{{ route('admin.sales.automation-store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="customer">Customer</label>
                                    <select name="customer" id="customer" class="form-control @error('customer') is-invalid @enderror">
                                        <option value="">Select Customer</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
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
                                    </select>
                                    @error('product')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" min="1" required>
                                    @error('quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" min="0.01" step="0.01" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="total_amount">Total Amount</label>
                                    <input type="text" name="total_amount" id="total_amount" class="form-control @error('total_amount') is-invalid @enderror" readonly>
                                    @error('total_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Create</button>
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
                        // console.log(response.data.products);
                        $.each(response.data.products, function(index, product) {
                            // console.log(product.name);
                            $('#product').append('<option value="' + product.id + '">' + product.name + '</option>');
                        });
                    } else {
                            // If no products found, display a toaster message
                            toastr.error('No products found for this customer.');
                        // Handle error case
                        console.error('Failed to fetch customer products.');
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

                    console.log(response.data.product);

                    if (response.success) {
                        // Populate form fields with received product data
                        $('#quantity').val(response.data.product.quantity);
                        $('#price').val(response.data.product.price);
                        $('#total_amount').val(response.data.product.total_price);
                    } else {
                        // Show toaster message if product data not found
                        showToast('Product data not found', 'error');
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
