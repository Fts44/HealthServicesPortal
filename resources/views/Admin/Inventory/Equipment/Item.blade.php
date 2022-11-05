@extends('Layouts.AdminMain')

@push('title')
    <title>Inventory Equipment</title>
@endpush

@section('content')
<main id="main" class="main">
    @include('Components.Admin.Inventory.EquipmentPageTitle')

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

                <h5 class="card-title">Items</h5>
                <a id="add" href="#" class="btn btn-secondary btn-sm" style="float: right; margin-top: -2.5rem;" data-bs-toggle="modal" data-bs-target="#modal">
                    <i class="bi bi-plus-lg"></i>          
                </a>
                <table id="datatable" class="table table-bordered" style="width: 100%;">
                    <thead class="table-light">
                        <th scope="col">ID</th>
                        <th scope="col">Description</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Place</th>
                        <th scope="col">Condition</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </thead>
                    <tbody>
                        @foreach($inventory_items as $item)
                        <tr>
                            <td>{{ 'ITM-'.str_pad($item->iei_id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>
                               NAME: {{ $item->ien_name }} <br>
                               TYPE: {{ $item->iet_type }} <br>
                               BRAND: {{ $item->ieb_brand }} <br>
                            </td>
                            <td>{{ $item->iei_qty.' '.$item->ieid_unit }}</td>
                            <td>{{ $item->iep_place }}</td>
                            <td>
                                <span class="badge 
                                @if($item->iei_condition=='1')
                                    bg-success
                                @else
                                    bg-danger
                                @endif
                                ">{{ ($item->iei_condition) ? 'Working' : 'Not working' }}</span>
                            </td>
                            <td>{{ $item->iei_date_added }}</td>
                            <td>
                                <button class="btn btn-secondary btn-sm"  onclick="copy('{{ $item->ieid_id }}', '{{ $item->iei_qty }}', '{{ $item->iei_condition }}', '{{ $item->iep_id }}')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Copy and Insert">
                                    <i class="bi bi-link-45deg"></i>
                                </button>
                                <button class="btn btn-primary btn-sm" onclick="update('{{ $item->iei_id }}','{{ $item->ieid_id }}', '{{ $item->iei_qty }}', '{{ $item->iei_date_added }}', '{{ $item->iei_condition }}', '{{ $item->iep_id }}')"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="return delete_confirmation('{{ $item->ien_name.(($item->iet_type!='none') ? ', '.$item->iet_type : ' ' ).(($item->ieb_brand!='none') ? ' ('.$item->ieb_brand.')' : '').$item->iei_id }}', '{{ route('AdminInventoryEquipmentItemDelete', ['id' => $item->iei_id]) }}');"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
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

    <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Add New Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <label class="form-control border-0 p-0">
                            Item:
                            <select name="item" id="item" class="form-select">
                                <option value="">--- choose ---</option>
                                @foreach($item_details as $item)
                                    <option value="{{ $item->ieid_id }}" {{($item->ieid_status) ? '' : 'hidden' }} {{ (old('item')==$item->ieid_id) ? 'selected' : '' }}>{{ $item->ien_name.(($item->iet_type!='none') ? ", ".$item->iet_type : ' ' ).(($item->ieb_brand!='none') ? " (".$item->ieb_brand.")" : '') }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error">
                                @error('item')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="form-control border-0 p-0 mt-2">
                            Quantity:
                            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity',1) }}">
                            <span class="text-danger error">
                                @error('quantity')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="form-control border-0 p-0 mt-2">
                            Date Added:
                            <input type="date" name="date_added" id="date_added" class="form-control" value="{{ old('date_added',date('Y-m-d')) }}">
                            <span class="text-danger error">
                                @error('date_added')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="form-control border-0 p-0 mt-2" id="date_condition">
                            Date of Update:
                            <input type="date" name="date_condition_update" id="date_condition_update" class="form-control" value="{{ old('date_condition_update',date('Y-m-d')) }}">
                            <span class="text-danger error">
                                @error('date_condition_update')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="form-control border-0 p-0 mt-2">
                            Condition:
                            <select name="condition" id="condition" class="form-select">
                                <option value="">--- choose ---</option>
                                <option value="1" {{ (old('condition')=='1') ? 'selected' : '' }}>Working</option>
                                <option value="0" {{ (old('condition')=='0') ? 'selected' : '' }}>Not working</option>
                            </select>
                            <span class="text-danger error">
                                @error('condition')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                        
                        <label class="form-control border-0 p-0 mt-2">
                            Place:
                            <select name="place" id="place" class="form-select">
                                <option value="">--- choose ---</option>
                                <option value="1" {{ (old('place')=='1') ? 'selected' : '' }}>none</option>
                                @foreach($places as $item)
                                    <option value="{{ $item->iep_id }}" {{ ($item->iep_status) ? '' : 'hidden' }} {{ (old('place')==$item->iep_id) ? 'selected' : '' }}>{{ $item->iep_place }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error">
                                @error('place')
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
            $('#form').attr('action', "{{ route('AdminInventoryEquipmentItemInsert') }}");
            $('#item, #place, #condition').val('');
            $('#quantity').attr('readonly', false);
            $('#date_added').val("{{ date('Y-m-d') }}");
            $('#date_condition').addClass('d-none');
            $('.error').html('');
        }
        function copy(item, qty, condition, place){
            clear();
            $('#item').val(item);
            $('#quantity').val(qty);
            $('#quantity').attr('readonly', false);
            $('#date_condition').addClass('d-none');
            $('#condition').val(condition);
            $('#place').val(place);
            $('#modal').modal('show'); 
        }
        function update(id, item, qty, date_added, condition, place){
            clear();
            var url = "{{ route('AdminInventoryEquipmentItemUpdate', ['id'=>'id']) }}";
            $('#form').attr('action', url.replace('id', id));
            $('#item').val(item);
            $('#quantity').val(qty);
            $('#quantity').attr('readonly', true);
            $('#date_added').val(date_added);
            $('#date_condition').removeClass('d-none');
            $('#condition').val(condition);
            $('#place').val(place);
            $('#modal_title').html('Update Item Details');
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
                        $('#form').attr('action', "{{ route('AdminInventoryEquipmentItemInsert') }}");
                        $('#quantity').attr('readonly', false);
                        $('#modal_title').html('Add Equipment Item');
                        $('#submit_button').html('Add');
                    @elseif($status->action=='Update')
                        $('#form').attr('action', "{{ route('AdminInventoryEquipmentItemUpdate', ['id' => $status->iei_id]) }}");
                        $('#quantity').attr('readonly', true);
                        $('#date_condition').removeClass('d-none');
                        $('#modal_title').html('Update Equipment Item');
                        $('#submit_button').html('Update');
                    @endif
                @endif                
                $('#modal').modal('show'); 
            @endif
            
            $('#add').click(function(){
                clear();
                console.log('test');
                $('#quantity').attr('readonly', false);
                $('#modal_title').html('Add Equipment Item');
                $('#submit_button').html('Add');
                $('#modal').modal('show'); 
            });
        });
    </script>
@endpush