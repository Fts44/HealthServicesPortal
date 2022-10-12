@extends('Layouts.Authentication')

@push('title')
    <title>Register</title>
@endpush

@push('css')

@endpush

@section('content')
    <section class="main">
		<div class="login-container">
			<p class="title">BatStateU: Health Portal</p>
        	<div class="separator"></div>
        	<p class="welcome-message">To register an account, enter your credentials below.</p>
        	<form class="login-form" method="POST" action="{{ route('Register') }}">
        
                @csrf
                <div class="form-control">
                    <input class="form-control border" type="text" placeholder="Email" id="email" name="email"  value="{{ old('email') }}"> 
                </div>
                
                <div id="email_error" class="error-message text-danger px-3" style="font-size: 14px;">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>

                <div id="gsuite_email_error" class="error-message text-danger px-3" style="font-size: 14px;">
                </div>

                <div class="form-control">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-8 pe-0" style="width: 70%;">
                                <input class="form-control border" type="number" placeholder="One Time Pin" id="otp" name="otp"  value="{{ old('otp') }}">
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
                    <input class="form-control border" type="password" placeholder="Password" id="pass" name="pass" value="{{ old('pass') }}">
                    <span class="showpassword fa-regular fa-eye-slash"></span>                               
                </div>
                
                <div class="error-message text-danger px-3" style="font-size: 14px; width: 450px;">
                    @error('pass')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form-control">
                    <input class="form-control border" type="password" placeholder="Retype Password" id="pass1" name="cpass" value="{{ old('cpass') }}">   
                    <span class="showpassword fa-regular fa-eye-slash"></span>     
                </div>
                
                <div class="error-message text-danger px-3" style="font-size: 14px;">
                    @error('cpass')
                        {{ $message }}
                    @enderror
                </div>
                
                <div class="form-control">
                    <select class="form-select pt-auto" name="classification" id="classification">
                        <option value="">Choose Classification</option>
                        <option value="student" {{ (old('classification')=='student')?'selected':'' }}>Student</option>
                        <option value="teacher" {{ (old('classification')=='teacher')?'selected':'' }}>Teacher</option>
                        <option value="school personnel" {{ (old('classification')=='school personnel')?'selected':'' }}>School Personnel</option>
                        <option value="infirmary personnel" {{ (old('classification')=='infirmary personnel')?'selected':'' }}>Infirmary Personnel</option>
                    </select>
                </div>
                
                <div class="error-message text-danger px-3" style="font-size: 14px; max-width: 450px;">
                    @error('classification')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form-control">
                    <select class="form-select pt-auto {{ (!$errors->has('position')&&old('position')==null)?'d-none':'' }}" name="position" id="position">
                        <option value="">Choose Position</option>
                        <option value="dentist" {{ (old('position')=='dentist')?'selected':'' }}>Dentist</option>
                        <option value="doctor" {{ (old('position')=='doctor')?'selected':'' }}>Doctor</option>
                        <option value="nurse" {{ (old('position')=='nurse')?'selected':'' }}>Nurse</option>
                    </select>
                </div>
                
                <div class="error-message text-danger px-3" id="position_error" style="font-size: 14px; max-width: 450px;">
                    @error('position')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form-control d-flex text-center">
                    <button class="submit btn btn-secondary" type="submit" style="float: right;">Register</button>
                </div>
                    
            </form>

            <p>Already have an account?  Login <a href="{{ route('LoginIndex') }}">here</a> <p>
        </div>
	</section>
@endsection

@push('script')
<script>
        $(document).ready(function(){

            $('#classification').change(function(e){
                e.preventDefault();
                if($(this).val() == 'infirmary personnel'){
                    $('#position').removeClass('d-none');
                    $('#position_error').removeClass('d-none');
                }
                else{
                    $('#position').addClass('d-none');
                    $('#position_error').addClass('d-none');
                }
            });

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
                        "msg_type": "register",
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