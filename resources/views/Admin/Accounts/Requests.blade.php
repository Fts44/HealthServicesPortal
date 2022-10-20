@extends('Layouts.AdminMain')

@push('title')
    <title>Admin Account Requests</title>
@endpush

@section('content')
<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Accounts Requests</h1>
        <nav>
            <ol class="breadcrumb" style="--bs-breadcrumb-divider: '|';">
            </ol>
        </nav>
    </div>
    <section class="section">

        <div class="card" id="card-table">

            <div class="card-body px-4">

                <h5 class="card-title">Accounts</h5>

                <table id="datatable" class="table table-bordered" style="width: 100%;">
                    <thead class="table-light">
                        <th scope="col">Email</th>
                        <th scope="col">Gsuite</th>
                        <th scope="col">Classification</th>
                        <th scope="col">Position</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Verification Status</th>
                        <th scope="col">Action</th>
                    </thead>
                    <tbody>
                    @foreach($accounts as $acc)
                    <tr>
                        <td>
                            @if($acc->email)    
                                {{ $acc->email }}
                            @else
                                {{ 'None' }}
                            @endif
                        </td>
                        <td>
                            @if($acc->gsuite_email)    
                                {{ $acc->gsuite_email }}
                            @else
                                {{ 'None' }}
                            @endif
                        </td>
                        <td>
                            @if($acc->classification=='infirmary personnel')
                                {{ 'Employee' }}
                            @else
                                {{ 'Patient' }}
                            @endif
                        </td>
                        <td>
                            @if($acc->classification=='infirmary personnel')
                                {{ ucwords($acc->position) }}
                            @else
                                {{ ucwords($acc->classification) }}
                            @endif
                        </td>
                        <td>{{ date_format(date_create($acc->created_at),'F d, Y h:i a') }}</td>
                        <td>
                            <span class="badge bg-secondary">Not Verified</span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary" 
                                data-bs-toggle="tooltip" 
                                data-bs-placement="top" 
                                data-bs-title="Accept"
                                onclick="accept_acc('{{ ($acc->gsuite_email) ? $acc->gsuite_email : $acc->email }}', '{{ route('AdminAccountsRequestsVerify', ['id' => $acc->acc_id]) }}')">
                                    <i class="bi bi-check-circle"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" 
                                data-bs-toggle="tooltip" 
                                data-bs-placement="top" 
                                data-bs-title="Delete"
                                onclick="delete_acc('{{ ($acc->gsuite_email) ? $acc->gsuite_email : $acc->email }}', '{{ route('AdminAccountsRequestsDelete', ['id' => $acc->acc_id]) }}')">
                                    <i class="bi bi-eraser"></i>
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
<form id="delete_form" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<form id="verify_form" action="" method="POST" style="display: none;">
    @csrf
    @method('PUT')
</form>
<!-- main -->

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

        function accept_acc(email, href){
            event.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Your about to verified the account with email of "+email+"!",
                icon: "warning",
                buttons: ["Cancel", "Yes"],
            }).then(function(value){
                if(value){
                    $('#verify_form').attr('action', href);
                    $('#verify_form').submit();
                }
            }); 
        }

        function delete_acc(email, href){
            event.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Your about to delete the account with email of "+email+"!",
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

            datatable_class('#datatable');
            $('#hamburgerMenu').click(function(){
                setTimeout(function() { 
                    redraw_datatable_class('#datatable');
                }, 300);
            });
        });
    </script>
   
@endpush