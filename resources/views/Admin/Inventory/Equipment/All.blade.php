@extends('Layouts.AdminMain')

@push('title')
    <title>Inventory Equipment</title>
@endpush

@section('content')
<main id="main" class="main">
    @include('Components.Admin.Inventory.EquipmentPageTitle')   

    <section class="section mt-2">

        <div class="card" id="card-table">

            <div class="card-body px-4">

                <h5 class="card-title">Equipment Summary</h5>
                <table id="datatable" class="table table-bordered" style="width: 100%;">
                    <thead class="table-light">
                        <th scope="col">Category</th>
                        <th scope="col">Description</th>
                        <th scope="col">Place</th>
                        <th scope="col">Total Quantity</th>
                        <th scope="col">Condition</th>
                    </thead>
                    <tbody>
                    @foreach($inventory as $item)
                        <tr>
                            <td>{{ ucwords($item->ieid_category) }}</td>
                            <td>
                                <span>NAME: {{ $item->ien_name }} </span><br>
                                <span>TYPE: {{ $item->iet_type }} </span>
                                    @if($item->iet_type=='none')
                                        &emsp;
                                    @endif
                                <br>
                                <span>BRAND: {{ $item->ieb_brand }}</span>
                            </td>
                            <td>{{ $item->iep_place }}</td>
                            <td>{{ $item->total_qty." ".$item->ieid_unit }}</td>
                            <td>
                                @if($item->working)
                                    <span class="badge bg-success">Working: {{ $item->working }}</span>
                                @endif

                                @if($item->working && $item->not_working)
                                    <br>
                                @endif 

                                @if($item->not_working)
                                    <span class="badge bg-danger">Not Working: {{ $item->not_working }}</span>
                                @endif
                            </td>
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
        });
    </script>
@endpush