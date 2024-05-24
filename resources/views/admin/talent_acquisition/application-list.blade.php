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
                </div>

                {{-- <!-- Card Body --> --}}
                <div class="card-body rounded-circle">
                    <div class="container-fluid mt-5">
                        <table class="table" id="applications-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                    <th>Position Applied</th>
                                    <th>Applicant CV</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <!-- /.container-fluid --> --}}
<!-- Push a JavaScript script to the 'scripts' stack -->
@push('scripts')

<script>
    $(function() {
        $('#applications-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.talent_acquisitions.list') }}", // Adjust the route
            scrollX: true, // Enable horizontal scrolling
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'full_name', name: 'full_name' },
                { data: 'email', name: 'email' },
                { data: 'contact_number', name: 'contact_number' },
                { data: 'position_applied', name: 'position_applied' },
                { data: 'user_cv', name: 'user_cv'},
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>

@endpush

@endsection
