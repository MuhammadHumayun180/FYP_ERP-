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
                    <h3 class="h3 mb-0 text-gray-800">Employee</h3>
                    <a href="{{ route('admin.employee.list') }}" class="btn btn-success">Employee list</a>
                </div>

                {{-- <!-- Card Body --> --}}
                <div class="card-body rounded-circle">
                    <div class="container-fluid mt-5">

                        <form action="{{ route('admin.employee.store') }}" method="POST">
                            @csrf

                            {{-- <!-- Personal Information --> --}}
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror {{ old('first_name') ? 'is-valid' : '' }}" id="first_name" name="first_name" value="{{ old('first_name') }}" >
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror {{ old('last_name') ? 'is-valid' : '' }} " id="last_name" name="last_name" value="{{ old('last_name') }}" >
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror {{ old('email') ? 'is-valid' : '' }} " id="email" name="email" value="{{ old('email') }}" >
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select form-control @error('gender') is-invalid @enderror {{ old('gender') ? 'is-valid' : '' }} " id="gender" name="gender">
                                    <option value="" selected>Select Gender</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror {{ old('date_of_birth') ? 'is-valid' : '' }}" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" >
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <!-- Employment Information --> --}}
                            <div class="mb-3">
                                <label for="employee_id" class="form-label">Employee ID</label>
                                <input type="text" class="form-control @error('employee_id') is-invalid @enderror {{ old('employee_id') ? 'is-valid' : '' }} " id="employee_id" name="employee_id" value="{{ old('employee_id') }}" >
                                @error('employee_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="position" class="form-label">Position</label>
                                <input type="text" class="form-control @error('position') is-invalid @enderror {{ old('position') ? 'is-valid' : '' }} " id="position" name="position" value="{{ old('position') }}" >
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <input type="text" class="form-control @error('department') is-invalid @enderror {{ old('department') ? 'is-valid' : '' }}" id="department" name="department" value="{{ old('department') }}" >
                                @error('department')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date_of_hire" class="form-label">Date of Hire</label>
                                <input type="date" class="form-control @error('date_of_hire') is-invalid @enderror {{ old('date_of_hire') ? 'is-valid' : '' }} " id="date_of_hire" name="date_of_hire" value="{{ old('date_of_hire') }}" >
                                @error('date_of_hire')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="employment_type" class="form-label">Employment Type</label>
                                <input type="text" class="form-control @error('employment_type') is-invalid @enderror {{ old('employment_type') ? 'is-valid' : '' }} " id="employment_type" name="employment_type" value="{{ old('employment_type') }}" >
                                @error('employment_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="national_id" class="form-label">National ID</label>
                                <input type="text" class="form-control @error('national_id') is-invalid @enderror {{ old('national_id') ? 'is-valid' : '' }} " id="national_id" name="national_id" value="{{ old('national_id') }}" >
                                @error('national_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="social_security_number" class="form-label">Social Security Number</label>
                                <input type="text" class="form-control @error('social_security_number') is-invalid @enderror {{ old('social_security_number') ? 'is-valid' : '' }} " id="social_security_number" name="social_security_number" value="{{ old('social_security_number') }}" >
                                @error('social_security_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="contact_number" class="form-label">Contact Number</label>
                                <input type="text" class="form-control @error('contact_number') is-invalid @enderror {{ old('contact_number') ? 'is-valid' : '' }} " id="contact_number" name="contact_number" value="{{ old('contact_number') }}" >

                                @error('contact_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <!-- Additional Fields --> --}}
                            <div class="mb-3">
                                <label for="basic_salary" class="form-label">Basic Salary</label>
                                <input type="text" class="form-control @error('basic_salary') is-invalid @enderror {{ old('basic_salary') ? 'is-valid' : '' }} " id="basic_salary" name="basic_salary" value="{{ old('basic_salary') }}" >
                                @error('basic_salary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="office_timing" class="form-label">Office Timing</label>
                                <input type="text" class="form-control @error('office_timing') is-invalid @enderror {{ old('office_timing') ? 'is-valid' : '' }} " id="office_timing" name="office_timing" value="{{ old('office_timing') }}" >
                                @error('office_timing')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Add more fields as needed -->

                            <button type="submit" class="btn btn-primary">Add Employee</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <!-- /.container-fluid --> --}}

@endsection
