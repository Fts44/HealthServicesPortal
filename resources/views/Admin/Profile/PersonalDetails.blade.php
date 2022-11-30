<!-- 
    Final Version of patient personal details

    Date: November 15, 2022
    Created by: Joseph E. Calma
 -->

 @extends('Layouts.AdminMain')

@push('title')
    <title></title>
@endpush

@section('content')
<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Personal Details</h1>
    </div>

    <section class="section profile">

        <div class="card">

            <div class="card-body pt-3">
                <form id="profile-form">
                    @method('PUT')
                    @csrf

                    <div class="row mb-3">
                        <div class="col-lg-3 d-flex flex-column align-items-center mt-1">
                            <img id="profile_pic_preview" class="form-control p-1" src="{{ ($acc->profile_pic) ? asset('storage/profile_picture/'.$acc->profile_pic) : asset('storage/SystemFiles/profile.png') }}" alt="Upload image" style="height: 200px; width: 200px;">     
                        </div>
                        <div class="col-lg-3 d-inline-flex align-items-center mt-1">
                            <label class="form-control border-0 p-0 d-block align-items-center">
                                Image
                                <input type="hidden" name="prev_profile_picture" value="{{ $acc->profile_pic }}">
                                <div class="input-group">
                                    <input type="file" class="form-control" name="profile_picture" id="profile_picture">
                                    <button type="button" class="input-group-text" id="profile_pic_reset" style="cursor: pointer;"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Reset Picture"
                                    >
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                </div>
                                <span class="text-danger profile-error" id="profile_picture-error"></span>
                            </label>
                        </div>
                        <div class="col-lg-3 d-inline-flex align-items-center mt-1">
                            <label class="form-control border-0 p-0 d-block align-items-center">
                                Title
                                <select name="title" id="title" class="form-select">
                                    <option value="">--- choose ---</option>
                                    <option value="1" {{ ($acc->title=='1') ? 'selected' : '' }}>Mr.</option>
                                </select>
                                <span class="text-danger profile-error" id="title-error"></span>
                            </label>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-3 mt-1">
                            Employee ID
                            <input type="text" class="form-control"
                            name="employee_id" 
                            id="employee_id" value="{{ $acc->sr_code }}">
                            <span class="text-danger profile-error" id="employee_id-error"></span>
                        </label>
                        <label class="col-lg-3 mt-1">
                            Personal Email
                            <input type="text" class="form-control"
                            name="email" 
                            id="email" value="{{ $acc->email }}">
                            <span class="text-danger profile-error" id="email-error"></span>
                        </label>
                        <label class="col-lg-3 mt-1">
                            Gsuite
                            <input type="text" class="form-control"
                            name="gsuite" 
                            id="gsuite" value="{{ $acc->gsuite_email }}" {{ ($acc->gsuite_email) ? 'disabled' : '' }}>
                            <span class="text-danger profile-error" id="gsuite-error"></span>
                        </label>
                        <label class="col-lg-3 mt-1 {{ ($acc->gsuite_email) ? 'd-none' : '' }}">
                            One time pin
                            <div class="row">
                                <div class="col-lg-7">
                                    <input class="form-control" type="number" name="otp" id="otp">
                                </div>
                                <div class="col-lg-5">
                                    <button class="btn btn-primary btn-sm py-2" id="btn_otp" style="width: 100%; height: 38px;" id="btn_otp">
                                        <span id="lbl_otp" class="">Get OTP</span>
                                        <span class="spinner-border spinner-border-sm d-none" id="lbl_loading" role="status" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                            <span class="text-danger profile-error" id="otp-error"></span>
                        </label>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-3 border-0 mt-1">
                            Firstname
                            <input type="text" class="form-control"
                            name="firstname" 
                            id="firstname" value="{{ $acc->firstname }}">
                            <span class="text-danger profile-error" id="firstname-error"></span>
                        </label>
                        <label class="col-lg-3 border-0 mt-1">
                            Middlename (blank if none)
                            <input type="text" class="form-control" 
                            name="middlename" 
                            id="middlename" value="{{ $acc->middlename }}">
                            <span class="text-danger profile-error" id="middlename-error"></span>
                        </label>
                        <label class="col-lg-3 border-0 mt-1">
                            Lastname
                            <input type="text" class="form-control"
                            name="lastname" 
                            id="lastname" value="{{ $acc->lastname }}">
                            <span class="text-danger profile-error" id="lastname-error"></span>
                        </label>
                        <label class="col-lg-3 border-0 mt-1">
                            Suffix
                            <input type="text" class="form-control"
                            name="suffixname" 
                            id="suffixname" value="{{ $acc->suffixname }}">
                            <span class="text-danger profile-error" id="suffixname-error"></span>
                        </label>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-3 border-0 mt-1">
                            Sex
                            <select name="sex" id="sex" class="form-select">
                                <option value="">--- choose ---</option>
                                <option value="male" {{ ($acc->gender=='male') ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ ($acc->gender=='female') ? 'selected' : '' }}>Female</option>
                            </select>
                            <span class="text-danger profile-error" id="sex-error"></span>
                        </label>
                        <label class="col-lg-3 border-0 mt-1">
                            Civil Status
                            <select name="civil_status" id="civil_status" class="form-select">
                                <option value="">--- choose ---</option>
                                <option value="single" {{ ($acc->civil_status=='single') ? 'selected' : '' }}>Single</option>
                                <option value="married" {{ ($acc->civil_status=='married') ? 'selected' : '' }}>Married</option>
                                <option value="separated" {{ ($acc->civil_status=='separated') ? 'selected' : '' }}>Separated</option>
                                <option value="widowed" {{ ($acc->civil_status=='widowed') ? 'selected' : '' }}>Widowed</option>
                            </select>
                            <span class="text-danger profile-error" id="civil_status-error"></span>
                        </label>
                        <label class="col-lg-3 border-0 mt-1">
                            Contact Number
                            <input type="tel" class="form-control"
                            name="contact" 
                            id="contact" value="{{ $acc->contact }}">
                            <span class="text-danger profile-error" id="contact-error"></span>
                        </label>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-3 border-0 mt-1">
                            Home Province
                            <select name="home_province" id="home_province" class="form-select">
                                <option value="">--- choose ---</option>
                                @foreach($provinces as $p)
                                    <option value="{{ $p->prov_code }}" {{ ($acc->home_prov==$p->prov_code) ? 'selected' : '' }}>{{ $p->prov_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger profile-error" id="home_province-error"></span>
                        </label>
                        <label class="col-lg-3 border-0 mt-1">
                            Home Municipality
                            <select name="home_municipality" id="home_municipality" class="form-select">
                                <option value="">--- choose ---</option>
                                @foreach($home_municipalities as $m)
                                    <option value="{{ $m->mun_code }}" {{ ($m->mun_code==$acc->home_mun) ? 'selected' : '' }}>{{ $m->mun_name }}</option>
                                @endforeach 
                            </select>
                            <span class="text-danger profile-error" id="home_municipality-error"></span>
                        </label>
                        <label class="col-lg-3 border-0 mt-1">
                            Home Barangay
                            <select name="home_barangay" id="home_barangay" class="form-select">
                                <option value="">--- choose ---</option>
                                @foreach($home_barangays as $b)
                                    <option value="{{ $b->brgy_code }}" {{ ($b->brgy_code==$acc->home_brgy) ? 'selected' : '' }}>{{ $b->brgy_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger profile-error" id="home_barangay-error"></span>
                        </label>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-3 border-0 mt-1">
                            Religion
                            <select name="religion" id="religion" class="form-select">
                                <option value="">--- choose ---</option>
                                @foreach($religions as $r)
                                    <option value="{{ $r->religion_id }}" {{ ($r->religion_id==$acc->religion) ? 'selected' : '' }}>{{ $r->religion_name }}</option>
                                @endforeach 
                            </select>
                            <span class="text-danger profile-error" id="religion-error"></span>
                        </label>
                        <label class="col-lg-3 border-0 mt-1">
                            Birthdate
                            <input type="date" name="birthdate" id="birthdate" value="{{ $acc->birthdate }}" class="form-control">
                            <span class="text-danger profile-error" id="birthdate-error"></span>
                        </label>
                        <label class="col-lg-3 border-0 mt-1">
                            Position
                            <select name="position" id="position" class="form-select" disabled>
                                <option value="">--- choose ---</option>
                                <option value="admin" {{ ($acc->position=='admin') ? 'selected' : '' }}>Admin</option>
                                <option value="doctor" {{ ($acc->position=='doctor') ? 'selected' : '' }}>Doctor</option>
                                <option value="dentist" {{ ($acc->position=='dentist') ? 'selected' : '' }}>Dentist</option>
                                <option value="nurse" {{ ($acc->position=='nurse') ? 'selected' : '' }}>Nurse</option>
                            </select>
                            <span class="text-danger profile-error" id="position-error"></span>
                        </label>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-3 border-0 mt-1">
                            Dormitory Province
                            <select name="dormitory_province" id="dormitory_province" class="form-select">
                                <option value="">--- choose ---</option>
                                @foreach($provinces as $p)
                                    <option value="{{ $p->prov_code }}" {{ ($p->prov_code==$acc->dorm_prov) ? 'selected' : '' }}>{{ $p->prov_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger profile-error" id="dormitory_province-error"></span>
                        </label>
                        <label class="col-lg-3 border-0 mt-1">
                            Dormitory Municipality
                            <select name="dormitory_municipality" id="dormitory_municipality" class="form-select">
                                <option value="">--- choose ---</option>
                                @foreach($dormitory_municipalities as $m)
                                    <option value="{{ $m->mun_code }}" {{ ($m->mun_code==$acc->dorm_mun) ? 'selected' : '' }}>{{ $m->mun_name }}</option>
                                @endforeach 
                            </select>
                            <span class="text-danger profile-error" id="dormitory_municipality-error"></span>
                        </label>
                        <label class="col-lg-3 border-0 mt-1">
                            Dormitory Barangay
                            <select name="dormitory_barangay" id="dormitory_barangay" class="form-select">
                                <option value="">--- choose ---</option>
                                @foreach($dormitory_barangays as $b)
                                    <option value="{{ $b->brgy_code }}" {{ ($b->brgy_code==$acc->dorm_brgy) ? 'selected' : '' }}>{{ $b->brgy_name }}</option>
                                @endforeach 
                            </select>
                            <span class="text-danger profile-error" id="dormitory_barangay-error"></span>
                        </label>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-3 d-flex flex-column align-items-center mt-1">
                            <img id="profile_pic_preview" class="form-control p-1" src="{{ ($acc->signature) ? asset('storage/signature/'.$acc->signature) : '' }}" alt="no signature" style="max-height: 80px;width: 200px;">     
                        </div>
                        <div class="col-lg-3 d-inline-flex align-items-center mt-1">
                            <label class="form-control border-0 p-0 d-block align-items-center">
                                Signature
                                <input type="hidden" name="prev_signature" value="{{ $acc->signature }}">
                                <div class="input-group">
                                    <input type="file" class="form-control" name="signature" id="signature">
                                    <button type="button" class="input-group-text" id="signature_reset" style="cursor: pointer;"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Reset Signature"
                                    >
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                </div>
                                <span class="text-danger profile-error" id="signature-error"></span>
                            </label>
                        </div>
                        <div class="col-lg-3 d-inline-flex align-items-center mt-1">
                            <label class="form-control border-0 p-0 d-block align-items-center">
                                License No.
                                <input type="text" class="form-control" name="license_no" id="license_no" value="{{ $acc->license_no }}">
                                <span class="text-danger profile-error" id="title-error"></span>
                            </label>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <button type="button" class="btn btn-primary" id="profile-submit">
                                Save Changes
                            </button>
                            <!-- <button type="button" 
                            class="btn btn-light border border-primary text-primary bg-white"
                            id="profile-unlock-fields"
                            value="{{ ($acc->profile_pic) ? '1' : '0' }}">
                                Unlock Fields
                            </button> -->
                        </div>
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
                <form action="{{ route('PatientPersonalPicUpdate') }}" method="POST" id="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-body mb-4">
                        <div class="row">
                            <div class=" d-flex justify-content-center">
                                <img id="profile_pic_selected" class="form-control p-1" src="" alt="Upload image" style="height: 200px; width: 200px;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-3">
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

    function fields(value){
        @if(!$acc->gsuite_email)
            $('#gsuite, #otp, #btn_otp').attr('disabled', value);
        @endif
        $('#profile_pic, #profile_pic_reset, #profile_picture, #title, #signature, #license_no').attr('disabled', value);
        $('#employee_id, #email').attr('disabled', value);
        $('#firstname, #middlename, #lastname, #suffixname').attr('disabled', value);
        $('#civil_status, #contact').attr('disabled', value);
        $('#home_province, #home_municipality, #home_barangay').attr('disabled', value);
        $('#religion, #birthdate').attr('disabled', value);
        $('#dormitory_province, #dormitory_municipality, #dormitory_barangay, #sex').attr('disabled', value);
    }

    $(document).ready(function(){
        // set fields to lock when the user has acc details
        // @if($acc->profile_pic)
        //     fields(true);
        // @endif

        @if(session('status'))  
            @php 
                $status = (object)session('status');     
            @endphp
            swal('{{$status->title}}','{{$status->message}}','{{$status->icon}}');
        @endif
        
        $('#profile-unlock-fields').click(function(){
            if($(this).val()==1){
                fields(false);
                $(this).html('Lock Fields');
                $(this).val(0);
            }
            else{
                fields(true);
                $(this).html('Unlock Fields');
                $(this).val(1);
            }
        });

        //profile picture
        $('#profile_picture').change(function(){
            let file = $("input[type=file]").get(0).files[0];
            let MAX_FILE_SIZE = 5 * 1024 * 1024;
            let fileSize = this.files[0].size;
            if (fileSize > MAX_FILE_SIZE) {
                $('#profile_picture-error').html("File must no be greater than 5mb!");
                $(this).val('');
            } else {
                $('#profile_picture').html("");
                if(file){
                    var reader = new FileReader();
                    reader.onload = function(){
                        $("#profile_pic_preview").attr("src", reader.result);
                    }
                    reader.readAsDataURL(file);
                }
            }
            
        });

        $('#profile_pic_reset').click(function(){
            $('#profile_pic_preview').attr("src", "{{ ($acc->profile_pic!=NULL) ? asset('storage/profile_picture/'.$acc->profile_pic) : asset('storage/SystemFiles/profile.png') }}");
            $('#profile_picture').val('');
        });
        

        //profile picture
        $('#btn_otp').click(function(e){
            e.preventDefault();
            let gsuite_email = $('#gsuite').val();
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
        //populate select field
        
        $('#profile-submit').click(function(){
            
            let lock_unlock = $('#profile-unlock-fields').val();
            if(lock_unlock == 1){
                fields(false);
            }

            var formData = new FormData($('#profile-form')[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('AdminProfilePersonalDetailsUpdate') }}",
                contentType: false,
                processData: false,
                data: formData,
                enctype: 'multipart/form-data',
                success: function(response){
                    response = JSON.parse(response);
                    console.log(response);
                    swal(response.title, response.message, response.icon);
                    $('.profile-error').html("");
                    if(response.status == 400){
                        $.each(response.errors, function(key, err_values){
                            $('#'+key+'-error').html(err_values);
                        });
                    }
                    else{
                        swal(response.title, response.message, response.icon)
                        .then(function(){
                            location.reload();
                        });           
                    }
                    
                },
                error: function(response){
                    // response = JSON.parse(response);
                    console.log(response);
                }
            })
            if(lock_unlock == 1){
                fields(true);
            }
            else{
                fields(false);
            }
        })
    });
</script>
@endpush



