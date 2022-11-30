@extends('Layouts.AdminMain')

@push('title')
    <title>Emergency Contact</title>
@endpush

@section('content')
<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Emergency Contact</h1>
    </div>

    <section class="section profile">

        <div class="card">

            <div class="card-body pt-3">
                <form action="{{ route('AdminEmergencyContactUpdate') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="row mb-3">
                        <div class="col-lg-3 mt-1">
                            First Name
                            <input class="form-control" type="text" name="first_name" value="{{ old('first_name', $user_emergency_contact_details->ec_firstname) }}">
                            <span class="text-danger">
                                @error('first_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="col-lg-3 mt-1">
                            Middle Name
                            <input class="form-control" type="text" name="middle_name" value="{{ old('middle_name', $user_emergency_contact_details->ec_middlename) }}">
                        </div>

                        <div class="col-lg-3 mt-1">
                            Last Name
                            <input class="form-control" type="text" name="last_name" value="{{ old('last_name',  $user_emergency_contact_details->ec_lastname) }}">
                            <span class="text-danger">
                                @error('last_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="col-lg-3 mt-1">
                            Suffix Name: (Sr,Jr,I,II,...)
                            <input class="form-control" type="text" name="suffix_name"  value="{{ old('suffix_name',  $user_emergency_contact_details->ec_suffixname) }}">
                            <span class="text-danger">
                                @error('suffix_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <!-- Landline, Contact, Relation -->
                    <div class="row mb-3">
                        <div class="col-lg-3 mt-1">
                            Landline
                            <input class="form-control" type="text" name="landline"  value="{{ old('landline',  $user_emergency_contact_details->ec_landline) }}">
                        </div>

                        <div class="col-lg-3 mt-1">
                            Contact
                            <input class="form-control" type="text" name="contact"  value="{{ old('contact',  $user_emergency_contact_details->ec_contact) }}">
                            <span class="text-danger">
                                @error('contact')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="col-lg-3 mt-1">
                            Relation to you
                            <input class="form-control" type="text" name="relation_to_you" value="{{ old('relation_to_you',  $user_emergency_contact_details->ec_relationtopatient) }}">
                            <span class="text-danger">
                                @error('relation_to_you')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <!-- Home address -->
                    <div class="row mb-3">
                        <div class="col-lg-3 mt-1">
                            Business Address (Province)
                            <select name="province" id="province" class="form-select">
                                <option value="">--- choose ---</option>
                                @foreach($ec_provinces as $province)
                                    <option value="{{ $province->prov_code }}" {{ (old('province', $user_emergency_contact_details->prov_code)==$province->prov_code) ? 'selected' : '' }}>{{ $province->prov_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                @error('province')
                                    {{ $message }}
                                @enderror 
                            </span>
                        </div>

                        <div class="col-lg-3 mt-1">
                            Business Address (Municipality)
                            <select name="municipality" id="municipality" class="form-select">
                                <option value="">--- choose ---</option>

                                @if(Session::get('ec_municipalities'))
                                    @foreach(Session::get('ec_municipalities') as $mun)
                                        <option value="{{ $mun->mun_code }}" {{ (old('municipality')==$mun->mun_code) ? 'selected' : '' }}>{{ $mun->mun_name }}</option>
                                    @endforeach
                                @else
                                    @foreach($ec_municipalities as $mun)
                                        <option value="{{ $mun->mun_code }}" {{ ($user_emergency_contact_details->mun_code==$mun->mun_code) ? 'selected' : '' }}>{{ $mun->mun_name }}</option>
                                    @endforeach
                                @endif

                            </select>
                            <span class="text-danger">
                                @error('municipality')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="col-lg-3 mt-1">
                            Business Address (Barangay)
                            <select name="barangay" id="barangay" class="form-select">
                                <option value="">--- choose ---</option>
                                @if(Session::get('ec_barangays'))
                                    @foreach(Session::get('ec_barangays') as $brgy)
                                        <option value="{{ $brgy->brgy_code }}" {{ (old('barangay')==$brgy->brgy_code) ? 'selected' : '' }}>{{ $brgy->brgy_name }}</option>
                                    @endforeach
                                @else
                                    @foreach($ec_barangays as $brgy)
                                        <option value="{{ $brgy->brgy_code }}" {{ ($user_emergency_contact_details->brgy_code==$brgy->brgy_code) ? 'selected' : '' }}>{{ $brgy->brgy_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="text-danger">
                                @error('barangay')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>

                    <div class="row mt-4">
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
    //populate select field
        //address
        $('#province').change(function(){
            set_municipality('#municipality', '', $(this).val(), '#barangay');
        });
        $('#municipality').change(function(){
            set_barangay('#barangay', '', $(this).val());
        });
        //address
    //populate select field
    });
</script>
@endpush