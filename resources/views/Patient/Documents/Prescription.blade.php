@extends('Layouts.PatientMain')

@push('title')
    <title>Patient Prescription</title>
@endpush

@section('content')
<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Document Prescription</h1>
        <nav>
            <ol class="breadcrumb" style="--bs-breadcrumb-divider: '|';">
            </ol>
        </nav>
    </div>

    <section class="section">

        <div class="card" id="card-table">

            <div class="card-body px-4">

                <h5 class="card-title">Prescriptions</h5>
               
                <table id="table_uploads" class="table table-bordered" style="width: 100%;">
                    <thead class="table-light">
                        <th scope="col">ID</th>
                        <th scope="col">Physician</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </thead>
                    <tbody>
                    @foreach($pres as $p)
                        @php $fid = 'PRSCRPTN-'.str_pad($p->form_org_id, 5, 0, STR_PAD_LEFT); @endphp 
                    <tr>
                        <td>{{ $fid }}</td>
                        <td>{{ $p->ttl_title.'. '.$p->firstname.' '.(($p->middlename) ? $p->middlename[0].'. ' : '').$p->lastname }}</td>
                        <td>{{ date_format(date_create($p->form_date_created), 'F d, Y') }}</td>
                        <td>
                            <a href="{{ route('PatientDocumentPrescriptionPrint', ['id'=>$p->form_id]) }}" target="_blank" class="btn btn-primary btn-sm">
                                <i class="bi bi-eye"></i> 
                                View
                            </a>
                        </td>
                    </tr>
                    @endforeach 
                    </tbody>
                </table>

            </div>

        </div>

    </section>

</main>
<!-- main -->

    <form id="delete_form" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('script')

    <!-- datatable js -->
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script>
        @if(session('status'))  
            @php 
                $status = json_decode(session('status'));                      
            @endphp
            swal('{{$status->title}}','{{$status->message}}','{{$status->icon}}');
        @endif
        
        $(document).ready(function(){

            datatable_no_btn_class('#table_uploads');
           
        });
    </script>
@endpush