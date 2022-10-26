@extends('Layouts.AdminMain')

@push('title')
    <title>User Patient</title>
@endpush

@section('content')
<main id="main" class="main">
    <div class="pagetitle mb-2">
        <h1 class="mb-1">Accounts Patients</h1>
    </div>

    <section class="section">

        <div class="card" id="card-table">

            <div class="card-body px-4">

                <h5 class="card-title">Accounts</h5>

                <table id="datatable" class="table table-bordered" style="width: 100%;">
                    <thead class="table-light">
                        <th scope="col">SR-Code</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Classification</th>
                        <th scope="col">Grade</th>
                        <th scope="col">Department</th>
                        <th scope="col">Program</th>
                        <th scope="col">Action</th>
                    </thead>
                    <tbody>
                    @foreach($patients as $patient)
                        <tr>
                            <td>{{ ($patient->sr_code) ? $patient->sr_code : 'N/A'  }}</td>
                            <td>{{ ($patient->firstname && $patient->lastname) ? ($patient->firstname." ".($patient->middlename ? $patient->middlename[0].'.' : '')." ".$patient->lastname) : 'N/A'  }}</td>
                            <td>{{ ($patient->contact) ? $patient->contact : 'N/A' }}</td>
                            <td>{{ ucwords($patient->classification) }}</td>
                            <td>{{ ($patient->gl_name) ? ucwords($patient->gl_name) : 'N/A' }}</td>
                            <td>{{ ($patient->dept_code) ? $patient->dept_code : '' }}</td>
                            <td>{{ ($patient->prog_code) ? $patient->prog_code : 'N/A' }}</td>
                            <td>
                                <a href=" route('AdminViewPatientDetails',['id'=>$patient->acc_id]) }}" class="btn btn-sm btn-secondary">
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