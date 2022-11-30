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
        <div class="card" id="card-table">

            <div class="card-body px-4">

                <h5 class="card-title">Code</h5>

                <table id="datatable" class="table table-bordered" style="width: 100%;">
                    <thead class="table-light">
                        <th scope="col">Date</th>
                        <th scope="col">Code</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </thead>
                    <tbody>
                    @foreach($codes as $c)
                    <tr>
                        @php $fac_date = date_format(date_create($c->ac_date), 'F d, Y') @endphp
                        <td>{{ $fac_date }}</td>
                        <td>{{ $c->ac_code }}</td>
                        <td>
                            @if($c->ac_status)
                                <span class="badge bg-success">
                                    Open
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    Closed
                                </span>
                            @endif 
                        </td>
                        <td>
                            <button class="btn btn-sm {{ ($c->ac_status) ? 'btn-secondary' : 'btn-success' }}" onclick="update_status('{{ $fac_date }}', '{{ $c->ac_status }}', '{{ $c->ac_date }}')">
                                <i class="bi {{ ($c->ac_status) ? 'bi-x-circle' : 'bi-check-circle' }}"></i>
                            </button>
                            <button class="btn btn-sm btn-primary" onclick="update_code('{{ $fac_date }}', '{{ $c->ac_date }}')">
                                <i class="bi bi-arrow-repeat"></i>
                            </button>
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
@endsection

@push('script')

    <!-- datatable js -->
    <script src="{{ asset('js/datatable.js') }}"></script>

    <script>
        function update_code(date, id){
            swal({
                title: "Are you sure?",
                text: "Get new code for "+date+"?",
                icon: "warning",
                buttons: ["Cancel", "Yes"]
            }).then(function(value){
                if(value){
                    var url = "{{ route('AdminGetNewAttendanceCode', ['date' => 'date' ]) }}";
                    url = url.replace('date', id);
                    $.ajax({
                        async: false,
                        url: url,
                        type: "GET",
                        success: function (response) {      
                            swal('Success', 'The code was refresh', 'success')
                            .then(function(value){
                                    location.reload();
                            });
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }

        function update_status(date, old_status, id){
            var osm = '';
            if(old_status == 1){
                osm = 'Closed';
            }
            else{
                osm = 'Open';
            }
            swal({
                title: "Are you sure?",
                text: "Change the status of "+date+" to "+osm,
                icon: "warning",
                buttons: ["Cancel", "Yes"]
            }).then(function(value){
                if(value){
                    var url = "{{ route('AdminAttendanceCodeStatusChange', ['date' => 'date' ]) }}";
                    url = url.replace('date', id);
                    $.ajax({
                        async: false,
                        url: url,
                        type: "GET",
                        success: function (response) {      
                            swal('Success', 'The status was changed', 'success')
                            .then(function(value){
                                    location.reload();
                            });
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }

        $(document).ready(function(){
            datatable_no_btn_class('#datatable');

            $('#hamburgerMenu').click(function(){
                setTimeout(function() { 
                    redraw_datatable_class('#datatable');
                }, 300);
            });
        });
    </script>
   
@endpush