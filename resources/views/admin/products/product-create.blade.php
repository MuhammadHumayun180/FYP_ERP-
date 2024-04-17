<!-- resources/views/companies/create.blade.php -->

@extends('layouts.app')

@section('main-content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                    <h3 class="h3 mb-0 text-gray-800">Add Product</h3>
                    <a href="{{ route('admin.product-list') }}" class="btn btn-success">Product List</a>
                </div>

                <div class="card-body rounded-circle">
                    <div class="container-fluid mt-5">
                        <form action="{{ route('admin.product-store') }}" method="POST">
                            @csrf
                            <!-- Product Information -->
                            <div class="mb-3">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select class="form-select form-control @error('supplier_id') is-invalid @enderror {{ $errors->has('supplier_id') ? 'is-invalid' : (old('supplier_id') ? 'is-valid' : '') }}" id="supplier_id" name="supplier_id">
                                    <option value="" selected>Select Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }} class="{{ $errors->has('supplier_id') ? 'is-invalid' : (old('supplier_id') ? 'is-valid' : '') }}">
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror {{ $errors->has('name') ? 'is-invalid' : (old('name') ? 'is-valid' : '') }}" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" class="form-control @error('category') is-invalid @enderror {{ $errors->has('category') ? 'is-invalid' : (old('category') ? 'is-valid' : '') }}" id="category" name="category" value="{{ old('category') }}">
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="brand" class="form-label">Brand</label>
                                <input type="text" class="form-control @error('brand') is-invalid @enderror {{ $errors->has('brand') ? 'is-invalid' : (old('brand') ? 'is-valid' : '') }}" id="brand" name="brand" value="{{ old('brand') }}">
                                @error('brand')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror {{ $errors->has('quantity') ? 'is-invalid' : (old('quantity') ? 'is-valid' : '') }}" id="quantity" name="quantity" value="{{ old('quantity') }}" required>
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror {{ $errors->has('price') ? 'is-invalid' : (old('price') ? 'is-valid' : '') }}" id="price" name="price" value="{{ old('price') }}" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Payment Information -->
                            <div class="mb-3">
                                <h4>Add Payment Details</h4>
                            </div>

                            <div class="mb-3">
                                <label for="payment_status" class="form-label">Payment Status</label>
                                <select class="form-select form-control @error('payment_status') is-invalid @enderror {{ $errors->has('payment_status') ? 'is-invalid' : (old('payment_status') ? 'is-valid' : '') }}" id="payment_status" name="payment_status">
                                    <option value="pending" {{ old('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ old('payment_status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                @error('payment_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="transaction_type" class="form-label">Transaction Type</label>
                                <select class="form-select form-control @error('transaction_type') is-invalid @enderror {{ $errors->has('transaction_type') ? 'is-invalid' : (old('transaction_type') ? 'is-valid' : '') }}" id="transaction_type" name="transaction_type">
                                    <option value="" selected>Select Transaction Type   </option>
                                    <option value="purchase" {{ old('transaction_type') == 'purchase' ? 'selected' : '' }}>Purchase</option>
                                    <option value="sale" {{ old('transaction_type') == 'sale' ? 'selected' : '' }}>Sale</option>
                                    <!-- Add more options as needed -->
                                </select>
                                @error('transaction_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount Paid</label>
                                <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror {{ $errors->has('amount') ? 'is-invalid' : (old('amount') ? 'is-valid' : '') }}" id="amount" name="amount" value="{{ old('amount') }}" required>
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="transaction_id" class="form-label">Transaction ID</label>
                                <input type="text" class="form-control @error('transaction_id') is-invalid @enderror {{ $errors->has('transaction_id') ? 'is-invalid' : (old('transaction_id') ? 'is-valid' : '') }}" id="transaction_id" name="transaction_id" value="{{ old('transaction_id') }}" required>
                                @error('transaction_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <input type="text" class="form-control @error('payment_method') is-invalid @enderror {{ $errors->has('payment_method') ? 'is-invalid' : (old('payment_method') ? 'is-valid' : '') }}" id="payment_method" name="payment_method" value="{{ old('payment_method') }}" required>
                                @error('payment_method')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bank_name" class="form-label">Bank Name</label>
                                <input type="text" class="form-control @error('bank_name') is-invalid @enderror {{ $errors->has('bank_name') ? 'is-invalid' : (old('bank_name') ? 'is-valid' : '') }}" id="bank_name" name="bank_name" value="{{ old('bank_name') }}" required>
                                @error('bank_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bank_account_number" class="form-label">Bank Account Number / Mobile Number</label>
                                <input type="text" class="form-control @error('bank_account_number') is-invalid @enderror {{ $errors->has('bank_account_number') ? 'is-invalid' : (old('bank_account_number') ? 'is-valid' : '') }}" id="bank_account_number" name="bank_account_number" value="{{ old('bank_account_number') }}" required>
                                @error('bank_account_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="transaction_reference" class="form-label">Transaction Reference</label>
                                <input type="text" class="form-control @error('transaction_reference') is-invalid @enderror {{ $errors->has('transaction_reference') ? 'is-invalid' : (old('transaction_reference') ? 'is-valid' : '') }}" id="transaction_reference" name="transaction_reference" value="{{ old('transaction_reference') }}" required>
                                @error('transaction_reference')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <!-- /.container-fluid --> --}}

@endsection

