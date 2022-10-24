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

                <h5 class="card-title">Equipment Item Details</h5>
                <a href="#" id="add" class="btn btn-secondary btn-sm" style="float: right; margin-top: -2.5rem;">
                    <i class="bi bi-plus-lg"></i>          
                </a>
                <table id="datatable" class="table table-bordered" style="width: 100%;">
                    <thead class="table-light">
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Type</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Category</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </thead>
                    <tbody>
                    @foreach($ieid_details as $item)
                        <tr>
                            <td>{{ $item->ieid_id }}</td>
                            <td>{{ $item->ien_name }}</td>
                            <td>{{ ucwords($item->ieid_unit) }}</td>
                            <td>{{ ucwords($item->iet_type) }}</td>
                            <td>{{ ucwords($item->ieb_brand) }}</td>
                            <td>{{ ucwords($item->ieid_category) }}</td>
                            <td>
                                <span class="badge {{ ($item->ieid_status) ? 'bg-success' : 'bg-secondary' }}">{{ ($item->ieid_status) ? 'Enabled' : 'Disabled' }}</span>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm" onclick="update('{{ $item->ieid_id }}','{{ $item->ien_id }}','{{ $item->ieid_unit }}','{{ $item->iet_id }}','{{ $item->ieb_id }}', '{{ $item->ieid_category }}', '{{ $item->ieid_status }}')"><i class="bi bi-pencil"></i></a>
                                <button class="btn btn-danger btn-sm" {{ ($item->iei_id!=null) ? 'disabled' : '' }} onclick="return delete_confirmation('{{ $item->ien_name }}','{{ route('AdminConfigurationInventoryEquipmentItemDelete', ['id' => ($item->iei_id!=null) ? 'id' : $item->ieid_id]) }}');"><i class="bi bi-eraser"></i></button>
                            </td>
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
                            Name:
                            <select class="form-select" name="name" id="name">
                                <option value="">--- choose ---</option>
                                @foreach($ien_names as $name)
                                    <option value="{{ $name->ien_id }}" {{ ($name->ien_status==0) ? 'hidden' : '' }} {{ (old('name')==$name->ien_id) ? 'selected' : '' }}>{{ $name->ien_name }}</option>
                                @endforeach 
                            </select>
                            <span class="text-danger error">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="form-control border-0 p-0 mt-2">
                            Unit:
                            <select class="form-select" name="unit" id="unit">
                                <option value="">--- choose ---</option>
                                <option value="pair" {{ (old('unit')=='pair') ? 'selected' : '' }}>Pair</option>
                                <option value="pcs" {{ (old('unit')=='pcs') ? 'selected' : '' }}>Pcs</option>
                                <option value="unit" {{ (old('unit')=='unit') ? 'selected' : '' }}>Unit</option>
                            </select>
                            <span class="text-danger error">
                                @error('unit')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="form-control border-0 p-0 mt-2">
                            Type:
                            <select class="form-select" name="type" id="type">
                                <option value="">--- choose ---</option>
                                <option value="1" {{ (old('type')=='1') ? 'selected' : '' }}>none</option>
                                @foreach($iet_types as $type)
                                    @if($type->iet_type != 'none')
                                        <option value="{{ $type->iet_id }}" {{ ($type->iet_status==0) ? 'hidden' : '' }} {{ (old('type')==$type->iet_id) ? 'selected' : '' }}>{{ $type->iet_type }}</option>
                                    @endif        
                                @endforeach 
                            </select>
                            <span class="text-danger error">
                                @error('type')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="form-control border-0 p-0 mt-2">
                            Brand:
                            <select class="form-select" name="brand" id="brand">
                                <option value="">--- choose ---</option>
                                <option value="1" {{ (old('brand')=='1') ? 'selected' : '' }}>none</option>
                                @foreach($ieb_brands as $brand)
                                    @if($brand->ieb_brand != 'none')
                                        <option value="{{ $brand->ieb_id }}" {{($brand->ieb_status==0) ? 'hidden' : '' }} {{ (old('brand')==$brand->ieb_id) ? 'selected' : '' }}>{{ $brand->ieb_brand }}</option>
                                    @endif        
                                @endforeach 
                            </select>
                            <span class="text-danger error">
                                @error('brand')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="form-control border-0 p-0 mt-2">
                            Category:
                            <select class="form-select" name="category" id="category">
                                <option value="">--- choose ---</option>
                                <option value="none" {{ (old('category')=='none') ? 'selected' : '' }}>none</option>
                                <option value="dental set" {{ (old('category')=='dental set') ? 'selected' : '' }}>Dental Set</option>
                                <option value="minor set" {{ (old('category')=='minor set') ? 'selected' : '' }}>Minor Set</option>
                            </select>
                            <span class="text-danger error">
                                @error('category')
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
                            <span class="text-danger error">
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
            $('#name').val('');
            $('#unit').val('');
            $('#type').val('');
            $('#brand').val('');
            $('#category').val('');
            $('#status').val('1');
            $('.error').html('');
        }
        function update(item_id, item_name, item_unit, item_type, item_brand, item_category, item_status){
            clear();
            var url = "{{ route('AdminConfigurationInventoryEquipmentItemUpdate', ['id'=>'id']) }}";
            $('#form').attr('action', url.replace('id', item_id));
            $('#name').val(item_name);
            $('#unit').val(item_unit);
            $('#type').val(item_type);
            $('#brand').val(item_brand);
            $('#category').val(item_category);
            $('#status').val(item_status);
            $('#modal_title').html('Update Equipment Item Details');
            $('#submit_button').html('Update');
            $('#modal').modal('show'); 
        }
        function delete_confirmation(item, href){
            event.preventDefault();
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
            @if($errors->any())
                @if(session('status'))
                    @php 
                        $status = (object)session('status');                      
                    @endphp
                    @if($status->action=='Add')
                        $('#form').attr('action', "{{ route('AdminConfigurationInventoryEquipmentItemInsert') }}");
                        $('#modal_title').html('Add Equipment Item Details');
                        $('#submit_button').html('Add');
                    @elseif($status->action=='Update')
                        $('#form').attr('action', "{{ route('AdminConfigurationInventoryEquipmentItemUpdate', ['id' => $status->ieid_id]) }}");
                        $('#modal_title').html('Update Equipment Item Details');
                        $('#submit_button').html('Update');
                    @endif
                @endif                
                $('#modal').modal('show'); 
            @endif 
            $('#add').click(function(){
                clear();
                $('#form').attr('action', "{{ route('AdminConfigurationInventoryEquipmentItemInsert') }}");
                $('#modal_title').html('Add Equipment Items');
                $('#submit_button').html('Add');
                $('#modal').modal('show'); 
            });
        });
    </script>
@endpush