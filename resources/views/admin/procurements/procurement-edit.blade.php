{{-- resources/views/companies/companies-edit.blade.php --}}

@extends('layouts.app')

@section('main-content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                    <h3 class="h3 mb-0 text-gray-800">Edit Company</h3>
                    <a href="{{ route('admin.company-list') }}" class="btn btn-success">Company List</a>
                </div>
                <div class="card-body rounded-circle">
                    <div class="container-fluid mt-5">
                        <form action="{{ route('admin.procurement-update', $procurement->id) }}" method="POST">
                            @csrf
                            {{-- @method('PUT') --}}
                            <div class="mb-3">
                                <label for="product_id" class="form-label">Product</label>
                                <select class="form-select form-control" id="product_id" name="product_id">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ $product->id == $procurement->product_id ? 'selected' : '' }}>{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select class="form-select form-control" id="supplier_id" name="supplier_id">
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ $supplier->id == $procurement->supplier_id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $procurement->quantity }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="cost" class="form-label">Cost</label>
                                <input type="number" class="form-control @error('cost') is-invalid @enderror" id="cost" name="cost" min="0" step="0.01" value="{{ $procurement->cost }}" required>
                                @error('cost')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="other_cost" class="form-label">Other Cost</label>
                                <input type="number" class="form-control @error('other_cost') is-invalid @enderror" id="other_cost" name="other_cost" min="0" step="0.01" value="{{ $procurement->other_cost }}" required>
                                @error('other_cost')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <div class="mb-3">
                                <label for="total_cost" class="form-label">Total Cost</label>
                                <input type="number" class="form-control" id="total_cost" name="total_cost" value="{{ $procurement->total_cost }}" required>
                            </div> --}}
                            <button type="submit" class="btn btn-primary">Update Procurement</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <!-- /.container-fluid --> --}}

@endsection
