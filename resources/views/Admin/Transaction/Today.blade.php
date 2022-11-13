@extends('Layouts.AdminMain')

@push('title')
    <title>Transaction</title>
@endpush

@section('content')
<main id="main" class="main">

    <div class="pagetitle mb-3">
        <h1>Transaction</h1>
        <nav>
            <ol class="breadcrumb" style="--bs-breadcrumb-divider: '|';">
            
            </ol>
        </nav>
    </div>
    <!-- Admin User Page Title -->

    <section class="section">
        <div class="col-lg-3">
            <div class="card px-4 py-3 mb-3">
                <h5 class="card-title flex-row justify-content-start m-0">
                    Today's Attendance Code:
                </h5>
                <span class="mt-0" id="todays_code">{{$todays_code}}</span>
                <label class="form-control border-0 px-0 pt-1 pb-0">
                    <button class="btn btn-sm btn-secondary" id="new_code">
                        <i class="bi bi-arrow-clockwise"></i> New Code
                    </button>
                </label>
            </div>
        </div>

        <div class="card" id="card-table">

            <div class="card-body px-4">

                <h5 class="card-title">Today's Transaction</h5>

                <table id="datatable" class="table table-bordered" style="width: 100%;">
                    <thead class="table-light">
                        <th scope="col">No</th>
                        <th scope="col">Date</th>
                        <th scope="col">TimeIn</th>
                        <th scope="col">TimeOut</th>
                        <th scope="col">PatientName</th>
                        <th scope="col">Dept/ SRCode/ Course</th>
                        <th scope="col">Classification</th>
                        <th scope="col">Purpose</th>
                    </thead>
                    <tbody>
                    @php $i=sizeof($today_trans) @endphp
                    @foreach($today_trans as $trans)
                    <tr>
                        <td>{{ $i-- }}</td>
                        <td>{{ $trans->trans_date }}</td>
                        <td>{{ date_format(date_create($trans->trans_time_in),'h:i a') }}</td>
                        <td>{{ ($trans->trans_time_out) ? date_format(date_create($trans->trans_time_out),'h:i a') : 'Not timed out yet' }}</td>
                        <td>{{ $trans->trans_patient_name }}</td>
                        <td>{{ $trans->trans_department."/ ".$trans->trans_srcode."/ ".$trans->trans_program }}</td>
                        <td>{{ ucwords($trans->trans_classification) }}</td>
                        <td>{{ ($trans->trans_purpose=='Others') ? ('Others ('.$trans->trans_purpose_specify.') ') : $trans->trans_purpose }}</td>
                    </tr>
                    @endforeach 
                    </tbody>
                </table>

            </div>

        </div>

    </section>

</main>
<!-- main -->
@endsection

@push('script')

    <!-- datatable js -->
    <script src="{{ asset('js/datatable.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('#datatable').DataTable({
                order: [[0, 'desc']],
                pageLength: 10,
                scrollX: true,
                processing: true,
                dom: 'lfrtipB',
                "lengthMenu": [10, 25, 50, 100],
                buttons: [
                    'csv', 'excel',
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        customize : function(doc){
                            var colCount = new Array();
                            $(datatable).find('tbody tr:first-child td').each(function(){
                                if($(this).attr('colspan')){
                                    for(var i=1;i<=$(this).attr('colspan');$i++){
                                        colCount.push('*');
                                    }
                                }
                                else{ 
                                    colCount.push('*'); 
                                }
                            });
                            doc.content[1].table.widths = colCount;
                        }
                    }
                ]
            });

            $('#hamburgerMenu').click(function(){
                setTimeout(function() { 
                    redraw_datatable_class('#datatable');
                }, 300);
            });

            $('#new_code').click(function(){
                event.preventDefault();
                swal({
                    title: "Are you sure?",
                    text: "Your about to get new attendance code for today.",
                    icon: "warning",
                    buttons: ["Cancel", "Yes"]
                }).then(function(value){
                    $(this).attr('disabled', true);
                    $.ajax({
                        async: false,
                        url: "{{ route('AdminGetNewAttendanceCode', ['date' => date('Y-m-d') ]) }}",
                        type: "GET",
                        success: function (response) {      
                            $('#todays_code').html(response);
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                    $(this).attr('disabled', false);
                });  
            });
        });
    </script>
   
@endpush