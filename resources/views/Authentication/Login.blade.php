@extends('Layouts.Authentication')

@push('title')
    <title>Login</title>
@endpush

@push('css')

@endpush

@section('content')
    <section class="main">
		<div class="login-container">
			<p class="title">BatStateU: Health Portal</p>
        	<div class="separator"></div>
        	<p class="welcome-message">To login an account, enter your credentials below.</p>

        	<form class="login-form mt-2" method="POST" action="" id="login_form">
                @csrf

                <div class="form-control">
                    <input class="form-control border" type="text" placeholder="Email" name="email" id="email" value="{{ old('userid') }}">
                </div>
                <div class="error-message text-danger px-3" id="email_error" style="font-size: 14px;">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form-control">
                    <input class="form-control border" type="password" placeholder="Password" name="pass" id="pass" value="{{ old('pass') }}">
                    <span class="showpassword fa-regular fa-eye-slash"></span>      
                </div>
                <div class="error-message text-danger px-3" id="pass_error" style="font-size: 14px;">
                    @error('pass')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form-control non-input">
                	<a class="forgotPassword" href="{{ route('RecoverIndex') }}">Forgot Password</a>
                </div>

                <!-- <div class="form-control reCaptcha">
                    <div id="g-recaptcha" class="g-recaptcha" data-callback="recaptchaCallback" data-expired-callback="recaptchaExpired" data-sitekey="6LcasJsgAAAAADf5Toas_DlBccLh5wyGIzmDmjQi"></div>
                </div> -->
                
                <button id="btn_proceed" class="submit btn btn-secondary my-4">
                <div class="spinner-border spinner-border-sm text-light d-none" role="status" id="lbl_loading_proceed"></div>
                    <span id="lbl_proceed">Login</span>   
                </button>
            </form>

            <p> Don't have an account? Sign Up <a href="{{ route('RegisterIndex') }}">here</a> <p>
        </div>
	</section>
@endsection

@push('script')
    <script src="{{ asset('js/recaptcha.js') }}"></script>
    <!-- google recaptcha -->
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

@endpush