@extends('Layouts.AdminMain')

@push('title')
    <title>User Patient</title>
@endpush

@section('content')
<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Patient Details</h1>
        <nav>
            <ol class="breadcrumb" style="--bs-breadcrumb-divider: '|';">
            </ol>
        </nav>
    </div>
    <section class="section">

        <div class="row">
            <!-- patient details -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center" style="overflow-y: visible; overflow-x: hidden; height: 70vh;">

                        <img src="{{ ($patient_details->profile_pic) ? asset('storage/profile_picture/'.$patient_details->profile_pic) : asset('storage/default_avatar.png') }}" alt="Patient picture" style="width: 200px; height: 190px; border: 1px solid;">
                        <!-- patient details -->
                            <label class="form-control border-0 pt-0 px-0 mt-3 d-flex justify-content-center">
                                <a id="view_emergency_contact" class="btn btn-sm btn-secondary" title="Emergency contact" data-bs-toggle="modal" data-bs-target="#patient_emergency_contact">
                                    <i class="bi bi-telephone"></i>
                                </a>
                                &nbsp;
                                <a id="start_a_conversation" class="btn btn-sm btn-secondary" title="Start a conversation">
                                    <i class="bi bi-chat"></i>
                                </a>
                            </label>

                            <label class="form-control border-0 pt-0 px-0 mt-3">
                                <span class="fw-bold">Account Status:</span><br>
                                <a id="UpdateAccountStatus" class="badge bg-{{ ($patient_details->is_verified) ? 'success' : 'danger' }}" style="cursor: pointer;" data-toggle="tooltip" title="Change Account Status">
                                    {{ ($patient_details->is_verified) ? 'Verified' : 'Not Verified' }}
                                </a>
                            </label>

                            <label class="form-control border-0 pt-0 px-0">
                                <span class="fw-bold">SR-Code:</span><br>
                                {{ $patient_details->sr_code }}
                            </label>

                            <label class="form-control border-0 pt-0 px-0">
                                <span class="fw-bold">Name:</span><br>
                                {{ $patient_details->firstname." ".$patient_details->middlename." ".$patient_details->lastname }}
                            </label>

                            <label class="form-control border-0 pt-0 px-0">
                                <span class="fw-bold">Gender:</span><br>
                                {{ ucwords($patient_details->gender) }}
                            </label>

                            <label class="form-control border-0 pt-0 px-0">
                                <span class="fw-bold">Contact:</span><br>
                                {{ $patient_details->contact }}
                            </label>

                            <label class="form-control border-0 pt-0 px-0">
                                <span class="fw-bold">Email:</span><br>
                                {{ $patient_details->email }}
                            </label>

                            <label class="form-control border-0 pt-0 px-0">
                                <span class="fw-bold">Gsuite:</span><br>
                                {{ $patient_details->gsuite_email }}
                            </label>

                            <label class="form-control border-0 pt-0 px-0">
                                <span class="fw-bold">Classification:</span><br>
                                {{ ucwords($patient_details->classification) }}
                            </label>

                            <label class="form-control border-0 pt-0 px-0">
                                <span class="fw-bold">Grade:</span><br>
                                {{ ($patient_details->gl_name) ? ucwords($patient_details->gl_name) : 'none' }}
                            </label>

                            <label class="form-control border-0 pt-0 px-0">
                                <span class="fw-bold">Department:</span><br>
                                {{ ($patient_details->dept_code) ? ucwords($patient_details->dept_code) : 'none' }}
                            </label>

                            <label class="form-control border-0 pt-0 px-0">
                                <span class="fw-bold">Program:</span><br>
                                {{ ($patient_details->prog_code) ? ucwords($patient_details->prog_code) : 'none' }}
                            </label>

                            <label class="form-control border-0 pt-0 px-0">
                                <span class="fw-bold">Home Address:</span><br>
                                {{ $patient_details->home_brgy_name.", ".$patient_details->home_mun_name.", ".$patient_details->home_prov_name }}
                            </label>

                            <label class="form-control border-0 pt-0 px-0">
                                <span class="fw-bold">Civil Status:</span><br>
                                {{ ucwords($patient_details->civil_status) }}
                            </label>

                            <label class="form-control border-0 pt-0 px-0">
                                <span class="fw-bold">Religion:</span><br>
                                {{ ucwords($patient_details->religion) }}
                            </label>

                            <label class="form-control border-0 pt-0 px-0">
                                <span class="fw-bold">Birthdate:</span><br>
                                {{ date_format(date_create($patient_details->birthdate),'M d, Y') }}
                            </label>

                            <label class="form-control border-0 pt-0 px-0">
                                <span class="fw-bold">Age:</span><br>
                                @php 
                                    $date = new DateTime($patient_details->birthdate);
                                    $now = new DateTime();
                                    $interval = $now->diff($date);
                                @endphp
                                {{ $interval->y }}
                            </label>

                            <label class="form-control border-0 pt-0 px-0">
                                <span class="fw-bold">Birthplace:</span><br>
                                {{ $patient_details->birth_brgy_name.", ".$patient_details->birth_mun_name.", ".$patient_details->birth_prov_name }}
                            </label>

                            <label class="form-control border-0 pt-0 px-0">
                                <span class="fw-bold">Dorm Address:</span><br>
                                {{ $patient_details->dorm_brgy_name.", ".$patient_details->birth_mun_name.", ".$patient_details->birth_prov_name }}
                            </label>
                        <!-- patient details -->
                    </div>
                </div>
            </div>

            <!-- patient past transac -->
            <div class="col-lg-9 px-1">
                <div class="card">
                    <div class="card-body pt-1">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#records" id="records-tab" value="0">Records</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#uploads" id="uploads-tab" value="0">Uploads</button>
                            </li>
                            
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#transaction" id="transaction-tab" value="0">Transaction</button>
                            </li>
                            
                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane fade show active records" id="records">

                            <div id="card-table">
                                    <h6 class="card-title">Patient Records</h6>
                                    <div class="dropdown" style="float: right; margin-top: -2.5rem;">
                                        <a href="#" class="btn btn-secondary btn-sm" role="button" id="records_dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-plus-lg"></i>          
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="records_dropdown" style="max-height: 50vh; overflow-y: scroll;">
                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_form_shr" onclick="insert_new_shr()">Student Health</a></li>
                                            <li><a class="dropdown-item" href="#">Pre-Employment</a></li>
                                        </ul>
                                    </div>
                                    
                                        <table id="table_records" class="table table-bordered" style="width: 100%;">
                                            <thead class="table-light">
                                                <th scope="col">ID</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Created By</th>
                                                <th scope="col">Created At</th>
                                                <th scope="col">Updated At</th>
                                                <th scope="col">Action</th>
                                            </thead>
                                            <tbody>
                                            @foreach($forms as $f)
                                            <tr>
                                                <td>{{ $f->form_id }}</td>
                                                <td>{{ $f->form_type }}</td>
                                                <td>{{ $f->creator }}</td>
                                                <td>{{ date_format(date_create($f->form_date_created), 'F d, Y') }}</td>
                                                <td>{{ ($f->form_date_updated ) ? date_format(date_create($f->form_date_updated), 'F d, Y') : 'N/A' }}</td>
                                                <td>
                                                    @if($f->form_type=='SHR')
                                                        <a class="btn btn-sm btn-secondary" href="{{ route('AdminSHRPrint', ['id'=>$f->form_id]) }}" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                                        <a class="btn btn-sm btn-primary" onclick="retrieve_shr('{{ $f->form_id }}','{{ route('AdminSHRRetrieve', ['id'=>$f->form_id]) }}')"><i class="bi bi-pencil"></i></a>
                                                        <a class="btn btn-sm btn-danger" onclick="delete_shr('{{ $f->form_id }}', '{{ route('AdminSHRDelete', ['id'=>$f->form_id]) }}')"><i class="bi bi-eraser"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                </div>
                                
                            </div>
        
                            <div class="tab-pane fade uploads" id="uploads">

                                <div id="card-table">
                                    <h6 class="card-title">Patient Uploads</h6>
                       
                                    <table id="table_uploads" class="table table-bordered" style="width: 100%;">
                                        <thead class="table-light">
                                            <th scope="col">ID</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Filename</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach($documents as $doc)
                                                <tr>
                                                    <td>{{ $doc->pd_id }}</td>
                                                    <td>{{ $doc->dt_name }}</td>
                                                    <td>{{ $doc->pd_filename }}</td>
                                                    <td>{{ date_format(date_create($doc->pd_date),'F d, y g:h a') }}</td>
                                                    <td>
                                                        @if($doc->pd_verified_status)
                                                            <span class="badge bg-success">Verified</span>
                                                        @else
                                                            <span class="badge bg-secondary">Not Verified</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="route('ViewDocument', ['pd_id' => $doc->pd_id ]) }}" target="_blank" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-eraser"></i>
                                                        </a>  
                                                    </td>
                                                    
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>                     

                            <div class="tab-pane fade transaction" id="transaction">
                                <h6 class="card-title">Transactions</h6>

                                <div class="card-table">
                                    <table id="table_transaction" class="table table-bordered" style="width: 100%;">
                                        <thead class="table-light">
                                            <th scope="col">ID</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Time In</th>
                                            <th scope="col">Time Out</th>
                                            <th scope="col">Purpose</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>January 09, 2000</td>
                                                <td>10:30 am</td>
                                                <td>11:00 am</td>
                                                <td>BP</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

</main>

<form id="delete_form" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@include('Components.Public.StudentHealthRecord');
<!-- main -->
@endsection

@push('script')

    <!-- datatable js -->
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="{{ asset('js/printThis.js') }}"></script>

    <script>
        function redraw_table($id){
            setTimeout(function() { 
                redraw_datatable_class($id);
            }, 200);
        }

        $(document).ready(function(){
    
            datatable_class('#table_records');
            datatable_class('#table_uploads');
            datatable_class('#table_transaction');

            $('#records-tab').click(function(){
                if($(this).val()=='0'){
                    redraw_table('#table_records');
                    $(this).val('1');
                }
            });

            $('#transaction-tab').click(function(){
                if($(this).val()=='0'){
                    redraw_table('#table_transaction');
                    $(this).val('1');
                }
            });

            $('#uploads-tab').click(function(){
                if($(this).val()=='0'){
                    redraw_table('#table_uploads');
                    $(this).val('1');
                }
            });

            $('#hamburgerMenu').click(function(){
                setTimeout(function() { 
                    redraw_datatable_class('#table_records');
                    redraw_datatable_class('#table_uploads');
                    redraw_datatable_class('#table_transaction');
                }, 300);
                $('.nav-link').val('0');
            });
            //table redraw
            //account
                $('#start_a_conversation').tooltip();
                $('#view_emergency_contact').tooltip();
                $("#UpdateAccountStatus").tooltip();
                $('#UpdateAccountStatus').click(function(){
                    swal({
                        title: "Are you sure?",
                        text: "This will change the account verification status of {{ $patient_details->firstname." ".$patient_details->middlename." ".$patient_details->lastname }} to {{ ($patient_details->is_verified) ? 'not verified' : 'verified' }}",
                        icon: "warning",
                        buttons: [
                            'No',
                            'Yes'
                        ],
                        dangerMode: true,
                    }).then(function(isConfirm){
                        if (isConfirm) {
                            $.ajax({
                                type: "GET",
                                url: "route('AdminUpdatePatientAccountStatus',['id'=> $patient_details->acc_id ]) }}",
                                success: function(response){
                                    response = JSON.parse(response);
                                    if(response.status == 200){
                                        swal(response.title, response.message, response.icon).then(()=>{
                                            history.go(0);
                                        });
                                    }
                                    else{
                                        swal(response.title, response.message, response.icon);
                                    }
                                },
                            });
                        }
                    });
                });
            //account
            
        });
    </script>
@endpush