{{-- resources/views/procurements/create.blade.php --}}

@extends('layouts.app')

@section('main-content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                    <h3 class="h3 mb-0 text-gray-800">Add Procurement Record</h3>
                    <a href="{{ route('admin.procurement-list') }}" class="btn btn-success">Procurement List</a>
                </div>

                <div class="card-body rounded-circle">
                    <div class="container-fluid mt-5">
                        <form action="{{ route('admin.procurement-store') }}" method="POST">
                            @csrf

                            {{-- <div class="mb-3">
                                <label for="product_id" class="form-label">Product</label>
                                <select class="form-control @error('product_id') is-invalid @enderror" id="product_id" name="product_id" required>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}



                            <div class="mb-3">
                                <label for="supllier_id" class="form-label">Supplier</label>
                                <select class="form-control @error('supplier_id') is-invalid @enderror" id="supllier_id" name="supplier_id" required>
                                    <option value="">Select Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="product_id">Product</label>
                                <select name="product_id" id="product_id" class="form-control">
                                    <option value="">Select Product</option>
                                    {{-- Options will be populated via AJAX based on customer selection --}}
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" min="1" required>
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="cost" class="form-label">Cost</label>
                                <input type="number" class="form-control @error('cost') is-invalid @enderror" id="cost" name="cost" min="0" step="0.01" required>
                                @error('cost')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="other_cost" class="form-label">Other Cost</label>
                                <input type="number" class="form-control @error('other_cost') is-invalid @enderror" id="other_cost" name="other_cost" min="0" step="0.01" required>
                                @error('other_cost')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <div class="mb-3">
                                <label for="total_cost" class="form-label">Total Cost</label>
                                <input type="number" class="form-control @error('total_cost') is-invalid @enderror" id="total_cost" name="total_cost" min="0" step="0.01" required>
                                @error('total_cost')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}

                            <button type="submit" class="btn btn-primary">Add Procurement Record</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <!-- /.container-fluid --> --}}


@push('scripts')
<script>

        $(document).ready(function () {
        $('#supllier_id').change(function () {
            var supplierId = $(this).val();

            $.ajax({
                url: '{{ route("admin.procurement-get-supplier-products") }}',
                type: 'GET',
                data: {
                    supllier_id: supplierId
                },
                success: function (response) {
                    var options = '<option value="">Select Product</option>';

                    $.each(response.products, function (key, product) {
                        options += '<option value="' + product.id + '">' + product.name + '</option>';
                    });

                    $('#product_id').html(options);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });


</script>
@endpush



@endsection
