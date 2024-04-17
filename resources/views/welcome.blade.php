<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('vendor/yoeunes/toastr/toastr.min.css') }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            /* background: linear-gradient(to bottom, #000066, #6699FF); */
            background-repeat: no-repeat;
            max-width: 100%;
            height:100%;
            background-image: url('https://github.com/bedimcode/login-form/blob/main/assets/img/login-bg.png?raw=true');

            
            
        }
        .container{
            height: 973px;
           
        }

        .login-container {
            max-width: 400px;
    margin: 0 auto;
    margin-top: 100px;
    background-color: hsla(0, 0%, 100%, .01);
    border: 2px solid hsla(0, 0%, 100%, .7);
    padding: 2.5rem 1rem;
    color: var(--white-color);
    border-radius: 1rem;
    backdrop-filter: blur(16px);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    
        }

        .apply-btn {
            position: fixed;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    

    {{-- <div class="toastr">
        {!! toastr()->render() !!}
    </div> --}}


    <div class="login-container">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h2 class="text-center">ERP Login</h2>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="login_email" class="form-label">Email</label>
                <input type="text" class="form-control @error('login_email') is-invalid @enderror {{ old('login_email') ? 'is-valid' : ' ' }} " id="login_email" name="login_email" value="{{ old('login_email') }}" >
                @error('login_email')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror {{ old('password') ? 'is-valid' : ' ' }} " id="password" name="password" value="{{ old('password') }}">
                @error('password')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>
            <button style="padding: 2% 20%;
               margin: 0 auto;
               display: block;
               border-radius: 18px;
               background-color: transparent;
               border: 2px solid transparent;
               color: #fff;
               text-align: center;
               border: 2px solid white;
               cursor: pointer;" type="submit" class="btn btn-primary">Login</button>

        </form>
    </div>
</div>

<!-- Apply Here Button -->
<button class="apply-btn btn btn-danger" data-bs-toggle="modal" data-bs-target="#applyModal">Apply Here</button>

<!-- Apply Here Modal -->
<div class="modal " id="applyModal" @if($errors->hasAny(['full_name', 'email', 'contact_number', 'cv'])) style="display: block;" @endif>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Apply Here</h5>
                <button type="button" class="btn-close" id="close" data-bs-dismiss="modal" aria-label="Close"></button>
                {{-- <button type="button" class="btn-close" aria-label="Close" onclick="closeApplyModal()"></button> --}}
            </div>
            <div class="modal-body mx-1">
                <!-- Your form for applying, including CV upload option -->
                <form action="{{ route('application.submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Your form for applying, including CV upload option -->
                    <div class="form-group p-2 ">
                        <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" name="full_name" class="form-control @error('full_name') is-invalid @enderror {{ old('full_name') ? 'is-valid' : ' ' }} " placeholder="Enter your full name" value="{{ old('full_name') }}" >
                        @error('full_name')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group p-2">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror {{ old('email') ? 'is-valid' : ' ' }}" placeholder="Enter your email" value="{{ old('email') }}" >
                        @error('email')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group p-2">
                        <label for="contactNumber">Contact Number</label>
                        <input type="text" id="contactNumber" name="contact_number" class="form-control @error('contact_number') is-invalid @enderror {{ old('contact_number') ? 'is-valid' : ' ' }}" placeholder="Enter your Contact Number" value="{{ old('contact_number') }}" >
                        @error('contact_number')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group p-2">
                        <label for="position_applied"> Apply Position</label>
                        <input type="text" id="position_applied" name="position_applied" class="form-control @error('position_applied') is-invalid @enderror {{ old('position_applied') ? 'is-valid' : ' ' }}" placeholder="Enter Apply Position" value="{{ old('position_applied') }}" >
                        @error('position_applied')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group p-2">
                        <label for="cv">Upload CV</label>
                        <input type="file" id="cv" name="cv" class="form-control @error('cv') is-invalid @enderror {{ old('cv') ? 'is-valid' : ' ' }}" accept=".pdf, .doc, .docx">
                        @error('cv')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-3 mb-3">
                        <button type="submit" class="form-control btn btn-success">Submit Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('vendor/yoeunes/toastr/toastr.min.js') }}"></script>




<script>
    $(document).ready(function() {
        $("#close").on("click", function () {
            // console.log("Modal hidden event triggered.");
            window.location.reload(); // Reload the page to clear validation errors
        });
    });


    // <!-- Toastr scripts -->

    // toastr.options = {
    //     "closeButton": true,
    //     "debug": false,
    //     "newestOnTop": false,
    //     "progressBar": false,
    //     "positionClass": "toast-top-right",
    //     "preventDuplicates": true,
    //     "onclick": null,
    //     "showDuration": "300",
    //     "hideDuration": "1000",
    //     "timeOut": "5000",
    //     "extendedTimeOut": "1000",
    //     "showEasing": "swing",
    //     "hideEasing": "linear",
    //     "showMethod": "fadeIn",
    //     "hideMethod": "fadeOut"
    // };
</script>


</body>
</html>
