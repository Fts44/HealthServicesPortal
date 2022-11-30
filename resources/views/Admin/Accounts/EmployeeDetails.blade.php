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
<style>
    input[readonly].form-control {
        background-color: #ffffff;
    }
</style>
<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Employee Details</h1>
    </div>

    <section class="section profile">

        <div class="card">

            <div class="card-body pt-3">
                <div class="row mb-3">
                    <div class="col-lg-12 d-flex flex-column align-items-center mt-1">
                        <img id="profile_pic_preview" class="form-control p-1" src="{{ asset('storage/profile_picture/'.$e->profile_pic) }}" alt="Upload image" style="height: 200px; width: 200px;">     
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-3 mt-1">
                        Employee ID
                        <input type="text" value="{{ $e->sr_code }}" class="form-control" readonly>
                    </label>
                    <label class="col-lg-3 mt-1">
                        Personal Email
                        <input type="text" value="{{ $e->email }}" class="form-control" readonly>
                    </label>
                    <label class="col-lg-3 mt-1">
                        Gsuite
                        <input type="text" value="{{ $e->gsuite_email }}" class="form-control" readonly>
                    </label>
                    <label class="col-lg-3 mt-1">
                        Title
                        <input type="text" value="{{ $e->ttl_title }}" class="form-control" readonly>
                    </label>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-3 border-0 mt-1">
                        Firstname
                        <input type="text" value="{{ $e->firstname }}" class="form-control" readonly>
                    </label>
                    <label class="col-lg-3 border-0 mt-1">
                        Middlename
                        <input type="text" value="{{ $e->middlename }}" class="form-control" readonly>
                    </label>
                    <label class="col-lg-3 border-0 mt-1">
                        Lastname
                        <input type="text" value="{{ $e->lastname }}" class="form-control" readonly>
                    </label>
                    <label class="col-lg-3 border-0 mt-1">
                        Suffix
                        <input type="text" value="{{ $e->suffixname }}" class="form-control" readonly>
                    </label>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-3 border-0 mt-1">
                        Sex
                        <input type="text" value="{{ ucwords($e->gender) }}" class="form-control" readonly>
                    </label>
                    <label class="col-lg-3 border-0 mt-1">
                        Civil Status
                        <input type="text" value="{{ ucwords($e->civil_status) }}" class="form-control" readonly>
                    </label>
                    <label class="col-lg-3 border-0 mt-1">
                        Contact Number
                        <input type="text" value="{{ $e->contact }}" class="form-control" readonly>
                    </label>
                    <label class="col-lg-3 border-0 mt-1">
                        License Number
                        <input type="text" value="{{ $e->license_no }}" class="form-control" readonly>
                    </label>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-3 border-0 mt-1">
                        Home Province
                        <input type="text" value="{{ $e->home_prov }}" class="form-control" readonly>
                    </label>
                    <label class="col-lg-3 border-0 mt-1">
                        Home Municipality
                        <input type="text" value="{{ $e->home_mun }}" class="form-control" readonly>
                    </label>
                    <label class="col-lg-3 border-0 mt-1">
                        Home Barangay
                        <input type="text" value="{{ $e->home_brgy }}" class="form-control" readonly>
                    </label>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-6 border-0 mt-1">
                        Religion
                        <input type="text" value="{{ $e->religion_name }}" class="form-control" readonly>
                    </label>
                    <label class="col-lg-3 border-0 mt-1">
                        Birthdate
                        <input type="text" value="{{ date_format(date_create($e->birthdate), 'F d, Y') }}" class="form-control" readonly>
                    </label>
                    <label class="col-lg-3 border-0 mt-1">
                        Position
                        <input type="text" value="{{ ucwords($e->position) }}" class="form-control" readonly>
                    </label>
                </div>

                <div class="row mb-3">
                    <label class="col-lg-3 border-0 mt-1">
                        Dormitory Province
                        <input type="text" value="{{ $e->dorm_prov }}" class="form-control" readonly>
                    </label>
                    <label class="col-lg-3 border-0 mt-1">
                        Dormitory Municipality
                        <input type="text" value="{{ $e->dorm_mun }}" class="form-control" readonly>
                    </label>
                    <label class="col-lg-3 border-0 mt-1">
                        Dormitory Barangay
                        <input type="text" value="{{ $e->dorm_brgy }}" class="form-control" readonly>
                    </label>
                </div>

                <div class="row mt-3">
                    <div class="col-lg-3">
                        <button class="btn btn-primary" id="back">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

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
        
        $('#back').click(function(){
            history.go(-1);
        });
    });  
</script>
@endpush



