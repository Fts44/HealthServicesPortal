@extends('Layouts.PatientMain')

@push('title')
    <title></title>
@endpush

@section('content')
<main id="main" class="main">

    <section class="section profile">

        <div class="card">

            <div class="card-body pt-3">
                <form action="" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-lg-12 text-center">
                            Profile Picture
                            <span class="fr">*</span>
                        </label>
                        <div class="col-lg-12 mt-1 d-flex justify-content-center">
                            <img id="profile_pic_preview" class="form-control p-1" src="{{ ($user_details->profile_pic) ? asset('storage/profile_picture/'.$user_details->profile_pic) : asset('storage/SystemFiles/profile.png') }}" alt="Upload image" style="height: 200px; width: 200px;">
                        </div>
                        <div class="col-lg-12 mt-1 d-flex justify-content-center">
                            <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal">Update Profile Picture</a>
                        </div>
                    </div>

                    <!-- sr-code, personal email, gsuite, otp -->
                    <div class="row mb-3">

                        <label class="col-lg-3 mt-1">
                            SR-Code
                            <input class="form-control" type="text" name="sr_code" value="{{ old('sr_code', $user_details->sr_code) }}">
                            <span class="text-danger">
                                @error('sr_code')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="col-lg-3 mt-1">
                            Personal Email
                            <input class="form-control" type="text" name="email" value="{{ old('email', $user_details->email) }}">
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="col-lg-3 mt-1">
                            Gsuite Email
                            <input class="form-control" type="text" name="gsuite_email" id="gsuite_email" value="{{ old('gsuite_email', $user_details->gsuite_email) }}" {{ ($user_details->gsuite_email) ? 'disabled' : '' }}>
                            <span class="text-danger error-message" id="gsuite_email_error">
                                @error('gsuite_email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="col-lg-3 mt-1 {{ ($user_details->gsuite_email) ? 'd-none' : '' }}">
                            One Time Pin
                            <div class="row">
                                <div class="col-lg-7">
                                    <input class="form-control" type="number" name="otp" id="otp" {{ ($user_details->gsuite_email) ? 'disabled' : '' }}">
                                </div>
                                <div class="col-lg-5">
                                    <a class="btn btn-secondary btn-sm py-2" id="btn_otp" href="#" style="width: 100%; height: 38px;" id="btn_otp">
                                        <span id="lbl_otp" class="">Get OTP</span>
                                        <span class="spinner-border spinner-border-sm d-none" id="lbl_loading" role="status" aria-hidden="true"></span>
                                    </a>
                                </div>
                            </div> 
                            <span class="text-danger error-message" id="otp_error">
                                @error('otp')
                                    {{ $message }}
                                @enderror
                            </span>      
                        </label>
                        
                    </div>
                    <!-- Name -->
                    <div class="row mb-3">
                        
                        <label class="col-lg-3 mt-1">
                            First Name
                            <input class="form-control" type="text" name="first_name" value="{{ old('first_name', $user_details->firstname) }}">
                            <span class="text-danger">
                                @error('first_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                        <label class="col-lg-3 mt-1">
                            Middle Name
                            <input class="form-control" type="text" name="middle_name" value="{{ old('middle_name', $user_details->middlename) }}">
                            <span class="text-danger">
                                @error('middle_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                        <label class="col-lg-3 mt-1">
                            Last Name
                            <input class="form-control" type="text" name="last_name" value="{{ old('last_name', $user_details->lastname) }}">
                            <span class="text-danger">
                                @error('last_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                        <label class="col-lg-3 mt-1">
                            Suffix Name (Sr,Jr,I,II,...)
                            <input class="form-control" type="text" name="suffix_name" value="{{ old('suffix_name', $user_details->suffixname) }}">
                            <span class="text-danger">
                                @error('suffix_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <!-- Gender, Civil Status, Contact -->
                    <div class="row mb-3">
                        <label class="col-lg-3 mt-1">
                            Sex
                            <select class="form-select" name="gender" value="">
                                <option value="">--- choose ---</option>
                                <option value="male" {{ (old('gender',$user_details->gender)=='male') ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ (old('gender',$user_details->gender)=='female') ? 'selected' : '' }}>Female</option>
                            </select>
                            <span class="text-danger">
                                @error('gender')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                        <label class="col-lg-3 mt-1">
                            Civil Status
                            <select class="form-select" name="civil status">
                                <option value="">--- choose ---</option>
                                <option value="single" {{ (old('civil_status',$user_details->civil_status)=='single') ? 'selected' : '' }}>Single</option>
                                <option value="married" {{ (old('civil_status',$user_details->civil_status)=='married') ? 'selected' : '' }}>Married</option>
                                <option value="divorced" {{ (old('civil_status',$user_details->civil_status)=='divorced') ? 'selected' : '' }}>Divorced</option>
                                <option value="separated" {{ (old('civil_status',$user_details->civil_status)=='separated') ? 'selected' : '' }}>Separated</option>
                                <option value="widowed" {{ (old('civil_status',$user_details->civil_status)=='widowed') ? 'selected' : '' }}>Widowed</option>
                            </select>
                            <span class="text-danger">
                                @error('civil_status')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                        <label class="col-lg-3 mt-1">
                            Contact Number
                            <input class="form-control" type="number" name="contact" value="{{ old('contact',$user_details->contact) }}">
                            <span class="text-danger">
                                @error('contact')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <!-- Home address -->
                    <div class="row mb-3">
                        <label class="col-lg-3 mt-1">
                            Home Province
                            <select name="home_province" id="home_province" class="form-select">
                                <option value="">--- choose ---</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->prov_code }}" {{ (old('home_province', $user_details->home_prov)==$province->prov_code) ? 'selected' : '' }}>{{ $province->prov_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                @error('home_province')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                        <label class="col-lg-3 mt-1">
                            Home Municipality
                            <select name="home_municipality" id="home_municipality" class="form-select">
                                <option value="">--- choose ---</option>
                        
                                @if(Session::get('home_municipalities'))
                                    @foreach(Session::get('home_municipalities') as $mun)
                                        <option value="{{ $mun->mun_code }}" {{ (old('home_municipality')==$mun->mun_code) ? 'selected' : '' }}>{{ $mun->mun_name }}</option>
                                    @endforeach
                                @else
                                    @foreach($home_municipalities as $mun)
                                        <option value="{{ $mun->mun_code }}" {{ ($user_details->home_mun==$mun->mun_code) ? 'selected' : '' }}>{{ $mun->mun_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="text-danger">
                                @error('home_municipality')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                        <label class="col-lg-3 mt-1">
                            Home Barangay
                            <select name="home_barangay" id="home_barangay" class="form-select" value="{{ old('home_barangay') }}">
                                <option value="">--- choose ---</option>
                                @if(Session::get('home_barangays'))
                                    @foreach(Session::get('home_barangays') as $brgy)
                                        <option value="{{ $brgy->brgy_code }}" {{ (old('home_barangay')==$brgy->brgy_code) ? 'selected' : '' }}>{{ $brgy->brgy_name }}</option>
                                    @endforeach
                                @else
                                    @foreach($home_barangays as $brgy)
                                        <option value="{{ $brgy->brgy_code }}" {{ ($user_details->home_brgy==$brgy->brgy_code) ? 'selected' : '' }}>{{ $brgy->brgy_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="text-danger">
                                @error('home_barangay')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <!-- Religion, Birthdate, Classification -->
                    <div class="row mb-3">
                        <label class="col-lg-3 mt-1">
                            Religion
                            <input type="text" class="form-control" name="religion" value="{{ old('religion', $user_details->religion) }}">
                            <span class="text-danger">
                                @error('religion')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                        <label class="col-lg-3 mt-1">
                            Birthdate
                            <input type="date" class="form-control" name="birthdate" value="{{ old('birthdate', $user_details->birthdate) }}">
                            <span class="text-danger">
                                @error('birthdate')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                        <label class="col-lg-3 mt-1">
                            Classification
                            <select name="classification" class="form-select">
                                <option value="">--- choose ---</option>
                                <option value="student" {{ (old('classification',$user_details->classification)=='student') ? 'selected' : '' }}>Student</option>
                                <option value="teacher" {{ (old('classification',$user_details->classification)=='teacher') ? 'selected' : '' }}>Teacher</option>
                                <option value="school personnel" {{ (old('classification',$user_details->classification)=='school personnel') ? 'selected' : '' }}>School Personnel</option>
                            </select>
                            <span class="text-danger">
                                @error('classification')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    
                    <!-- Birthplace -->
                    <div class="row mb-3">
                        <label class="col-lg-3 mt-1">
                            Birthplace (Province)
                            <select name="birthplace_province" id="birthplace_province" class="form-select">
                                <option value="">--- choose ---</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->prov_code }}" {{ (old('birthplace_province', $user_details->birth_prov)==$province->prov_code) ? 'selected' : '' }}>{{ $province->prov_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                @error('birthplace_province')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                        <label class="col-lg-3 mt-1">
                            Birthplace (Municipality)
                            <select name="birthplace_municipality" id="birthplace_municipality" class="form-select" value="{{ old('birthplace_municipality') }}">
                                <option value="">--- choose ---</option>
                                @if(Session::get('birthplace_municipalities'))
                                    @foreach(Session::get('birthplace_municipalities') as $mun)
                                        <option value="{{ $mun->mun_code }}" {{ (old('birthplace_municipality')==$mun->mun_code) ? 'selected' : '' }}>{{ $mun->mun_name }}</option>
                                    @endforeach
                                @else 
                                @foreach($birthplace_municipalities as $mun)
                                        <option value="{{ $mun->mun_code }}" {{ ($user_details->birth_mun==$mun->mun_code) ? 'selected' : '' }}>{{ $mun->mun_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="text-danger">
                                @error('birthplace_municipality')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                        <label class="col-lg-3 mt-1">
                            Birthplace (Barangay)
                            <select name="birthplace_barangay" id="birthplace_barangay" class="form-select" value="{{ old('birthplace_barangay') }}">
                                <option value="">--- choose ---</option>
                                @if(Session::get('birthplace_barangays'))
                                    @foreach(Session::get('birthplace_barangays') as $brgy)
                                        <option value="{{ $brgy->brgy_code }}" {{ (old('birthplace_barangay')==$brgy->brgy_code) ? 'selected' : '' }}>{{ $brgy->brgy_name }}</option>
                                    @endforeach
                                @else
                                    @foreach($birthplace_barangays as $brgy)
                                        <option value="{{ $brgy->brgy_code }}" {{ ($user_details->birth_brgy==$brgy->brgy_code) ? 'selected' : '' }}>{{ $brgy->brgy_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="text-danger">
                                @error('birthplace_barangay')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <!-- Grade, Department, Program -->
                    <div class="row mb-3">
                        <label class="col-lg-3 mt-1">
                            Grade level
                            <select name="grade_level" id="grade_level" class="form-select" value="{{ old('grade_level') }}">
                                <option value="">--- choose ---</option>
                                @foreach($grade_levels as $grade_level)
                                    <option value="{{ $grade_level->gl_id }}" {{ (old('grade_level',$user_details->gl_id)==$grade_level->gl_id) ? 'selected' : '' }}>{{ ucwords($grade_level->gl_name) }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                @error('grade_level')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                        <label class="col-lg-3 mt-1">
                            Department
                            <select name="department" id="department" class="form-select" value="{{ old('department') }}">
                                <option value="">--- choose ---</option>
                                @if(Session::get('departments'))
                                    @foreach(Session::get('departments') as $dept)
                                        <option value="{{ $dept->dept_id }}" {{ (old('department')==$dept->dept_id) ? 'selected' : '' }}>{{ ucwords($dept->dept_code) }}</option>
                                    @endforeach
                                @else 
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept->dept_id }}" {{ ($user_details->dept_id==$dept->dept_id) ? 'selected' : '' }}>{{ ucwords($dept->dept_code) }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="text-danger">
                                @error('department')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                        <label class="col-lg-3 mt-1">
                            Program
                            <select name="program" id="program" class="form-select">
                                <option value="">--- choose ---</option>
                                @if(Session::get('programs'))
                                    @foreach(Session::get('programs') as $prog)
                                        <option value="{{ $prog->prog_id }}" {{ (old('program')==$prog->prog_id) ? 'selected' : '' }}>{{ ucwords($prog->prog_code) }}</option>
                                    @endforeach
                                @else 
                                    @foreach($programs as $prog)
                                        <option value="{{ $prog->prog_id }}" {{ ($user_details->prog_id==$prog->prog_id) ? 'selected' : '' }}>{{ ucwords($prog->prog_code) }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="text-danger">
                                @error('program')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <!-- Grade, Department, Program -->
                    <div class="row mb-3">
                        <label class="col-lg-3 mt-1">
                            Height in meter
                            <input type="number" step=".01" class="form-control" name="height" value="{{ old('height', $user_details->height) }}">
                            <span class="text-danger">
                                @error('height')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                        <label class="col-lg-3 mt-1">
                            Weight in kg
                            <input type="number" step=".01" class="form-control" name="weight" value="{{ old('weight', $user_details->weight) }}">
                            <span class="text-danger">
                                @error('weight')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                        <label class="col-lg-3 mt-1">
                            Blood Type
                            <select name="blood_type" id="blood_type" class="form-select">
                                <option value="">--- choose ---</option>
                                <option value="a positive"  {{ (old('blood_type', $user_details->blood_type)=='a positive') ? 'selected' : '' }}>A Positive</option>
                                <option value="a negative"  {{ (old('blood_type', $user_details->blood_type)=='a negative') ? 'selected' : '' }}>A Negative</option>
                                <option value="ab positive" {{ (old('blood_type', $user_details->blood_type)=='ab positive') ? 'selected' : '' }}>AB Positive</option>
                                <option value="ab negative" {{ (old('blood_type', $user_details->blood_type)=='ab negative') ? 'selected' : '' }}>AB Negative</option>
                                <option value="b positive"  {{ (old('blood_type', $user_details->blood_type)=='b positive') ? 'selected' : '' }}>B Positive</option>
                                <option value="b negative"  {{ (old('blood_type', $user_details->blood_type)=='b negative') ? 'selected' : '' }}>B Negative</option>
                                <option value="o positive"  {{ (old('blood_type', $user_details->blood_type)=='o positive') ? 'selected' : '' }}>O Positive</option>
                                <option value="o negative"  {{ (old('blood_type', $user_details->blood_type)=='o negative') ? 'selected' : '' }}>O Negative</option>
                            </select>
                            <span class="text-danger">
                                @error('blood_type')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <!-- Dormitory address -->
                    <div class="row mb-3">
                        <label class="col-lg-3 mt-1">
                            Dormitory (Province):
                            <select name="dormitory_province" id="dormitory_province" class="form-select">
                                <option value="">--- choose ---</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->prov_code }}" {{ (old('dormitory_province',$user_details->dorm_prov)==$province->prov_code) ? 'selected' : '' }}>{{ $province->prov_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                @error('dormitory_province')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                        <label class="col-lg-3 mt-1">
                            Dormitory (Municipality):
                            <select name="dormitory_municipality" id="dormitory_municipality" class="form-select" value="{{ old('dormitory_municipality') }}">
                                <option value="">--- choose ---</option>
                                @if(Session::get('dormitory_municipalities'))
                                    @foreach(Session::get('dormitory_municipalities') as $mun)
                                        <option value="{{ $mun->mun_code }}" {{ (old('dormitory_municipality')==$mun->mun_code) ? 'selected' : '' }}>{{ $mun->mun_name }}</option>
                                    @endforeach
                                @else 
                                    @foreach($dormitory_municipalities as $mun)
                                        <option value="{{ $mun->mun_code }}" {{ ($user_details->dorm_mun==$mun->mun_code) ? 'selected' : '' }}>{{ $mun->mun_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="text-danger">
                                @error('dormitory_municipality')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                        <label class="col-lg-3 mt-1">
                            Dormitory (Barangay):
                            <select name="dormitory_barangay" id="dormitory_barangay" class="form-select" value="{{ old('dormitory_barangay') }}">
                                <option value="">--- choose ---</option>
                                @if(Session::get('dormitory_barangays'))
                                    @foreach(Session::get('dormitory_barangays') as $brgy)
                                        <option value="{{ $brgy->brgy_code }}" {{ (old('dormitory_barangay')==$brgy->brgy_code) ? 'selected' : '' }}>{{ $brgy->brgy_name }}</option>
                                    @endforeach
                                @else 
                                    @foreach($dormitory_barangays as $brgy)
                                        <option value="{{ $brgy->brgy_code }}" {{ ($user_details->dorm_brgy==$brgy->brgy_code) ? 'selected' : '' }}>{{ $brgy->brgy_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="text-danger">
                                @error('dormitory_barangay')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-3">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<!-- main -->
<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Upload New Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body mb-4">
                        <div class="row">
                            <div class=" d-flex justify-content-center">
                                <img id="profile_pic_selected" class="form-control p-1" src="{{ ($user_details->profile_pic) ? asset('storage/profile_picture/'.$user_details->profile_pic) : asset('storage/SystemFiles/profile.png') }}" alt="Upload image" style="height: 200px; width: 200px;">
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <label class="col-form-label col-lg-12 mt-4">Picture:<span class="fr">*</span></label>
                                <input class="form-control" type="file" name="profile_picture" id="profile_pic" accept=".jpg,.png">
                                <span class="text-danger">
                                    @error('profile_picture')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-ligth" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="submit_button">Upload</button>
                    </div>
                </form>
            </div>    
        </div>
    </div>
@endsection
@push('script')
<script src="{{ asset('js/populate.js') }}"></script>
<script>
    $(document).ready(function(){
        @if(session('status'))  
            @php 
                $status = (object)session('status');     
            @endphp
            swal('{{$status->title}}','{{$status->message}}','{{$status->icon}}');
        @endif
        
        @error('profile_picture')
            $('#modal').modal('show');       
        @enderror
        //profile picture
        $('#profile_pic').change(function(){
            let file = $("input[type=file]").get(0).files[0];
            if(file){
                var reader = new FileReader();
                reader.onload = function(){
                    $("#profile_pic_selected").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        });
        //profile picture
        $('#btn_otp').click(function(e){
            e.preventDefault();
            let gsuite_email = $('#gsuite_email').val();
            if(!gsuite_email.includes('@g.batstate-u.edu.ph')){
                swal('Error!', 'Invalid gsuite email', 'error');
            }
            else{
                $('#lbl_loading').removeClass('d-none');
                $('#lbl_otp').addClass('d-none');
                $.ajax({
                    type: "POST",
                    url: "{{ route('SendOTP') }}",
                    contentType: 'application/json',
                    data: JSON.stringify({
                        "email": gsuite_email,
                        "msg_type": "register",
                        "_token": "{{csrf_token()}}",
                    }),
                    success: function(response){
                        response = JSON.parse(response);
                        console.log(response);
                        $('#lbl_loading').addClass('d-none');
                        $('#lbl_otp').removeClass('d-none');
                        if(response.status == 400){
                            $.each(response.errors, function(key, err_values){
                                $('#'+key+'_error').html(err_values);
                            });
                        }
                        else{
                            $('.error-message').html('');
                            swal(response.title, response.message, response.icon);
                        }
                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            }          
        });
        //populate select field
            //home
            $('#home_province').change(function(){
                set_municipality('#home_municipality', '', $(this).val(), '#home_barangay');
            });
            $('#home_municipality').change(function(){
                set_barangay('#home_barangay', '', $(this).val());
            });
            //birthplace
            $('#birthplace_province').change(function(){
                set_municipality('#birthplace_municipality', '', $(this).val(), '#birthplace_barangay');
            });
            $('#birthplace_municipality').change(function(){
                set_barangay('#birthplace_barangay', '', $(this).val());
            });
            //dorm
            $('#dormitory_province').change(function(){
                set_municipality('#dormitory_municipality', '', $(this).val(), '#dormitory_barangay');
            });
            $('#dormitory_municipality').change(function(){
                set_barangay('#dormitory_barangay', '', $(this).val());
            });
            //deparment
            $('#grade_level').change(function(){
                set_department('#department', '', $(this).val(), '#program');
            });
            $('#department').change(function(){
                set_program('#program', '', $(this).val());
            });
        //populate select field
    });
</script>
@endpush



