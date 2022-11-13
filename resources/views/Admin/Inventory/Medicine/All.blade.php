@extends('Layouts.AdminMain')

@push('title')
    <title>Inventory Medicine</title>
@endpush

@section('content')
<main id="main" class="main">
    @include('Components.Admin.Inventory.MedicinePageTitle')
    <section class="section mt-2">

        <div class="card" id="card-table">

            <div class="card-body px-4">
                <h5 class="card-title">Available Medicines</h5>
                <table id="datatable" class="table table-bordered" style="width: 100%;">
                    <thead class="table-light">
                        <th scope="col">Generic Name</th>
                        <th scope="col">Available Quantity</th>
                        <th scope="col">For-dispensing</th>
                        <th scope="col">On-hold</th>
                    </thead>
                    <tbody>
                    @foreach($all as $a)
                    <tr>
                        <td>{{ $a->imgn_generic_name }}</td>
                        <td>{{ $a->total_quantity-($a->tq_1+$a->tq_0) }}</td>
                        <td>{{ $a->total_1-$a->tq_1 }}</td>
                        <td>{{ $a->total_0-$a->tq_0 }}</td>
                    </tr>     
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>

    </section>

</main>

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
            $('.alert').delay(5000).fadeOut('slow');
        });
    </script>
@endpush