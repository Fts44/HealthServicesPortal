@extends('Layouts.AdminMain')

@push('title')
    <title>Configuration Medicine</title>
@endpush

@section('content')
<main id="main" class="main">
    @include('Components.Admin.Configuration.Inventory.MedicinePageTitle')
  
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

                <h5 class="card-title">Generic Name</h5>
                <a href="#" id="add" class="btn btn-secondary btn-sm" style="float: right; margin-top: -2.5rem;">
                    <i class="bi bi-plus-lg"></i>          
                </a>
                <table id="datatable" class="table table-bordered" style="width: 100%;">
                    <thead class="table-light">
                        <th scope="col">ID</th>
                        <th scope="col">Generic Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </thead>
                    <tbody>
                    @foreach($generic_names as $gn)
                    <tr>
                        <td>{{ $gn->imgn_id }}</td>
                        <td>{{ $gn->imgn_generic_name }}</td>
                        <td>
                            @if($gn->imgn_status)
                                <span class="badge bg-success">Enabled</span>
                            @else
                                <span class="badge bg-secondary">Disabled</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary" onclick="update('{{ $gn->imgn_id }}','{{ $gn->imgn_generic_name }}','{{ $gn->imgn_status }}')"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-danger" 
                            @if(!$gn->imi_id)
                                onclick="delete_confirmation('{{ $gn->imgn_id }}','{{ $gn->imgn_generic_name }}')"
                            @else
                                disabled
                            @endif
                            ><i class="bi bi-eraser"></i></button>
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
                    <h5 class="modal-title" id="modal_title">Add Generic Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="form">
                    @csrf
                    @method('PUT')

                    <div class="modal-body mb-4">
                        <label class="form-control border-0 p-0">
                            Generic Name:
                            <input class="form-control" type="text" name="generic_name" id="generic_name" value="{{ old('generic_name') }}">
                            <span class="text-danger generic-error" id="generic_name_error">
                                @error('generic_name')
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
                            <span class="text-danger generic-error" id="error_status">
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
            $('#generic_name').val('');
            $('.generic-error').html('');
        }

        function update(gn_id, gn_generic_name, gn_status){
            clear();
            var url = "{{ route('AdminConfigurationInventoryMedicineGenericNameUpdate', ['id'=>'id']) }}";
            $('#form').attr('action', url.replace('id', gn_id));
            $('#generic_name').val(gn_generic_name);
            $('#status').val(gn_status);
            $('#modal_title').html('Update Generic Name');
            $('#submit_button').html('Update');
            $('#modal').modal('show'); 
        }

        function delete_confirmation(gn_id, gn_generic_name){
            event.preventDefault();
            var url = "{{ route('AdminConfigurationInventoryMedicineGenericNameDelete', ['id'=>'id']) }}";
            url = url.replace('id', gn_id)
            swal({
                title: "Are you sure?",
                text: "Your about to delete "+gn_generic_name+"!",
                icon: "warning",
                buttons: ["Cancel", "Yes"],
                dangerMode: true,
            }).then(function(value){
                if(value){
                    $('#delete_form').attr('action', url);
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
                        $('#form').attr('action', "{{ route('AdminConfigurationInventoryMedicineGenericNameInsert') }}");
                        $('#modal_title').html('Add Generic Name');
                        $('#submit_button').html('Add');
                    @elseif($status->action=='Update')
                        $('#form').attr('action', "{{ route('AdminConfigurationInventoryMedicineGenericNameUpdate', ['id' => $status->imgn_id]) }}");
                        $('#modal_title').html('Update Generic Name');
                        $('#submit_button').html('Update');
                    @endif
                @endif                
                $('#modal').modal('show'); 
            @endif 
            $('#add').click(function(){
                clear();
                $('#form').attr('action', "{{ route('AdminConfigurationInventoryMedicineGenericNameInsert') }}");
                $('#modal_title').html('Add Generic Name');
                $('#submit_button').html('Add');
                $('#modal').modal('show'); 
            });
        });
    </script>
@endpush