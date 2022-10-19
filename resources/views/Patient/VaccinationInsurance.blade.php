@extends('Layouts.PatientMain')

@push('title')
    <title>Covid Vaccination and Insurance</title>
@endpush

@section('content')
<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Covid Vaccination and Insurance</h1>
        <nav>
            <ol class="breadcrumb" style="--bs-breadcrumb-divider: '|';">
                
            </ol>
        </nav>
    </div>

    <section class="section">
        <!-- insurance and vaccination status -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="{{ route('PatientInsuranceUpdate') }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row pt-4">
                                <label class="col-lg-12" style="font-weight: 600;">Vaccination Status:</label>
                                <div class="col-lg-12">
                                    <div class="row mb-2">
                                        <label for="not" class="col-lg-2 mt-3">
                                            <input type="radio" name="vaccination_status" id="not" value="unvaccinated" {{ ($user_details->vs_status=='unvaccinated') ? 'checked' : '' }}> Unvaccinated
                                        </label>
                                        <label for="partially" class="col-lg-2 mt-3">
                                            <input type="radio" name="vaccination_status" id="partially" value="partially vaccinated" {{ ($user_details->vs_status=='partially vaccinated') ? 'checked' : '' }}> Partially Vaccinated
                                        </label>
                                        <label for="fully" class="col-lg-2 mt-3">
                                            <input type="radio" name="vaccination_status" id="fully" value="fully vaccinated" {{ ($user_details->vs_status=='fully vaccinated') ? 'checked' : '' }}> Fully Vaccinated
                                        </label>
                                        <label for="boosted" class="col-lg-2 mt-3">
                                            <input type="radio" name="vaccination_status" id="boosted" value="boosted" {{ ($user_details->vs_status=='boosted') ? 'checked' : '' }}> Boosted
                                        </label>
                                    </div>
                                    <span class="text-danger mt-1">
                                        @error('vaccination_status')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row mt-3 pb-2">
                                <label class="col-lg-12" style="font-weight: 600;">Insurance:</label>
                                <div class="col-lg-12 mt-2">
                                    <div class="row">
                                        <div class="col-lg-3 mb-1">
                                            <label for="ph_no" class="form-control border-0 p-0">
                                                PhilHealth No:
                                                <input class="form-control" type="text" name="philhealth_no" id="ph_no" value="{{ old('philhealth_no',$user_details->vs_philhealth_no) }}">
                                            </label>
                                        </div>
                                        <div class="col-lg-3 mb-1">
                                            <label for="others" class="form-control border-0 p-0">
                                                Others:
                                                <input class="form-control" type="text" name="others" id="others" value="{{ old('others',$user_details->vs_others) }}">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-2 mt-2">
                                <label class="col-lg-3">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- dosage details table -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">    
                        <h5 class="pt-4 pb-2" style="font-weight: 600; font-size: 15px;">Dosage Details:</h5>
                        
                        <a href="#" class="btn btn-secondary btn-sm" style="float: right; margin-top: -2.5rem;" onclick="clear_dosage()"  data-bs-toggle="modal" data-bs-target="#dosage">
                            <i class="bi bi-plus-lg"></i>          
                        </a>
                        
                        <div class="col-lg-12">
                            <table id="table_vaccination" class="table table-bordered" style="width: 100%;">
                                <thead class="table-light">
                                    <th scope="col">Dosage No.</th>
                                    <th scope="col">Vaccination Date</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Lot No.</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Action</th>
                                </thead>
                                <tbody>
                                @foreach($user_dose_details as $dose)
                                    <tr>
                                        <td>{{ $dose->vdd_dose_number }}</td>
                                        <td>{{ date_format(date_create($dose->vdd_date),'F d, Y') }}</td>
                                        <td>{{ $dose->cvb_brand }}</td>
                                        <td>{{ $dose->vdd_lot_number }}</td>
                                        <td>{{ $dose->mun_name.", ".$dose->prov_name }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" onclick="update_dosage({{ json_encode($dose) }})">
                                                <i class="bi bi-pencil" id="{{ $dose->vdd_id.'_pencil_icon' }}"></i>
                                                <i class="spinner-border spinner-border-sm text-light d-none" id="{{ $dose->vdd_id.'_spinner_icon' }}"></i>
                                            </a>
                                            <a class="btn btn-sm btn-danger" onclick="delete_dosage('{{ $dose->vdd_dose_number }}', '{{ route('PatientDosageDelete', ['id' => $dose->vdd_id]) }}')" data-method="delete"><i class="bi bi-eraser"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                            
                    </div>
                </div>
            </div>
        </div>
        
        <!-- file table -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">    
                        <h5 class="pt-4 pb-2" style="font-weight: 600; font-size: 15px;">File Uploads:</h5>
                        
                        <a href="#" class="btn btn-secondary btn-sm" style="float: right; margin-top: -2.5rem;" onclick="clear_uploads()" data-bs-toggle="modal" data-bs-target="#uploads">
                            <i class="bi bi-plus-lg"></i>          
                        </a>
                        
                        <div class="col-lg-12">
                            <table id="table_uploads" class="table table-bordered" style="width: 100%;">
                                <thead class="table-light">
                                    <th scope="col">#</th>
                                    <th scope="col">Document Type</th>
                                    <th scope="col">Filename</th>
                                    <th scope="col">Date Upload</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </thead>
                                <tbody>
                                    @php $num = 1; @endphp
                                    @foreach($user_documents as $doc)
                                    <tr>
                                        <td>{{ $num++ }}</td>
                                        <td>{{ $doc->dt_name }}</td>
                                        <td>{{ $doc->pd_filename }}</td>
                                        <td>{{ date_format(date_create($doc->pd_date),'F d, Y') }}</td>
                                        <td>
                                            <span class="badge {{ ($doc->pd_verified_status) ? 'bg-success' : 'bg-secondary' }}">{{ ($doc->pd_verified_status) ? 'Verified' : 'Not Verified' }}</span>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="www.google.com" target="_blank">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a class="btn btn-sm btn-danger" onclick="delete_uploads('{{ $doc->pd_filename }}', '{{ route('PatientFileDelete', ['id' => $doc->pd_id]) }}')"><i class="bi bi-eraser"></i></a>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                            
                    </div>
                </div>
            </div>  
        </div>

        <form id="delete_form" action="" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </section>

    <div class="modal fade" id="dosage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Dosage Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="dosage_form" action="{{ route('PatientDosageInsert') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body mb-3">
                        <label for="dose_number" class="form-control border-0 p-0 mb-2">
                            Dose Number:
                            <input class="form-control" type="number" name="vdd_dose_number" id="dose_number" value="{{ old('vdd_dose_number') }}">
                            <span class="text-danger mt-1 dosage-error">
                                @error('vdd_dose_number')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label for="date" class="form-control border-0 p-0 mb-2">
                            Date:
                            <input class="form-control" type="date" name="date" id="date" value="{{ old('date') }}">
                            <span class="text-danger mt-1 dosage-error">
                                @error('date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                        
                        <label for="brand" class="form-control border-0 p-0 mb-2">
                            Brand
                            <select class="form-select" name="brand" id="brand">
                                <option value="">--- choose ---</option>
                                @foreach($covid_vaccination_brands as $brand)
                                    <option value="{{ $brand->cvb_id }}" {{ (old('brand')==$brand->cvb_id) ? 'selected' : '' }}>{{ $brand->cvb_brand }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger mt-1 dosage-error">
                                @error('brand')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label for="lot_number" class="form-control border-0 p-0 mb-2">
                            Lot Number:
                            <input class="form-control" type="text" name="lot_number" id="lot_number" oninput="this.value = this.value.toUpperCase()" value="{{ old('lot_number') }}">
                            <span class="text-danger mt-1 dosage-error">
                                @error('lot_number')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="form-control border-0 p-0 mb-2">
                            Location
                            <div class="row">
                                <label class="col-lg-6 mb-1">
                                    Province:
                                    <select name="province" id="province" class="form-select">
                                        <option value="">--- choose ---</option>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->prov_code }}" {{ (old('province')==$province->prov_code) ? 'selected' : '' }}>{{ $province->prov_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger mt-1 dosage-error">
                                        @error('province')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </label>
                                <div class="col-lg-6">
                                    Municipality:
                                    <select name="municipality" id="municipality" class="form-select">
                                        <option value="">--- choose ---</option>
                                        @if(Session::get('municipalities'))
                                            @foreach(Session::get('municipalities') as $mun)
                                                <option value="{{ $mun->mun_code }}" {{ (old('municipality')==$mun->mun_code) ? 'selected' : '' }}>{{ $mun->mun_name }}</option>
                                            @endforeach
                                        @endif 
                                    </select>
                                    <span class="text-danger mt-1 dosage-error">
                                        @error('municipality')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="sumbit_button_dosage">Add</button>
                    </div>
                </form>
            </div>    
        </div>
    </div>

    <div class="modal fade" id="uploads" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Dosage Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('PatientFileInsert') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-body mb-3">
                        <label class="form-control border-0 p-0">
                            Document Type:
                            <select name="document_type" id="document_type" class="form-select">
                                <option value="">--- choose ---</option>
                                @foreach($doc_type as $type)
                                    <option value="{{ $type->dt_id }}">{{ $type->dt_name }}</option>
                                @endforeach 
                            </select>
                            <span class="text-danger mt-1 uploads-error">
                                @error('document_type')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="form-control border-0 p-0 mt-2">
                            File:
                            <input type="file" name="file" id="file" class="form-control">
                            <span class="text-danger mt-1 uploads-error" id="file_error">
                                @error('file')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submit_button">Add</button>
                    </div>
                </form>
            </div>    
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="{{ asset('js/populate.js') }}"></script>
    <script>
        // dosage clear
        function clear_dosage(){
            $('.dosage-error').html('');
            $('#dose_number').val('');
            $("#date").val('');
            $('#brand').val('');
            $('#lot_number').val('');
            $('#province').val('');
            $('#municipality').val('');
            $('#sumbit_button_dosage').html('Add');
            $('#dosage_form').attr('action', "{{ route('PatientDosageInsert') }}")
            $('.text-danger').html('');
        }

        function clear_uploads(){
            $('.uploads-error').html('');
            $('#document_type').val('');
        }

        function update_dosage(details){ 
            //define variables
            var url = "{{ route('PatientDosageUpdate', ['id' => 'DossageId']) }}";
            var select_mun = '#municipality';
            var mun_code = details.vdd_mun_code;
            var prov_code = details.vdd_prov_code;

            // show loader spinners
            $('#'+details.vdd_id+"_spinner_icon").removeClass('d-none');
            $('#'+details.vdd_id+"_pencil_icon").addClass('d-none');

            clear_dosage();
            // set form data
            $('#dosage_form').attr('action',  url.replace('DossageId', details.vdd_id));
            $('#dose_number').val(details.vdd_dose_number);
            $('#date').val(details.vdd_date);
            $('#brand').val(details.cvb_id);
            $('#lot_number').val(details.vdd_lot_number);
            $('#province').val(details.prov_code);
            $('#sumbit_button_dosage').html('Update');
            
            // set municipality
            // set_mun('#municipality', details.vdd_mun_code, details.vdd_prov_code)
            $(select_mun).empty();
            clear_select(select_mun,'--- choose ---');
            $.ajax({
                url: window.location.origin+"/populate/municipality/"+prov_code,
                type: "GET",
                success: function (response) {
                    $.each( response, function( key, item ) {
                        $(select_mun).append($('<option>', { 
                            value: item.mun_code,
                            text : item.mun_name,
                            selected: (item.mun_code==mun_code) ? true : false
                        }));
                    });
                },
                error: function(response) {
                    console.log(response);
                }
            }).done(function(){
                $('#'+details.vdd_id+"_spinner_icon").addClass('d-none');
                $('#'+details.vdd_id+"_pencil_icon").removeClass('d-none');
                $('#dosage').modal('show');
            });
        }
        
        function delete_dosage(dose, href){
            event.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Your about to delete dosage no."+dose+"!",
                icon: "warning",
                buttons: ["Cancel", "Yes"],
                dangerMode: true,
            }).then(function(value){
                if(value){
                    $('#delete_form').attr('action', href);
                    $('#delete_form').submit();
                }
                else{

                }
            });   
        }
        
        function delete_uploads(doc, href){
            event.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Your about to delete "+doc+"!",
                icon: "warning",
                buttons: ["Cancel", "Yes"],
                dangerMode: true,
            }).then(function(value){
                if(value){
                    $('#delete_form').attr('action', href);
                    $('#delete_form').submit();
                }
            });   
        }

        $(document).ready(function(){
               
            $('#file').change(function(){
                let MAX_FILE_SIZE = 5 * 1024 * 1024;
                let fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    $('#file_error').html("File must no be greater than 5mb!");
                    $(this).val('');
                } else {
                    $('#file_error').html("");
                }
            });
            
            $('#province').change(function(){
                set_municipality('#municipality', '', $(this).val(), '');
            });

            datatable_no_btn_class('#table_vaccination');
            datatable_no_btn_class('#table_uploads');

            $('#hamburgerMenu').click(function(){
                setTimeout(function() { 
                    redraw_datatable_class('#table_vaccination');
                    redraw_datatable_class('#table_insurance');
                }, 300);
            });

            @if(session('status'))  
                @php 
                    $status = (object)session('status');     
                @endphp
                
                @if($status->status==400)
                    @if($status->form=='dosage')
                        @if($status->action=='update')
                            $('#dosage_form').attr('action', "{{ route('PatientDosageUpdate', ['id'=>$status->vdd_id]) }}")
                            $('#sumbit_button_dosage').html('Update');
                        @endif
                        $('#dosage').modal('show');
                    @elseif($status->form=='uploads')
                        $('#uploads').modal('show');
                    @endif
                @else
                    swal('{{$status->title}}','{{$status->message}}','{{$status->icon}}');    
                @endif
            @endif
        });
    </script>
@endpush