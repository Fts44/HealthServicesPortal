@extends('Layouts.AdminMain')

@push('title')
    <title>Inventory Medicine</title>
@endpush

@section('content')
<main id="main" class="main">
    @include('Components.Admin.Inventory.MedicinePageTitle')

    @if(session()->has('status'))
        @php $status = (object)session('status') @endphp
        <div class="alert {{ ($status->status==200) ? 'alert-success' : 'alert-danger' }} alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ $status->message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <section class="section mt-2">

        <div class="card" id="card-table">

            <div class="card-body px-4">
                <h5 class="card-title">{{ $id->imgn_generic_name.(($id->imb_brand!='none') ? " (".$id->imb_brand.") " : "").' #MDCN-'.str_pad($id->imi_id, 5, '0', STR_PAD_LEFT) }}</h5>
                <table id="datatable" class="table table-bordered" style="width: 100%;">
                    <thead class="table-light">
                        <th scope="col">Transaction ID</th>
                        <th scope="col">Patient</th>
                        <th scope="col">Type</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </thead>
                    <tbody>
                    @foreach($transactions as $t)
                    <tr>
                        @php $formatted_id = 'MDCN-TRNSC-'.str_pad($t->imt_id, 5, '0', STR_PAD_LEFT) @endphp
                        <td>{{ $formatted_id }}</td>
                        <td>{{ ($t->acc_id) ? '' : 'N/A' }}</td>
                        <td>{{ $t->imt_type }}</td>
                        <td>{{ $t->imt_quantity }}</td>
                        <td>{{ date_format(date_create($t->imt_date),"F d, Y H:i a") }}</td>
                        <td>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                            onclick="delete_confirmation('{{ $formatted_id }}', '{{ $t->imt_id }}')"
                            >
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
@endsection

@push('script')

    <!-- datatable js -->
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script>
        function delete_confirmation(item, id){
            event.preventDefault();
            var href = "{{ route('AdminInventoryMedicineItemTransactionDelete', ['id'=>'id']) }}";
            href = href.replace('id', id);
            console.log(href);
            swal({
                title: "Are you sure?",
                text: "Your about to delete "+item+"!",
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
            $('.alert').delay(5000).fadeOut('slow');
        });
    </script>
@endpush