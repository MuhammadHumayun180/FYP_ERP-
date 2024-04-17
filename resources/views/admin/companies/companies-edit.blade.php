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
                        <form action="{{ route('admin.company-update', $companyData->id) }}" method="POST">
                            @csrf
                            {{-- @method('PUT') --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Company Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror {{ $companyData->name ? 'is-valid' : '' }}" id="name" name="name" value="{{ $companyData->name }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror {{ $companyData->phone ? 'is-valid' : '' }}" id="phone" name="phone" value="{{ $companyData->phone }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror {{ $companyData->email ? 'is-valid' : '' }}" id="email" name="email" value="{{ $companyData->email }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="industry" class="form-label">Industry</label>
                                <input type="text" class="form-control @error('industry') is-invalid @enderror {{ $companyData->industry ? 'is-valid' : '' }}" id="industry" name="industry" value="{{ $companyData->industry }}">
                                @error('industry')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="size" class="form-label">Size</label>
                                <input type="text" class="form-control @error('size') is-invalid @enderror {{ $companyData->size ? 'is-valid' : '' }}" id="size" name="size" value="{{ $companyData->size }}">
                                @error('size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror {{ $companyData->address ? 'is-valid' : '' }}" id="address" name="address" value="{{ $companyData->address }}">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror {{ $companyData->city ? 'is-valid' : '' }}" id="city" name="city" value="{{ $companyData->city }}">
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="state" class="form-label">State</label>
                                <input type="text" class="form-control @error('state') is-invalid @enderror {{ $companyData->state ? 'is-valid' : '' }}" id="state" name="state" value="{{ $companyData->state }}">
                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="zip_code" class="form-label">Zip Code</label>
                                <input type="text" class="form-control @error('zip_code') is-invalid @enderror {{ $companyData->zip_code ? 'is-valid' : '' }}" id="zip_code" name="zip_code" value="{{ $companyData->zip_code }}">
                                @error('zip_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update Company</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <!-- /.container-fluid --> --}}

@endsection
