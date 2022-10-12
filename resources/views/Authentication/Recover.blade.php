@extends('Layouts.Authentication')

@push('title')
    <title>Recover</title>
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

        	<form class="login-form mt-2" method="POST" action="{{ route('Recover') }}">
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
                                    <button id="btn_otp" class="btn btn-secondary" type="button">
                                        <div class="spinner-border spinner-border-sm text-light d-none" role="status" id="lbl_loading_otp"></div>
                                        <span class="text-light" id="lbl_otp">Get OTP</span>
                                    </button>
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
                <div class="error-message text-danger px-3" style="max-width: 450px;">
                    @error('pass')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form-control">
                    <input class="form-control border" type="password" placeholder="Retype Password" name="cpass" id="pass1" value="{{ old('cpass') }}">
                    <span class="showpassword fa-regular fa-eye-slash"></span>      
                </div>
                <span class="error-message text-danger px-3">
                    @error('cpass')
                        {{ $message }}
                    @enderror
                </span>
                
                <button id="btnProceed" class="submit btn btn-secondary my-4" type="submit">Recover</button>
            </form>

            <p>Already have an account?  Login <a href="{{ route('LoginIndex') }}">here</a> <p>
        </div>
	</section>
@endsection

@push('script')
    <script>
        $(document).ready(function(){
            $('#btn_otp').click(function(e){
                e.preventDefault();

                let email = $('#email').val();
                $('.error-message').html('');
                $('#lbl_loading_otp').removeClass('d-none');
                $('#lbl_otp').addClass('d-none');
                $(this).prop('disabled', true);
                
                $.ajax({
                    type: "POST",
                    url: "{{ route('SendOTP') }}",
                    contentType: 'application/json',
                    data: JSON.stringify({
                        "email": email,
                        "msg_type": "recover",
                        "_token": "{{csrf_token()}}",
                    }),
                    success: function(response){
                        response = JSON.parse(response);
                        console.log(response);
                        $('#lbl_loading_otp').addClass('d-none');
                        $('#lbl_otp').removeClass('d-none');
                        $('#btn_otp').prop('disabled', false);
                        if(response.status == 400){
                            $.each(response.errors, function(key, err_values){
                                $('#'+key+'_error').html(err_values);
                            });
                        }
                        else{
                            swal(response.title, response.message, response.icon);
                        }
                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            });
        }); 
    </script>
@endpush