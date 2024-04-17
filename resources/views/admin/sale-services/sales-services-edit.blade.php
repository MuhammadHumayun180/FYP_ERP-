@extends('layouts.app')

@section('main-content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                    <h3 class="h3 mb-0 text-gray-800">Update Sales Services</h3>
                    <a href="{{ route('admin.crm-salesServices-list') }}" class="btn btn-success">Sales List</a>
                </div>

                <div class="card-body rounded-circle">
                    <div class="container-fluid mt-5">

                        <form method="POST" action="{{ route('admin.crm-salesServices-update', $salesService->id) }}">
                            @csrf
                            {{-- @method('PUT') <!-- Use PUT method for updating --> --}}
                            <div class="form-group">
                                <label for="customer_id">Customer</label>
                                <select name="customer_id" id="customer_id" class="form-control @error('customer_id') invalid @enderror {{ old('customer_id',$salesService->customer_id) ? 'is-valid' : '' }}">
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ $customer->id === $salesService->customer_id ? 'selected' : '' }}>{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="product_id" class="form-label">Product</label>
                                <select class="form-control @error('product_id') is-invalid @enderror {{ old('product_id',$salesService->product_id) ? 'is-valid' : '' }}" id="product_id" name="product_id" required>
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" {{ $product->id === $salesService->product_id ? 'selected' : '' }}>{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="text" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror {{ old('quantity',$salesService->quantity) ? 'is-valid' : '' }}" value="{{ $salesService->quantity }}" required>
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror {{ old('price',$salesService->price) ? 'is-valid' : '' }}" value="{{ $salesService->price }}" required>
                            </div>

                            <!-- Include Payment Information Fields for Update -->
                            <!-- Payment Information -->
                            <div class="mb-3">
                                <h4>Update Payment Details</h4>
                            </div>

                            <div class="mb-3">
                                <label for="payment_status" class="form-label">Payment Status</label>
                                <select class="form-select form-control @error('payment_status') is-invalid @enderror {{old('payment_status',$salesService->payment->payment_status) ? 'is-valid' : '' }}" id="payment_status" name="payment_status">
                                    <option value="pending" {{ $salesService->payment->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ $salesService->payment->payment_status === 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                @error('payment_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="transaction_type" class="form-label">Transaction Type</label>
                                <select class="form-select form-control @error('transaction_type') is-invalid @enderror {{ old('transaction_type',$salesService->payment->transaction_type) ? 'is-valid' : '' }}" id="transaction_type" name="transaction_type">
                                    <option value="purchase" {{ $salesService->payment->transaction_type === 'purchase' ? 'selected' : '' }}>Purchase</option>
                                    <option value="sale" {{ $salesService->payment->transaction_type === 'sale' ? 'selected' : '' }}>Sale</option>
                                    <!-- Add more options as needed -->
                                </select>
                                @error('transaction_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount Paid</label>
                                <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror {{ old('amount',$salesService->payment->amount) ? 'is-valid' : '' }}" id="amount" name="amount" value="{{ $salesService->payment->amount }}" required>
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="transaction_id" class="form-label">Transaction ID</label>
                                                                <input type="text" class="form-control @error('transaction_id') is-invalid @enderror {{ old('transaction_id',$salesService->payment->transaction_id) ? 'is-valid' : '' }}" id="transaction_id" name="transaction_id" value="{{ $salesService->payment->transaction_id }}" required>
                                @error('transaction_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <input type="text" class="form-control @error('payment_method') is-invalid @enderror {{ old('payment_method',$salesService->payment->payment_method) ? 'is-valid' : '' }}" id="payment_method" name="payment_method" value="{{ $salesService->payment->payment_method }}" required>
                                @error('payment_method')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bank_name" class="form-label">Bank Name</label>
                                <input type="text" class="form-control @error('bank_name') is-invalid @enderror {{ old('bank_name',$salesService->payment->bank_name ) ? 'is-valid' : '' }}" id="bank_name" name="bank_name" value="{{ $salesService->payment->bank_name }}" required>
                                @error('bank_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bank_account_number" class="form-label">Bank Account Number / Mobile Number</label>
                                <input type="text" class="form-control @error('bank_account_number') is-invalid @enderror {{ old('bank_account_number',$salesService->payment->bank_account_number) ? 'is-valid' : '' }}" id="bank_account_number" name="bank_account_number" value="{{ $salesService->payment->bank_account_number }}" required>
                                @error('bank_account_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="transaction_reference" class="form-label">Transaction Reference</label>
                                <input type="text" class="form-control @error('transaction_reference') is-invalid @enderror {{ old('transaction_reference',$salesService->payment->transaction_reference) ? 'is-valid' : '' }}" id="transaction_reference" name="transaction_reference" value="{{ $salesService->payment->transaction_reference }}" required>
                                @error('transaction_reference')
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
<script>
    // Add any scripts here if needed
</script>
@endpush

