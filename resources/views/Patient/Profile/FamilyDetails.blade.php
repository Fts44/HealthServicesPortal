@extends('Layouts.PatientMain')

@push('title')
    <title>Patient Family Details</title>
@endpush

@section('content')
<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Family Details</h1>
    </div>

    <section class="section profile">

        <div class="card">

            <div class="card-body pt-3">
                <form action="{{ route('PatientFamilyDetailsUpdate') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Father's Name -->
                    <div class="row mb-3">
                        <label for="" class="col-lg-12" style="font-weight: 600;">Father's Details:</label>

                        <label class="col-lg-3 mt-1">
                            Firstname
                            <input class="form-control" type="text" name="father_firstname" id="father_firstname" value="{{ old('father_firstname',$user_details->fd_father_firstname) }}">
                            <span class="text-danger">
                                @error('father_firstname')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="col-lg-3 mt-1">
                            Middlename:
                            <input class="form-control" type="text" name="father_middlename" id="father_middlename" value="{{ old('father_middlename',$user_details->fd_father_middlename) }}">
                            <span class="text-danger">
                                @error('father_middlename')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="col-lg-3 mt-1">
                            Lastname
                            <input class="form-control" type="text" name="father_lastname" id="father_lastname" value="{{ old('father_lastname',$user_details->fd_father_lastname) }}">
                            <span class="text-danger">
                                @error('father_lastname')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="col-lg-3 mt-1">
                            Suffixname (Sr,Jr,I,II,...)
                            <input class="form-control" type="text" name="father_suffixname" id="father_suffixname" value="{{ old('father_suffixname',$user_details->fd_father_suffixname) }}">
                            <span class="text-danger">
                                @error('father_suffixname')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                    </div>

                    <!-- Occupation -->
                    <div class="row mb-3">

                        <label for="father_occupation" class="col-lg-3 mt-1">
                            Occupation
                            <input class="form-control" type="text" name="father_occupation" id="father_occupation" value="{{ old('father_occupation',$user_details->fd_father_occupation) }}">
                            <span class="text-danger">
                                @error('father_occupation')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                    </div>

                    <!-- Mothers's Name -->
                    <div class="row mb-3">
                        <label for="" class="col-lg-12" style="font-weight: 600;">Mother's Details:</label>
                        <label class="col-lg-3 mt-1">
                            Firstname
                            <input class="form-control" type="text" name="mother_firstname" id="mother_firstname" value="{{ old('mother_firstname',$user_details->fd_mother_firstname) }}">
                            <span class="text-danger">
                                @error('mother_firstname')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="col-lg-3 mt-1">
                            Middlename
                            <input class="form-control" type="text" name="mother_middlename" id="mother_middlename" value="{{ old('mother_middlename',$user_details->fd_mother_middlename) }}">
                            <span class="text-danger">
                                @error('mother_middlename')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="col-lg-3 mt-1">
                            Lastname
                            <input class="form-control" type="text" name="mother_lastname" id="mother_lastname" value="{{ old('mother_lastname',$user_details->fd_mother_lastname) }}">
                            <span class="text-danger">
                                @error('mother_lastname')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="col-lg-3 mt-1">
                            Suffixname (I,II,...)
                            <input class="form-control" type="text" name="mother_suffixname" id="mother_suffixname" value="{{ old('mother_suffixname',$user_details->fd_mother_suffixname) }}">
                            <span class="text-danger">
                                @error('mother_suffixname')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                    </div>

                    <!-- Mother's occupation, marital status -->
                    <div class="row mb-3">

                        <label for="mother_occupation" class="col-lg-3 mt-1">
                            Occupation
                            <input class="form-control" type="text" name="mother_occupation" id="mother_occupation" value="{{ old('mother_occupation',$user_details->fd_mother_occupation) }}">
                            <span class="text-danger">
                                @error('mother_occupation')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                    </div>

                    <div class="row mb-3">
                        <label for="marital_satus" class="col-lg-3 mt-1">
                            Parent's marital status
                            <select name="marital_satus" id="marital_satus" class="form-select">
                                <option value="">--- choose ---</option>
                                <option value="married" {{ (old('marital_satus',$user_details->fd_marital_status)=='married') ? 'selected' : '' }}>Married</option>
                                <option value="divorced" {{ (old('marital_satus',$user_details->fd_marital_status)=='divorced') ? 'selected' : '' }}>Divorced</option>
                                <option value="separated" {{ (old('marital_satus',$user_details->fd_marital_status)=='separated') ? 'selected' : '' }}>Separated</option>
                            </select>
                            <span class="text-danger">
                                @error('marital_satus')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                  
                    <div class="row mb-3">
                        <label for="" class="col-lg-12" style="font-weight: 600;">Family Illness History:</label>

                        <label for="family_illness_history_diabetes" class="col-lg-2 mt-1">
                            <i class="bi bi-question-circle text-muted"  data-bs-toggle="tooltip" data-bs-placement="top" title="Some description here"></i>
                            Diabetes
                            <select name="family_illness_history_diabetes" id="family_illness_history_diabetes" class="form-select">
                                <option value="0" {{ (old('family_illness_history_diabetes',$user_details->fih_diabetes)=='0') ? 'selected' : '' }}>No</option>
                                <option value="1" {{ (old('family_illness_history_diabetes',$user_details->fih_diabetes)=='1') ? 'selected' : '' }}>Yes</option>
                            </select>
                        </label>

                        <label for="family_illness_history_heart_disease" class="col-lg-2 mt-1">
                            <i class="bi bi-question-circle text-muted"  data-bs-toggle="tooltip" data-bs-placement="top" title="Some description here"></i>
                            Heart Disease
                            <select name="family_illness_history_heart_disease" id="family_illness_history_heart_disease" class="form-select">
                                <option value="0" {{ (old('family_illness_history_heart_disease',$user_details->fih_heart_disease)=='0') ? 'selected' : '' }}>No</option>
                                <option value="1" {{ (old('family_illness_history_heart_disease',$user_details->fih_heart_disease)=='1') ? 'selected' : '' }}>Yes</option>
                            </select>
                        </label>

                        <label for="family_illness_history_mental" class="col-lg-2 mt-1">
                            <i class="bi bi-question-circle text-muted"  data-bs-toggle="tooltip" data-bs-placement="top" title="Some description here"></i>
                            Mental
                            <select name="family_illness_history_mental" id="family_illness_history_mental" class="form-select">
                                <option value="0" {{ (old('family_illness_history_mental',$user_details->fih_mental)=='0') ? 'selected' : '' }}>No</option>
                                <option value="1" {{ (old('family_illness_history_mental',$user_details->fih_mental)=='1') ? 'selected' : '' }}>Yes</option>
                            </select>
                        </label>

                        <label class="col-lg-2 mt-1">
                            <i class="bi bi-question-circle text-muted"  data-bs-toggle="tooltip" data-bs-placement="top" title="Some description here"></i>
                            Cancer
                            <select name="family_illness_history_cancer" id="family_illness_history_cancer" class="form-select">
                                <option value="0" {{ (old('family_illness_history_cancer',$user_details->fih_cancer)=='0') ? 'selected' : '' }}>No</option>
                                <option value="1" {{ (old('family_illness_history_cancer',$user_details->fih_cancer)=='1') ? 'selected' : '' }}>Yes</option>
                            </select>
                        </label>

                        <label for="" class="col-lg-4"></label>

                        <label class="col-lg-2 mt-1">
                            <i class="bi bi-question-circle text-muted"  data-bs-toggle="tooltip" data-bs-placement="top" title="Some description here"></i>
                            Hypertension
                            <select name="family_illness_history_hypertension" id="family_illness_history_hypertension" class="form-select">
                                <option value="0" {{ (old('family_illness_history_hypertension',$user_details->fih_hypertension)=='0') ? 'selected' : '' }}>No</option>
                                <option value="1" {{ (old('family_illness_history_hypertension',$user_details->fih_hypertension)=='1') ? 'selected' : '' }}>Yes</option>
                            </select>
                        </label>

                        <label class="col-lg-2 mt-1">
                            <i class="bi bi-question-circle text-muted"  data-bs-toggle="tooltip" data-bs-placement="top" title="Some description here"></i>
                            Kidney Disease
                            <select name="family_illness_history_kidney_disease" id="family_illness_history_kidney_disease" class="form-select">
                                <option value="0" {{ (old('family_illness_history_kidney_disease',$user_details->fih_kidney_disease)=='0') ? 'selected' : '' }}>No</option>
                                <option value="1" {{ (old('family_illness_history_kidney_disease',$user_details->fih_kidney_disease)=='1') ? 'selected' : '' }}>Yes</option>
                            </select>
                        </label>

                        <label class="col-lg-2 mt-1">
                            <i class="bi bi-question-circle text-muted"  data-bs-toggle="tooltip" data-bs-placement="top" title="Some description here"></i>
                            Epilepsy
                            <select name="family_illness_history_epilepsy" id="family_illness_history_epilepsy" class="form-select">
                                <option value="0" {{ (old('family_illness_history_epilepsy',$user_details->fih_epilepsy)=='0') ? 'selected' : '' }}>No</option>
                                <option value="1" {{ (old('family_illness_history_epilepsy',$user_details->fih_epilepsy)=='1') ? 'selected' : '' }}>Yes</option>
                            </select>
                        </label>

                        <label class="col-lg-2 mt-1">
                            <i class="bi bi-question-circle text-muted"  data-bs-toggle="tooltip" data-bs-placement="top" title="Some description here"></i>
                            Others
                            <select name="family_illness_history_others" id="family_illness_history_others" class="form-select">
                                <option value="0" {{ (old('family_illness_history_others',$user_details->fih_others)=='0') ? 'selected' : '' }}>No</option>
                                <option value="1" {{ (old('family_illness_history_others',$user_details->fih_others)=='1') ? 'selected' : '' }}>Yes</option>
                            </select>
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

@endsection

@push('script')
<script>
    $(document).ready(function(){
   
        @if(session('status'))  
            @php 
                $status = (object)session('status');     
            @endphp
            swal('{{$status->title}}','{{$status->message}}','{{$status->icon}}');
        @endif
    });
</script>
@endpush