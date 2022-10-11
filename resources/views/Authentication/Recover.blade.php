@extends('Layouts.Authentication')

@push('title')
    <title>Login</title>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('css/authentication.css') }}">

@endpush

@section('content')
    <section class="main">
		<div class="login-container">
			<p class="title">BatStateU: Health Portal</p>
        	<div class="separator"></div>
        	<p class="welcome-message">To recover an account, enter your credentials below.</p>

        	<form class="login-form mt-2" method="POST" action="">
                @csrf

                <div class="form-control">
                    <input class="form-control border" type="text" placeholder="Email" name="email" id="email" value="{{ old('email') }}">
                </div>
                <span class="text-danger px-3 error-message" id="email_error">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>


                <div class="form-control">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-8 pe-0" style="width: 70%;">
                                    <input class="form-control border field" type="number" placeholder="One Time Pin" id="otp" name="otp"  value="{{ old('otp') }}">
                                </div>
                                
                                <div class="col-lg-4 ps-1" style="width: 30%;">
                                    <a id="btn_otp" class="btn btn-secondary">
                                        <div class="spinner-border spinner-border-sm text-light d-none" role="status" id="lbl_loading_otp"></div>
                                        <span class="text-light" id="lbl_otp">Get OTP</span>
                                    </a>
                                </div>
                            </div>
                        </div>       
                    </div>
                    <div class="error-message text-danger px-3" style="font-size: 14px;">
                        @error('otp')
                            {{ $message }}
                        @enderror
                    </div>



                <div class="form-control">
                    <input class="form-control border" type="password" placeholder="Password" name="pass" id="pass" value="{{ old('pass') }}">
                    <span class="showpassword fa-regular fa-eye-slash"></span>      
                </div>
                <div class="text-danger px-3" style="max-width: 450px;">
                    @error('pass')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form-control">
                    <input class="form-control border" type="password" placeholder="Password" name="cpass" id="pass1" value="{{ old('cpass') }}">
                    <span class="showpassword fa-regular fa-eye-slash"></span>      
                </div>
                <span class="text-danger px-3">
                    @error('cpass')
                        {{ $message }}
                    @enderror
                </span>
                
                <button id="btnProceed" class="submit btn btn-secondary my-4">Change Password</button>
            </form>

            <p>Already have an account?  Login <a href="{{ route('LoginIndex') }}">here</a> <p>
        </div>
	</section>
@endsection

@push('script')

@endpush