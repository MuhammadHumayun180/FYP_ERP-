{{-- resources/views/applications/index.blade.php --}}

@extends('layouts.app')

@section('main-content')

@push('page-css')

@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    {{-- <!-- Content Row --> --}}
    <div class="row">

        {{-- <!-- Area Chart --> --}}
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                {{-- <!-- Card Header - Dropdown --> --}}

                <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                    <h3 class="h3 mb-0 text-gray-800">List of Applications</h3>
                    <a href="{{ route('admin.talent_acquisitions.list') }}" class="btn btn-primary">Applicants List</a>
                </div>

                {{-- <!-- Card Body --> --}}
                <div class="card-body rounded-circle">
                    <div class="container-fluid mt-5">
                        <!-- Display application details here -->
                        <div>
                            <h2>{{ $application->full_name }}'s Application Details</h2>
                            <p>Email: {{ $application->email }}</p>
                            <p>Contact Number: {{ $application->contact_number }}</p>
                            <p>Position Applied: {{ $application->position_applied }}</p>
                            <p>Applied Date: {{ $application->created_at->format('F d, Y') }}</p>

                            {{-- You can add more details as needed --}}
                        </div>

                        <!-- View CV Button -->
                        <div>
                            @if ($application->cv_path)
                                <a href="{{ route("pdf.show", $application->id) }}" target="_blank" class="btn btn-info btn-sm">Download CV</a>
                                {{-- <a href="{{ route("pdf.download", $application->id) }}" class="btn btn-success btn-sm">Download CV</a> --}}
                            @else
                                <p>No CV attached</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <!-- /.container-fluid --> --}}
<!-- Push a JavaScript script to the 'scripts' stack -->
@push('scripts')

@endpush

@endsection
