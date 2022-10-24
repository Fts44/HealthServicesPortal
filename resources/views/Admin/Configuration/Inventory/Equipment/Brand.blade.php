@extends('Layouts.AdminMain')

@push('title')
    <title>Configuration Equipment</title>
@endpush

@section('content')
<main id="main" class="main">
    @include('Components.Admin.Configuration.Inventory.Equipment.PageTitle')
   
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

                <h5 class="card-title">Equipment Brand</h5>
                <a href="#" id="add" class="btn btn-secondary btn-sm" style="float: right; margin-top: -2.5rem;">
                    <i class="bi bi-plus-lg"></i>          
                </a>
                <table id="datatable" class="table table-bordered" style="width: 100%;">
                    <thead class="table-light">
                        <th scope="col">ID</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </thead>
                    <tbody>
                    @foreach($ie_brands as $item)
                        <tr>
                            <td>{{ $item->ieb_id }}</td>
                            <td>{{ $item->ieb_brand }}</td>
                            <td>
                                <span class="badge {{ ($item->ieb_status) ? 'bg-success' : 'bg-secondary' }}">{{ ($item->ieb_status) ? 'Enabled' : 'Disabled' }}</span>
                            </td>
                            @if($item->ieb_id=='1' && $item->ieb_brand=='none')
                                <td>
                                    <button class="btn btn-primary btn-sm" disabled><i class="bi bi-pencil"></i></button>
                                    <button class="btn btn-danger btn-sm" disabled><i class="bi bi-eraser"></i></button>
                                </td>
                            @else
                                <td>
                                    <a class="btn btn-primary btn-sm" onclick="update('{{ $item->ieb_id }}','{{ $item->ieb_brand }}','{{ $item->ieb_status }}')"><i class="bi bi-pencil"></i></a>
                                    <button class="btn btn-danger btn-sm" {{ ($item->ieid_id!=null) ? 'disabled' : '' }} href="" onclick="return delete_confirmation('{{ $item->ieb_brand }}','{{ route('AdminConfigurationInventoryEquipmentBrandDelete', ['id' => ($item->ieid_id!=null) ? 'id' : $item->ieb_id ]) }}');"><i class="bi bi-eraser"></i></button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>

    </section>

</main>
    <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Add Equipment Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-body mb-4">
                        <label class="form-control border-0 p-0">
                            Brand:
                            <input class="form-control" type="text" name="brand" id="brand" value="{{ old('brand') }}">
                            <span class="text-danger" id="error_brand">
                                @error('brand')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="form-control border-0 p-0 mt-2">
                            Status:
                            <select class="form-select" name="status" id="status">
                                <option value="1" {{ (old('status')=='1') ? 'selected' : '' }}>Enable</option>
                                <option value="0" {{ (old('status')=='0') ? 'selected' : '' }}>Disable</option>
                            </select>
                            <span class="text-danger" id="error_status">
                                @error('status')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submit_button">Add</button>
                    </div>
                </form>
            </div>    
        </div>
    </div>

    <form id="delete_form" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('script')

    <!-- datatable js -->
    <script src="{{ asset('js/datatable.js') }}"></script>

    <script>
        function clear(){
            $("#status").prop("selectedIndex", 0);
            $('#brand').val('');
            $('#error_brand, #error_status').html('');
        }
        function update(item_id, item_name, item_status){
            clear();
            var url = "{{ route('AdminConfigurationInventoryEquipmentBrandUpdate', ['id'=>'id']) }}";
            $('#form').attr('action', url.replace('id', item_id));
            $('#brand').val(item_name);
            $('#status').val(item_status);
            $('#modal_title').html('Update Equipment Brand');
            $('#submit_button').html('Update');
            $('#modal').modal('show'); 
        }
        function delete_confirmation(brand, href){
            event.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Your about to delete "+brand+"!",
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
            @if($errors->any())
                @if(session('status'))
                    @php 
                        $status = (object)session('status');                      
                    @endphp
                    @if($status->action=='Add')
                        $('#form').attr('action', "{{ route('AdminConfigurationInventoryEquipmentBrandInsert') }}");
                        $('#modal_title').html('Add Equipment Brand');
                        $('#submit_button').html('Add');
                    @elseif($status->action=='Update')
                        $('#form').attr('action', "{{ route('AdminConfigurationInventoryEquipmentBrandUpdate', ['id' => $status->ien_id]) }}");
                        $('#modal_title').html('Update Equipment Brand');
                        $('#submit_button').html('Update');
                    @endif
                @endif                
                $('#modal').modal('show'); 
            @endif 
            $('#add').click(function(){
                clear();
                $('#form').attr('action', "{{ route('AdminConfigurationInventoryEquipmentBrandInsert') }}");
                $('#modal_title').html('Add Equipment Brand');
                $('#submit_button').html('Add');
                $('#modal').modal('show'); 
            });
        });
    </script>
@endpush