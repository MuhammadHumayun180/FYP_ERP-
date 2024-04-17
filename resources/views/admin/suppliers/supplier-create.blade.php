{{-- resources/views/procurements/create.blade.php --}}

@extends('layouts.app')

@section('main-content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                    <h3 class="h3 mb-0 text-gray-800">Add Supplier</h3>
                    <a href="{{ route('admin.supplier-list') }}" class="btn btn-success">Supplier List</a>
                </div>

                <div class="card-body rounded-circle">
                    <div class="container-fluid mt-5">
                        <form action="{{ route('admin.supplier-store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Supplier Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="contact_person" class="form-label">Contact Person</label>
                                <input type="text" class="form-control" id="contact_person" name="contact_person" required>
                            </div>
                            <div class="mb-3">
                                <label for="contact_number" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="contact_number" name="contact_number" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Supplier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <!-- /.container-fluid --> --}}

@endsection
