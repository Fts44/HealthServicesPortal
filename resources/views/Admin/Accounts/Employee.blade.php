@extends('Layouts.AdminMain')

@push('title')
    <title>User Patient</title>
@endpush

@section('content')
<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Accounts Patients</h1>
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
                        <th scope="col">EmployeeID</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Position</th>
                        <th scope="col">Action</th>
                    </thead>
                    <tbody>
                    @foreach($employee as $e)
                    <tr>
                        <td>{{ $e->sr_code }}</td>
                        <td>{{ $e->ttl_title.'. '.$e->firstname.' '.(($e->middlename) ? $e->middlename[0].'. ' : '').$e->lastname }}</td>
                        <td>{{ $e->contact }}</td>
                        <td>{{ ucwords($e->position) }}</td>
                        <td>
                            <a href="{{ route('AdminAccountsEmployeesView', ['id'=>$e->acc_id]) }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-eye"></i> View
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
@endsection

@push('script')

    <!-- datatable js -->
    <script src="{{ asset('js/datatable.js') }}"></script>

    <script>
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