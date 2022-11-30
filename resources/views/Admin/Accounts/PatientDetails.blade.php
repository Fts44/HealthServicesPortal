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
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center" style="overflow-y: visible; overflow-x: hidden; height: 80vh;">

                        <img src="{{ ($patient_details->profile_pic) ? asset('storage/profile_picture/'.$patient_details->profile_pic) : asset('storage/default_avatar.png') }}" alt="Patient picture" style="width: 200px; height: 190px; border: 1px solid;">
                        <!-- patient details -->
                            <label class="form-control border-0 pt-0 px-0 mt-3 d-flex justify-content-center">
                                <a id="view_emergency_contact" class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" title="Emergency contact" onclick="$('#patient_emergency_contact').modal('show');">
                                    <i class="bi bi-telephone"></i>
                                </a>
                                &nbsp;
                                <a id="view_vaccination" class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" title="Vaccination Details" onclick="$('#patient_vaccination_details').modal('show')">
                                    <i class="bi bi-postcard"></i>
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
                        <ul class="nav nav-tabs nav-tabs-bordered" id="my_tabs">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#records" id="records-tab" value="0">Patient Records</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#uploads" id="uploads-tab" value="0">Patient Uploads</button>
                            </li>
                            
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#transaction" id="transaction-tab" value="0">Transaction</button>
                            </li>
                            
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#dispense_medicine" id="dispense-tab" value="0">Dispense Medicine</button>
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
                                        <ul class="dropdown-menu" aria-labelledby="records_dropdown" style="max-height: 50vh; overflow-y: scroll; cursor: pointer;">
                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_upload_documents">Upload</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_prescription" onclick="insert_new_pres()">Prescription</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_consultation" onclick="insert_cnslt()">Consultation</a></li>
                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_form_shr" onclick="insert_new_shr()">Student Health</a></li>
                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_form_peof" onclick="insert_data_peof()">Pre-Employment</a></li>
                                        </ul>
                                    </div>
                                    
                                        <table id="table_records" class="table table-bordered" style="width: 100%;">
                                            <thead class="table-light">
                                                <th scope="col">ID</th>
                                                <th scope="col">Form</th>
                                                <th scope="col">Created By</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Action</th>
                                            </thead>
                                            <tbody>
                                            @foreach($forms as $f)
                                            <tr>
                                                @php $fform_id = 'RCRDS-'.str_pad($f->form_id, 8, '0', STR_PAD_LEFT); @endphp
                                                <td>{{ $fform_id }}</td>
                                                <td>{{ $f->form_type }}</td>
                                                <td>{{ $f->ttl_title.'. '.$f->firstname.(($f->middlename) ? ' '.$f->middlename[0].'. ' : ' ').$f->lastname }}</td>
                                                <td>{{ date_format(date_create($f->form_date_created), 'M d, Y') }}</td>
                                                <td>{{ ($f->form_editable ) ? 'Generated' : 'Uploaded' }}</td>
                                                <td>
                                                    @if($f->form_type=='SHR')
                                                        <a class="btn btn-sm btn-secondary" href="{{ route('AdminSHRPrint', ['id'=>$f->form_id]) }}" target="_blank"><i class="bi bi-eye"></i></a>
                                                        <a class="btn btn-sm btn-primary" onclick="retrieve_shr('{{ $f->form_id }}','{{ route('AdminSHRRetrieve', ['id'=>$f->form_id]) }}')"><i class="bi bi-pencil"></i></a>
                                                        <a class="btn btn-sm btn-danger" onclick="delete_shr('{{ $f->form_id }}', '{{ route('AdminSHRDelete', ['id'=>$f->form_id]) }}')"><i class="bi bi-eraser"></i></a>
                                                    @elseif($f->form_type=='Prescription')
                                                        <a class="btn btn-sm btn-secondary" href="{{ route('AdminPrescriptionPrint', ['id'=>$f->form_id]) }}" target="_blank"><i class="bi bi-eye"></i></a>
                                                        <a class="btn btn-sm btn-primary" onclick="retrieve_pres('{{ $f->form_id }}','{{ route('AdminPrescriptionRetrieve', ['id'=>$f->form_id]) }}')"><i class="bi bi-pencil"></i></a>
                                                        <a class="btn btn-sm btn-danger" onclick="detele_pres('{{ $f->form_id }}', '{{ route('AdminPrescriptionDelete', ['id'=>$f->form_id]) }}')"><i class="bi bi-eraser"></i></a>
                                                    @elseif($f->form_type=='PEOF')
                                                        <a class="btn btn-sm btn-secondary" href="{{ route('AdminPEOFPrint', ['id'=>$f->form_id]) }}" target="_blank"><i class="bi bi-eye"></i></a>
                                                        <a class="btn btn-sm btn-primary" onclick="retrieve_peof('{{ $f->form_id }}','{{ route('AdminPEOFRetrieve', ['id'=>$f->form_id]) }}')"><i class="bi bi-pencil"></i></a>
                                                        <a class="btn btn-sm btn-danger" onclick="delete_peof('{{ $f->form_id }}', '{{ route('AdminPEOFDelete', ['id'=>$f->form_id]) }}')"><i class="bi bi-eraser"></i></a>
                                                    @elseif($f->form_type=='CNSLT')
                                                        <a class="btn btn-sm btn-secondary" href="{{ route('AdminCnsltPrint', ['id'=>$f->form_id]) }}" target="_blank"><i class="bi bi-eye"></i></a>
                                                        <a class="btn btn-sm btn-primary" onclick="retrieve_cnslt('{{ $f->form_id }}','{{ route('AdminCnsltRetrieve', ['id'=>$f->form_id]) }}')"><i class="bi bi-pencil"></i></a>
                                                        <a class="btn btn-sm btn-danger" onclick="delete_cnslt('{{ $f->form_id }}', '{{ route('AdminCnsltDelete', ['id'=>$f->form_id]) }}')"><i class="bi bi-eraser"></i></a>
                                                    @elseif(!$f->form_editable)
                                                        <a href="{{ route('ViewDocument', ['pd_id' => $f->form_org_id ]) }}" target="_blank" class="btn btn-secondary btn-sm">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <button class="btn btn-sm btn-primary" disabled><i class="bi bi-pencil"></i></button>
                                                        <a class="btn btn-danger btn-sm" onclick="delete_uploads('{{ $fform_id }}', {{ $f->form_org_id }})"><i class="bi bi-eraser"></i></a>  
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
                                                    @php $fpd_id = 'PD-'.str_pad($doc->pd_id, 8, '0', STR_PAD_LEFT); @endphp
                                                    <td>{{ $fpd_id }}</td>
                                                    <td>{{ $doc->dt_name }}</td>
                                                    <td>{{ $doc->pd_filename }}</td>
                                                    <td>{{ date_format(date_create($doc->pd_date),'M d, Y h:i a') }}</td>
                                                    <td>
                                                        @if($doc->pd_verified_status)
                                                            <span class="badge bg-success">Verified</span>
                                                        @else
                                                            <span class="badge bg-secondary">Unverified</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($doc->pd_verified_status)
                                                            <button class="btn btn-sm btn-secondary" onclick="change_doc_status('{{ $fpd_id }}', '{{ $doc->pd_id }}', 1)"><i class="bi bi-x-circle"></i></button>
                                                        @else
                                                            <button class="btn btn-sm btn-success" onclick="change_doc_status('{{ $fpd_id }}', '{{ $doc->pd_id }}', 0)"><i class="bi bi-check-circle"></i></button>
                                                        @endif
                                                            <a href="{{ route('ViewDocument', ['pd_id' => $doc->pd_id ]) }}" target="_blank" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                                                        @if($doc->pd_verified_status)
                                                            <button class="btn btn-danger btn-sm" disabled><i class="bi bi-eraser"></i></button>  
                                                        @else
                                                            <a class="btn btn-danger btn-sm" onclick="delete_patient_upload('{{ $fpd_id }}', '{{ $doc->pd_id }}')"><i class="bi bi-eraser"></i></a>  
                                                        @endif
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
                                            <th scope="col">Attachments</th>
                                        </thead>
                                        <tbody>
                                        @foreach($transactions as $t)
                                        <tr>
                                            @php $ftrans_id = 'TRNSC-'.str_pad($t->trans_id, 8, '0', STR_PAD_LEFT); @endphp
                                            <td>{{ $ftrans_id }}</td>
                                            <td>{{ date_format(date_create($t->trans_date), 'M d, Y') }}</td>
                                            <td>{{ date('h:i a', strtotime($t->trans_time_in)) }}</td>
                                            <td>{{ ($t->trans_time_out) ? date('h:i a', strtotime($t->trans_time_out)) : 'Not Yet' }}</td>
                                            <td>{{ ($t->trans_purpose=='Others') ? $t->trans_purpose_specify : $t->trans_purpose }}</td>
                                            <td class='d-block justify-content-center gx-2'>
                                                @if($t->attachments)
                                                    @php $attachments = explode (",", $t->attachments); @endphp 

                                                    @foreach($attachments as $value)
                                                        @php $fd = explode("-", $value); @endphp 
                                                        
                                                        <div class="input-group input-group-sm mb-1">
                                                            <label class="form-control"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View {{ $fd[0].' #'.$fd[1] }}">
                                                                @if($fd[0]=='SHR')
                                                                    <a href="{{ route('AdminSHRPrint', ['id'=>$fd[1]]) }}" target="_blank">{{ $fd[0].' #'.$fd[1] }}</a>
                                                                @elseif($fd[0]=='Prescription')
                                                                    <a href="{{ route('AdminPrescriptionPrint', ['id'=>$fd[1]]) }}" target="_blank">{{ $fd[0].' #'.$fd[1] }}</a>
                                                                @elseif($fd[0]=='PEOF')
                                                                     <a href="{{ route('AdminPEOFPrint', ['id'=>$fd[1]]) }}" target="_blank">{{ $fd[0].' #'.$fd[1] }}</a>
                                                                @elseif($fd[0]=='CNSLT')
                                                                    <a href="{{ route('AdminCnsltPrint', ['id'=>$fd[1]]) }}" target="_blank">{{ $fd[0].' #'.$fd[1] }}</a>
                                                                @else
                                                                    <a href="{{ route('ViewDocument', ['pd_id' => $fd[2] ]) }}" target="_blank">{{ $fd[0].' #'.$fd[1] }}</a>
                                                                @endif
                                                            </label>
                                                            <button class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Remove {{ $fd[0].' #'.$fd[1] }}" onclick="remove_attachments('{{ $fd[1] }}');">
                                                                <i class="bi bi-x-lg text-light"></i></a>
                                                            </button>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                <div class="input-group input-group-sm mb-1 justify-content-center">
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Attach a file" onclick="$('#transaction_attach_file').modal('show'); $('#trans_id').val('{{ $t->trans_id }}')">
                                                        <i class="bi bi-plus-lg"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach 
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>

                            <div class="tab-pane fade dispense" id="dispense_medicine">
                                <h6 class="card-title">Dispense Medicine</h6>
                                <div class="dropdown" style="float: right; margin-top: -2.5rem;" onclick="$('#medicine_dispense_modal').modal('show');">
                                    <a href="#" class="btn btn-secondary btn-sm">
                                        <i class="bi bi-plus-lg"></i>          
                                    </a>
                                </div>
                                <div class="card-table">
                                    <table id="table_dispense_medicine" class="table table-bordered" style="width: 100%;">
                                        <thead class="table-light">
                                            <th scope="col">Dispense ID</th>
                                            <th scope="col">Medicine ID</th>
                                            <th scope="col">Generic Name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                        </thead>
                                        <tbody>
                                        @foreach($dispense as $d) 
                                        <tr>
                                            @php $fimt_id = 'MDCN-TRNSC-'.str_pad($d->imt_id, 8, '0', STR_PAD_LEFT); @endphp
                                            <td>{{ $fimt_id }}</td>
                                            <td>{{ 'MDCN-'.str_pad($d->imi_id, 5, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $d->imgn_generic_name }}</td>
                                            <td>{{ $d->imt_quantity }}</td>
                                            <td>{{ date_format(date_create($d->imt_date), 'M d, Y h:i a') }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" onclick="update_dispense('{{ $d->imgn_id }}','{{ $d->imi_id }}', '{{ $d->imt_quantity }}', '{{ $d->imt_id }}')">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="delete_dispense('{{ $fimt_id }}', '{{ $d->imt_id }}');">
                                                    <i class="bi bi-eraser"></i>
                                                </button>
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
            </div>

        </div>

    </section>

</main>

<form id="delete_form" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<div class="modal fade" id="transaction_attach_file" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Choose Attachments</h1>
                <input type="hidden" name="trans_id" id="trans_id">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="table_transaction_attachments" class="table table-bordered" style="width: 100%;">
                    <thead class="table-light">
                        <th scope="col">ID</th>
                        <th scope="col">Date</th>
                        <th scope="col">Type</th>
                        <th scope="col">Action</th>
                    </thead>
                    <tbody>
                    @foreach($forms as $f)
                        @if(!$f->form_trans_id)
                            <tr>
                                <td>{{ $f->form_id }}</td>
                                <td>{{ date_format(date_create($f->form_date_created), 'M d, Y') }}</td>
                                <td>{{ $f->form_type }}</td>
                                <td>
                                    @if($f->form_type=='SHR')
                                        <a class="btn btn-sm btn-secondary" href="{{ route('AdminSHRPrint', ['id'=>$f->form_id]) }}" target="_blank"><i class="bi bi-eye"></i></a>
                                    @elseif($f->form_type=='Prescription')
                                        <a class="btn btn-sm btn-secondary" href="{{ route('AdminPrescriptionPrint', ['id'=>$f->form_id]) }}" target="_blank"><i class="bi bi-eye"></i></a>
                                    @elseif($f->form_type=='PEOF')
                                        <a class="btn btn-sm btn-secondary" href="{{ route('AdminPEOFPrint', ['id'=>$f->form_id]) }}" target="_blank"><i class="bi bi-eye"></i></a>
                                    @elseif($f->form_type=='CNSLT')
                                        <a class="btn btn-sm btn-secondary" href="{{ route('AdminCnsltPrint', ['id'=>$f->form_id]) }}" target="_blank"><i class="bi bi-eye"></i></a>
                                    @else 
                                        <a class="btn btn-sm btn-secondary" href="{{ route('ViewDocument', ['pd_id' => $f->form_org_id ]) }}" target="_blank"><i class="bi bi-eye"></i></a>
                                    @endif
                                    <a class="btn btn-sm btn-primary" onclick="add_attachments('{{ $f->form_id }}')"><i class="bi bi-plus-lg"></i></a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save</button> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="medicine_dispense_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Dispense Medicine</h1>
                <input type="hidden" name="trans_id" id="trans_id">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="medicine_dispense_form">
                    @csrf
                    @method('PUT')
                    <label class="form-control border-0 p-0">
                        Medicine:
                        <select name="medicine" id="medicine" class="form-select">
                        <option value="">--- choose ---</option>
                        @foreach($dm as $d) 
                            @if($d->qty_available > 0)
                                <option value="{{ $d->imgn_id }}">{{ $d->imgn_generic_name }}</option>
                            @else 
                                <option value="{{ $d->imgn_id }}" hidden>{{ $d->imgn_generic_name }}</option>
                            @endif
                        @endforeach
                        </select>
                        <span class="text-danger error-medicine_dispense" id="medicine_error"></span>
                    </label>
                    <label class="form-control border-0 p-0 mt-2">
                        ID:
                        <select name="medicine_id" id="medicine_id" class="form-select">
                            <option value="">--- choose ---</option>
                        </select>
                        <span class="text-danger error-medicine_dispense" id="medicine_id_error"></span>
                    </label>
                    <label class="form-control border-0 p-0 mt-2">
                        Qty Available:
                        <input type="text" name="qty_available" id="qty_available" class="form-control" readonly>
                        <span class="text-danger error-medicine_dispense" id="qty_available_error"></span>
                    </label>
                    <label class="form-control border-0 p-0 mt-2 d-none" id="max_dispense_qty_label">
                        Max dispense qty (available + dispense):
                        <input type="text" name="max_dispense_qty" id="max_dispense_qty" class="form-control" readonly>
                        <span class="text-danger error-medicine_dispense" id="max_dispense_qty_error"></span>
                    </label>
                    <label class="form-control border-0 p-0 mt-2">
                        Qty to Dispense:
                        <input type="text" name="qty_to_dispense" id="qty_to_dispense" class="form-control">
                        <span class="text-danger error-medicine_dispense" id="qty_to_dispense_error"></span>
                    </label>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="dispense_medicine_submit_btn">Dispense</button>
            </div>
        </div>
    </div>
</div>

@include('Components.Public.Prescription');
@include('Components.Public.UploadDocuments');
@include('Components.Public.StudentHealthRecord');
@include('Components.Public.PreEmployment');
@include('Components.Public.Consultation');
@include('Components.Modal.EmergencyContact');
@include('Components.Modal.Vaccination');

<!-- main -->
@endsection

@push('script')
    <!-- datatable js -->
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="{{ asset('js/printThis.js') }}"></script>
    <script src="{{ asset('js/populate.js') }}"></script>
    <script>

        function add_attachments(form_id){
            let url = "{{ route('AdminFormAttach',['trans_id'=> 'trans_id', 'form_id' => 'form_id' ]) }}";
            url = url.replace('trans_id', $('#trans_id').val());
            url = url.replace('form_id', form_id);
            $.ajax({
                type: "GET",
                url: url,
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

        function remove_attachments(form_id){
            let url = "{{ route('AdminFormRemove',['form_id' => 'form_id' ]) }}";
            url = url.replace('form_id', form_id);
            $.ajax({
                type: "GET",
                url: url,
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

        function redraw_table($id){
            setTimeout(function() { 
                redraw_datatable_class($id);
            }, 200);
        }

        function refresh_tabs_val(){
            setTimeout(function() { 
                redraw_datatable_class('#table_records');
                redraw_datatable_class('#table_uploads');
                redraw_datatable_class('#table_transaction');
                redraw_datatable_class('#table_dispense_medicine');
            }, 300);
            $('.nav-link').val('0');
        }

        function zeroPad(num, places) {
            var zero = places - num.toString().length + 1;
            return Array(+(zero > 0 && zero)).join("0") + num;
        }

        var update_dispense_url = '';
        var update_imi_id = '';
        var update_dispense_qty = '';
        function update_dispense($imgn_id, $imi_id, $qty_to_dispense, $imt_id){
            $('#medicine').val($imgn_id);
            $('#max_dispense_qty_label').removeClass('d-none');

            clear_select('#medicine_id','--- choose ---');
            $.ajax({
                url: window.location.origin+"/populate/medicine/"+$imgn_id,
                type: "GET",
                async: false,
                success: function (response) {   
                    console.log(response);   
                    $.each( response, function( key, item ) {
                        $('#medicine_id').append($('<option>', { 
                            value: item.imi_id,
                            text : ('MDCN-'+zeroPad(item.imi_id,4)+' (Expr: '+item.imi_expiration+')'),
                            hidden: (item.imi_id==$imi_id || item.qty > 0) ? false : true,
                            selected: (item.imi_id==$imi_id) ? true : false,
                        }));
                    });

                },
                error: function(response) {
                    console.log(response);
                }
            });


            $.ajax({
                url: window.location.origin+"/populate/medicine/qty/"+$imi_id,
                type: "GET",
                async: false,
                success: function (response) {    
                    console.log(response);  
                    $.each( response, function( key, item ) {
                        $('#qty_available').val(item.qty);
                        $('#max_dispense_qty').val(parseInt($qty_to_dispense)+parseInt(item.qty));
                    });
                },
                error: function(response) {
                    console.log(response);
                }
            });

            update_dispense_url = "{{ route('AdminInventoryMedicineDispenseUpdate', ['imt_id'=>'imt_id']) }}";
            update_dispense_url = update_dispense_url.replace('imt_id', $imt_id);
            update_imi_id = $imi_id;
            update_dispense_qty = $qty_to_dispense;

            $('#qty_to_dispense').val($qty_to_dispense);
            $('#dispense_medicine_submit_btn').html('Update')
            $('#medicine_dispense_modal').modal('show');
        }

        function delete_patient_upload($fpd_id, $pd_id){
            var href = "{{ route('AdminPDDeletePD', ['id'=>'id']) }}";
            href = href.replace('id', $pd_id);
            console.log(href);
            swal({
                title: "Are you sure?",
                text: "Your about to delete "+$fpd_id+"!",
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

        function delete_dispense($fimt_id, $imt_id){
            var href = "{{ route('AdminInventoryMedicineItemTransactionDelete', ['id'=>'id']) }}";
            href = href.replace('id', $imt_id);
            console.log(href);
            swal({
                title: "Are you sure?",
                text: "Your about to delete "+$fimt_id+"!",
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

        function change_doc_status($fpd_id, $pd_id, $val){
            var message = ($val) ? "to unverified" : "verified";
            var url = "{{ route('AdminPDUploadsCS', ['pd_id'=>'pd_id']) }}";
            url = url.replace('pd_id', $pd_id);
            swal({
                title: "Are you sure?",
                text: "Change the status of "+$fpd_id+" "+message+"!",
                icon: "warning",
                buttons: ["Cancel", "Yes"],
            }).then(function(value){
                if(value){               
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "PUT",
                        url: url,
                        processData: false,
                        contentType: false,
                        success: function(response){
                            response = JSON.parse(response);
                            swal(response.title, response.message, response.icon);
                            if(response.status == 200){
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
                }
            }); 
        }

        function delete_uploads($fpd_id, $pd_id){
            event.preventDefault();
            var href = "{{ route('AdminPDDelete', ['pd_id'=>'pd_id']) }}";
            href = href.replace('pd_id', $pd_id);
            console.log(href);
            swal({
                title: "Are you sure?",
                text: "Your about to delete "+$fpd_id+"!",
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
            @if(session('status'))  
            @php 
                $status = (object)session('status');     
            @endphp
                swal('{{$status->title}}','{{$status->message}}','{{$status->icon}}');
            @endif
            // set and make active nav tabs
                $('button[data-bs-toggle="tab"]').on('show.bs.tab', function(e) {
                    localStorage.setItem('active_tab', $(e.target).attr('data-bs-target'));
                });
                if(localStorage.getItem('active_tab')){
                    $('#my_tabs button[data-bs-target="' + localStorage.getItem('active_tab') + '"]').tab('show');
                    refresh_tabs_val();
                }
            // set and make active nav tabs

            // table init
                datatable_no_btn_class('#table_records');
                datatable_no_btn_class('#table_uploads');
                datatable_no_btn_class('#table_transaction');
                datatable_no_btn_class('#table_dispense_medicine');

                let table = new DataTable('#table_transaction_attachments', {
                    order: [],
                    info: false
                });
            // table init

            // table redraw
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

                $('#dispense-tab').click(function(){
                    if($(this).val()=='0'){
                        redraw_table('#table_dispense_medicine');
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
                    refresh_tabs_val();
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
        
            $('#medicine').change(function(){
                $('#medicine_id').empty();
                $('#qty_available').val('');
                clear_select('#medicine_id','--- choose ---');
                $.ajax({
                    url: window.location.origin+"/populate/medicine/"+$(this).val(),
                    type: "GET",
                    success: function (response) {   
                        console.log(response);   
                        $.each( response, function( key, item ) {
                            $('#medicine_id').append($('<option>', { 
                                value: item.imi_id,
                                text : ('MDCN-'+zeroPad(item.imi_id,4)+' (Expr: '+item.imi_expiration+')')
                            }));
                        });

                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            }); 

            $('#medicine_id').change(function(){
                $('#qty_available').val('');
                $('#max_dispense_qty').val('');
                console.log(window.location.origin+"/populate/medicine/qty/"+$(this).val());
                $.ajax({
                    url: window.location.origin+"/populate/medicine/qty/"+$(this).val(),
                    type: "GET",
                    success: function (response) {    
                        console.log(response);  
                        $.each( response, function( key, item ) {
                            $('#qty_available').val(item.qty);
                            if(update_imi_id==item.imi_id){
                                $('#max_dispense_qty_label').removeClass('d-none');
                                $('#max_dispense_qty').val(parseInt(item.qty)+parseInt(update_dispense_qty));
                                $('#qty_to_dispense').val(parseInt(update_dispense_qty));
                            }
                            else{
                                $('#max_dispense_qty_label').addClass('d-none');
                                $('#max_dispense_qty').val(parseInt(item.qty));
                                $('#qty_to_dispense').val(0);
                            }
                        });
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });

            $('#dispense_medicine_submit_btn').click(function(){
                $('.error-medicine_dispense').html('');
                var formData = new FormData($('#medicine_dispense_form')[0]);

                var url = '';
                if($(this).html()=='Dispense'){
                    url = "{{ route('AdminInventoryMedicineDispense', ['acc_id' => 'acc_id']) }}";
                    url = url.replace('acc_id', '{{ $patient_details->acc_id }}');
                }
                else{
                    url =  update_dispense_url;
                }

                $.ajax({
                    type: "POST",
                    url: url,
                    contentType: false,
                    processData: false,
                    data: formData,
                    enctype: 'multipart/form-data',
                    success: function(response){
                        response = JSON.parse(response);
                        console.log(response);
                        swal(response.title, response.message, response.icon);
                        if(response.status == 400){
                            $.each(response.errors, function(key, err_values){
                                $('#'+key+'_error').html(err_values);
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
            });
        });
    </script>
@endpush