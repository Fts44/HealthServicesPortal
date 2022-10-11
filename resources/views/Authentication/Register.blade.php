@extends('Layouts.Authentication')

@push('title')
    <title>Registration</title>
@endpush

@push('css')

@endpush

@section('content')
    <section class="main">
		<div class="login-container">
			<p class="title">BatStateU: Health Portal</p>
        	<div class="separator"></div>
        	<p class="welcome-message">To register an account, enter your credentials below.</p>
        	<form class="login-form" method="POST" action="">
        
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
                                <a id="btn_otp" class="btn btn-secondary">
                                    <i class="lbl_loading fa-solid fa-spinner d-none" style="font-size: 14px;"></i>
                                    <span id="btn_otp_lbl">Send</span>
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
                    <input class="form-control border" type="password" placeholder="Password" id="pass" name="pass" value="{{ old('pass') }}">
                    <span class="showpassword fa-regular fa-eye-slash"></span>                               
                </div>
                
                <div class="error-message text-danger px-3" style="font-size: 14px; width: 450px;">
                    @error('pass')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form-control">
                    <input class="form-control border" type="password" placeholder="Confirm New Password" id="cpass" name="cpass" value="{{ old('cpass') }}">   
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
                    <button class="submit btn btn-secondary" style="float: right;">Register</button>
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
        });
    </script>
@endpush