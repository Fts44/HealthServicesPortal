@extends('Layouts.PatientMain')

@push('title')
    <title>Patient Attendance</title>
@endpush

@section('content')
<main id="main" class="main">

    <div class="pagetitle mb-3">
        <h1>Attendance</h1>
        <nav>
            <ol class="breadcrumb" style="--bs-breadcrumb-divider: '|';">
                
            </ol>
        </nav>
    </div>

    <section class="section profile">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">All Attendance Records</h5>
                        <a href="#" class="btn btn-secondary btn-sm" style="float: right; margin-top: -2.5rem;" data-bs-toggle="modal" data-bs-target="#time_in">
                            <i class="bi bi-plus-lg"></i>          
                        </a>

                        <table id="table_attendance" class="table table-bordered" style="width: 100%;">
                            <thead class="table-light">
                                <th scope="col">Date</th>
                                <th scope="col">TimeIn</th>
                                <th scope="col">TimeOut</th>
                                <th scope="col">Duration</th>
                                <th scope="col">Purpose</th>
                                <th scope="col">Action</th>
                            </thead>
                            <tbody>
                                @foreach($all_attendance as $item)
                                <tr>
                                    <td>{{ date_format(date_create($item->trans_date), 'F d, Y') }}</td>
                                    <td>{{ date_format(date_create($item->trans_time_in),'h:i a') }}</td>
                                    <td>
                                        <span>
                                            {{ ($item->trans_time_out) ? date_format(date_create($item->trans_time_out),'h:i a') : 'Not timed out yet' }}
                                        </span>
                                    </td>
                                    @php 
                                        $time_in = \Carbon\Carbon::parse($item->trans_time_in);
                                        $time_out = \Carbon\Carbon::parse($item->trans_time_out);
                                        $resultMinutes = $time_in->diffInMinutes($time_out, false);
                                        $resultMinutes = $resultMinutes%60;
                                        $resultHours = $time_in->diffInHours($time_out, false);
                                        $resultHours = $resultHours%60;
                                    @endphp 
                                    <td>
                                        <span>
                                            {{ ($item->trans_time_out) ? $resultHours.' hr(s) '.$resultMinutes.' min(s)' : 'NA' }}
                                        </span>
                                    </td>
                                    <td>{{ $item->trans_purpose }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" {{ ($item->trans_time_out) ? 'disabled' : '' }} onclick="time_out('{{ json_encode($item)}}');"><i class="bi bi-box-arrow-left"></i> Time Out</button>
                                    </td>
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
    </section>

  <!-- main -->

    <div class="modal fade" id="time_in" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Time In</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="time_in_form" action="{{ route('PatientAttendanceTimeIn') }}" method="POST">
                    @csrf
                    <div class="modal-body mb-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="form-control border-0 p-0">                     
                                    Date:
                                    <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">
                                    <span class="text-danger">
                                        @error('date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </label>
                                <label class="form-control border-0 p-0 mt-2">
                                    Attendance Code:
                                    <input type="text" name="code" class="form-control" value="{{ old('code') }}">
                                    <span class="text-danger">
                                        @error('code')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </label>
                                <label class="form-control border-0 p-0 mt-2">
                                    Purpose of Visit:
                                    <select name="purpose" id="purpose" class="form-select">
                                        <option value="">--- choose ---</option>
                                        <option value="BP" {{ (old('purpose')=='BP') ? 'selected' : '' }}>BP</option>
                                        <option value="Consultation" {{ (old('purpose')=='Consultation') ? 'selected' : '' }}>Consultation</option>
                                        <option value="Medicine" {{ (old('purpose')=='Medicine') ? 'selected' : '' }}>Medicine</option>
                                        <option value="Medical Certificate" {{ (old('purpose')=='Medical Certificate') ? 'selected' : '' }}>Medical Certificate</option>
                                        <option value="Others" {{ (old('purpose')=='Others') ? 'selected' : '' }}>Others</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('purpose')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </label>
                                <label class="form-control border-0 p-0 mt-2 {{ (!$errors->has('specify_purpose')&&old('purpose')!='Others')?'d-none':'' }}" id="specify_purpose_label">
                                    Specify (Purpose):
                                    <input type="text" name="specify_purpose" id="specify_purpose" class="form-control" value="{{ old('specify_purpose') }}">
                                    <span class="text-danger">
                                        @error('specify_purpose')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </label>
                                <label class="form-control border-0 p-0 mt-2">
                                    Your Password:
                                    <input type="password" name="pass" id="time_in_pass" class="form-control" value="{{ old('pass') }}">
                                    <label for="time_in_sp" class="mt-1">
                                        <input type="checkbox" id="time_in_sp">
                                        Show password
                                    </label>
                                    <br>
                                    <span class="text-danger">
                                        @error('pass')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submit_button">Time In</button>
                    </div>
                </form>
            </div>    
        </div>
    </div>

    <div class="modal fade" id="time_out" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Time Out</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="time_out_form" action="" method="POST">
                    @csrf
                    <div class="modal-body mb-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="form-control border-0 p-0">                     
                                    Date:
                                    <input type="date" name="time_out_date" id="time_out_date" class="form-control" value="{{ old('time_out_date') }}" readonly>
                                </label>

                                <label class="form-control border-0 p-0 mt-2">                     
                                    Time In:
                                    <input type="text" name="time_out_timein" id="time_out_timein" class="form-control" value="{{ old('time_out_timein') }}" readonly>
                                </label>

                                <label class="form-control border-0 p-0 mt-2">
                                    Your Password:
                                    <input type="password" name="time_out_pass" id="time_out_pass" class="form-control" value="{{ old('time_out_pass') }}">
                                    <label for="time_out_sp" class="mt-1">
                                        <input type="checkbox" id="time_out_sp">
                                        Show password
                                    </label>
                                    <br>
                                    <span class="text-danger">
                                        @error('time_out_pass')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submit_button">Time Out</button>
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
        @if(session('status'))  
            @php 
                $status = (object)session('status');     
            @endphp
            swal('{{$status->title}}','{{$status->message}}','{{$status->icon}}');
        @endif
        function time_out(details){
            details = JSON.parse(details);
            let time_in = new Date(details.trans_date+" "+details.trans_time_in);
            let url = "{{ route('PatientAttendanceTimeOut', ['id' => 'id']) }}";
            $('#time_out_form').attr('action', url.replace('id', details.trans_id));
            $('#time_out_timein').val(time_in.toLocaleTimeString());
            $('#time_out_date').val(details.trans_date);
            $('#time_out').modal('show');
        }
        $(document).ready(function(){
            @if($errors->any())     
                @if(session('form')=='time_in')
                    $('#time_in').modal('show');
                @elseif(session('form')=='time_out')
                    $('#time_out').modal('show');
                    $('#time_out_form').attr('action', "{{ route('PatientAttendanceTimeOut', ['id' => Session('trans_id')]) }}")
                @endif
            @endif
            $('#table_attendance').DataTable({
                order: [[0, 'desc']],
                rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                pageLength: 10,
                responsive: true,
                scrollX: true,
                processing: true
            });
            $('#hamburgerMenu').click(function(){
                setTimeout(function() { 
                    redraw_datatable_class('#table_attendance');
                }, 300);
            });
            $('#purpose').change(function(){
                if($(this).val()!='Others'){
                    $('#specify_purpose_label').addClass('d-none');
                }
                else{
                    $('#specify_purpose_label').removeClass('d-none');
                }
            });
            $('#time_in_sp').click(function(){            
                let input = $('#time_in_pass');
                if(input.attr('type') === 'password'){
                    input.attr('type','text');
                }
                else{
                    input.attr('type','password');
                }
            });
            $('#time_out_sp').click(function(){            
                let input = $('#time_out_pass');
                if(input.attr('type') === 'password'){
                    input.attr('type','text');
                }
                else{
                    input.attr('type','password');
                }
            });
        });
    </script>
@endpush