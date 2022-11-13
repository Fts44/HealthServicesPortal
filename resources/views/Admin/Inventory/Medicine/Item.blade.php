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

                <h5 class="card-title">Items</h5>
                <div class="row mb-2 d-flex flex-row justify-content-end p-0">
                    <label class="text-end" style="max-width: 100px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Advanced Filter">
                        <button class="btn btn-sm btn-secondary" id="search"  data-bs-toggle="modal" data-bs-target="#modal_filter">
                            <i class="bi bi-funnel"></i>
                        </button>
                    </label>
                </div>
                
                <a id="add" href="#" class="btn btn-secondary btn-sm" style="float: right; margin-top: -5rem;" data-bs-toggle="modal" data-bs-target="#modal">
                    <i class="bi bi-plus-lg"></i>          
                </a>
                <table id="datatable" class="table table-bordered" style="width: 100%;">
                    <thead class="table-light">
                        <th scope="col">ID</th>
                        <th scope="col">Generic Name</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date Added</th>
                        <th scope="col">Expiration</th>
                        <th scope="col">Action</th>
                    </thead>
                    <tbody>
                    @foreach($items as $i)
                        @php $formatted_id = 'MDCN-'.str_pad($i->imi_id, 5, '0', STR_PAD_LEFT) @endphp
                    <tr>
                        <td>{{ $formatted_id }}</td>
                        <td>{{ $i->imgn_generic_name }}</td>
                        <td>{{ $i->imb_brand }}</td>
                        <td>
                            @php $quantity_avlbl = $i->imi_quantity-($i->dispose+$i->dispense) @endphp
                            Dispense: {{ ($i->dispense) ? $i->dispense : '0' }}<br>
                            Dispose: {{ ($i->dispose) ? $i->dispose : '0' }}<br>
                            Available: {{ $quantity_avlbl }}<br>
                            Total: {{ $i->imi_quantity }}
                        </td>
                        <td><span class="badge 
                                @if($i->imi_status=='1')
                                    bg-success
                                @else
                                    bg-danger
                                @endif
                                ">{{ ($i->imi_status) ? 'For-dispensing' : 'On-Hold' }}</span></td>
                        <td>{{ date_format(date_create($i->imi_date_added), 'M d, Y') }}</td>
                        <td>{{ date_format(date_create($i->imi_expiration), 'M d, Y') }}</td>
                        <td>
                            <a class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="View Transaction Records"
                                href="{{ route('AdminInventoryMedicineItemTransaction', ['id'=>$i->imi_id]) }}">
                                <i class="bi bi-journal-text"></i>
                            </a>
                            <button class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Dispose"
                                @if($quantity_avlbl!=0)
                                    onclick="dispose('{{ $formatted_id }}', '{{ $i->imgn_generic_name }}', '{{ $i->imb_brand }}', '{{ $i->imi_expiration }}', '{{ $quantity_avlbl }}', '{{ $i->imi_id }}')"
                                @else
                                    disabled
                                @endif
                                >
                                <i class="bi bi-trash"></i>
                            </button>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                                onclick="update('{{ $i->imi_id }}', '{{ $i->imgn_id }}', '{{ $i->imb_id }}', '{{ $i->imi_quantity }}', '{{ $i->imi_status }}', '{{ $i->imi_expiration }}', '{{ $i->imi_date_added }}')">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                @if($quantity_avlbl == $i->imi_quantity)
                                    onclick="delete_confirmation('{{ 'MDCN-'.str_pad($i->imi_id, 5, '0', STR_PAD_LEFT) }}', '{{ $i->imi_id }}')"
                                @else 
                                    disabled
                                @endif
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

    <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Add Medicine</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <label class="form-control p-0 border-0">
                            Date Added:
                            <input type="date" name="date_added" id="date_added" class="form-control" value="{{ old('date_added', date('Y-m-d')) }}">
                            <span class="text-danger medicine-error">
                                @error('date_added')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="form-control p-0 border-0 mt-2">
                            Generic Name:
                            <select name="generic_name" id="generic_name" class="form-select">
                                <option value="">--- choose ---</option>
                                @foreach($generic as $g)
                                    <option value="{{ $g->imgn_id }}" {{ ($g->imgn_id==old('generic_name')) ? 'selected' : '' }} {{ ($g->imgn_status) ? '' : 'hidden' }}>{{ $g->imgn_generic_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger medicine-error">
                                @error('generic_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="form-control p-0 border-0 mt-2">
                            Brand:
                            <select name="brand" id="brand" class="form-select">
                                <option value="">--- choose ---</option>
                                @foreach($brand as $b)
                                    <option value="{{ $b->imb_id }}" {{ ($b->imb_id==old('brand')) ? 'selected' : '' }} {{ ($b->imb_status) ? '' : 'hidden' }}>{{ $b->imb_brand }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger medicine-error">
                                @error('brand')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="form-control p-0 border-0 mt-2">
                            Quantity:
                            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}">
                            <span class="text-danger medicine-error">
                                @error('quantity')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="form-control p-0 border-0 mt-2">
                            Status:
                            <select name="status" id="status" class="form-select">
                                <option value="0" {{ (!old('status')) ? 'selected' : '' }}>On-hold</option>
                                <option value="1" {{ (old('status')) ? 'selected' : '' }}>For-dispensing</option>
                            </select>
                            <span class="text-danger medicine-error">
                                @error('status')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>

                        <label class="form-control p-0 border-0 mt-2">
                            Expiration:
                            <input type="date" name="expiration" id="expiration" class="form-control" value="{{ old('expiration') }}">
                            <span class="text-danger medicine-error">
                                @error('expiration')
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

    <div class="modal fade" id="modal_dispose" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title_dispose">Dispose Medicine</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="form_dispose">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <label class="form-control border-0 p-0">
                            ID:
                            <input type="text" name="dispose_id" id="dispose_id" class="form-control" value="{{ old('dispose_id') }}" readonly>
                        </label>
                        <label class="form-control border-0 p-0 mt-2">
                            Generic Name:
                            <input type="text" name="dispose_generic_name" id="dispose_generic_name" class="form-control" value="{{ old('dispose_generic_name') }}" readonly>
                        </label>
                        <label class="form-control border-0 p-0 mt-2">
                            Brand:
                            <input type="text" name="dispose_brand" id="dispose_brand" class="form-control" value="{{ old('dispose_brand') }}" readonly>
                        </label>
                        <label class="form-control border-0 p-0 mt-2">
                            Expiration:
                            <input type="date" name="dispose_expiration" id="dispose_expiration" class="form-control" value="{{ old('dispose_expiration') }}" readonly>
                        </label>
                        <label class="form-control border-0 p-0 mt-2">
                            Available:
                            <input type="number" name="dispose_available" id="dispose_available" class="form-control" value="{{ old('dispose_available') }}" readonly>
                        </label>
                        <label class="form-control border-0 p-0 mt-2">
                            Quantity to Dispose:
                            <input type="number" name="dispose_quantity" id="dispose_quantity" class="form-control" value="{{ old('dispose_quantity') }}">
                            <span class="text-danger dispose-error">
                                @error('dispose_quantity')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>    
        </div>
    </div>

    <div class="modal fade" id="modal_filter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_filter_dispose">Advanced Filter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('AdminInventoryMedicineItem') }}" method="GET" id="form_filter">
                    <div class="modal-body">
                        @csrf
                        <label class="form-control border-0 p-0">
                            Generic Name:
                            <select name="gn" id="gn" class="form-select">
                                <option value="">All</option>
                                @foreach($generic as $g)
                                    <option value="{{ $g->imgn_id }}" {{ (old('gn', $gn)==('="'.$g->imgn_id.'"')) ? 'selected' : ''  }}>{{ $g->imgn_generic_name }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label class="form-control border-0 p-0 mt-2">
                            Brand:
                            <select name="br" id="br" class="form-select">
                                <option value="">All</option>
                                @foreach($brand as $b)
                                    <option value="{{ $b->imb_id }}" {{ (old('br', $br)==('="'.$b->imb_id.'"')) ? 'selected' : ''  }}>{{ $b->imb_brand }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label class="form-control border-0 p-0 mt-2">
                            Date Added:
                            <div class="row">
                                <label class="col-lg-6">
                                    <select name="dam" id="dam" class="form-select">
                                        <option value="">All</option>
                                        @for($i=1; $i<=12; $i++){
                                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT); }}" {{ (old('dam', $dam)==('="'.str_pad($i, 2, '0', STR_PAD_LEFT).'"')) ? 'selected' : ''  }}>{{ date('F', mktime(0, 0, 0, $i, 10)) }}</option>
                                        @endfor
                                    </select>
                                </label>
                                <label class="col-lg-6">
                                    <select name="day" id="day" class="form-select">
                                        <option value="">All</option>
                                        @for($i=date('Y'); $i>=2020; $i--)
                                            <option value="{{$i}}" {{ (old('day', $day)==('="'.$i.'"')) ? 'selected' : ''  }}>{{$i}}</option>
                                        @endfor
                                    </select>
                                </label>
                            </div>
                        </label>
                        <label class="form-control border-0 p-0 mt-2">
                            Expiration:
                            <div class="row">
                                <label class="col-lg-6">
                                    <select name="em" id="em" class="form-select">
                                        <option value="">All</option>
                                        @for($i=1; $i<=12; $i++){
                                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT); }}" {{ (old('em', $em)==('="'.str_pad($i, 2, '0', STR_PAD_LEFT).'"')) ? 'selected' : ''  }}>{{ date('F', mktime(0, 0, 0, $i, 10)) }}</option>
                                        @endfor
                                    </select>
                                </label>
                                <label class="col-lg-6">
                                    <select name="ey" id="ey" class="form-select">
                                        <option value="" {{ (old('ey', $ey)=='all') ? 'selected' : '' }}>All</option>
                                        @for($i=date('Y'); $i>=2020; $i--)
                                            <option value="{{$i}}" {{ (old('ey', $ey)==('="'.$i.'"')) ? 'selected' : ''  }}>{{$i}}</option>
                                        @endfor
                                    </select>
                                </label>
                            </div>
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Search</button>
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
        function dispose(id, gn, brand, expr, avlbl, imi_id){
            var url = "{{ route('AdminInventoryMedicineItemDisposeInsert', ['id'=>'id']) }}";
            url = url.replace('id', imi_id);
            $('#dispose_id').val(id);
            $('#dispose_generic_name').val(gn);
            $('#dispose_brand').val(brand);
            $('#dispose_expiration').val(expr);
            $('#dispose_available').val(avlbl);
            $('#dipose_quantity').val(avlbl);
            $('#form_dispose').attr('action', url);
            $('#modal_dispose').modal('show'); 
        }
        function clear(){
            $('#form').attr('action', "{{ route('AdminInventoryMedicineItemInsert') }}");
            $('#expiration, #generic_name, #brand', '#quantity').val('');
            $('#date_added').val("{{ date('Y-m-d') }}");
            $('.medicine-error').html('');
        }

        function update(id, gn, brand, qty, status, expr, da){
            var url = "{{ route('AdminInventoryMedicineItemUpdate', ['id'=>'id']) }}";
            url = url.replace('id', id);
            $('#form').attr('action', url);
            $('#date_added').val(da);
            $('#generic_name').val(gn);
            $('#brand').val(brand);
            $('#quantity').val(qty);
            $('#status').val(status);
            $('#expiration').val(expr);
            $('.medicine-error').html('');
            $('#modal_title').html('Update Medicine');
            $('#submit_button').html('Update');
            $('#modal').modal('show'); 
        }

        function delete_confirmation(item, id){
            event.preventDefault();
            var href = "{{ route('AdminInventoryMedicineItemDelete', ['id'=>'id']) }}";
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
            @if($errors->any())
                @if(session('status'))
                    @php 
                        $status = (object)session('status');                      
                    @endphp
                    @if($status->action=='Add')

                        @if($status->form=='Medicine')
                            $('#form').attr('action', "{{ route('AdminInventoryMedicineItemInsert') }}");
                            $('#quantity').attr('readonly', false);
                            $('#modal_title').html('Add Medicine');
                            $('#submit_button').html('Add');
                            $('#modal').modal('show'); 
                        @elseif($status->form=='Dispose')
                            $('#form_dispose').attr('action', "{{ route('AdminInventoryMedicineItemDisposeInsert', ['id' => $status->imi_id]) }}");
                            $('#modal_dispose').modal('show'); 
                        @endif

                    @elseif($status->action=='Update')

                        @if($status->form=='Medicine')
                            $('#form').attr('action', "{{ route('AdminInventoryMedicineItemUpdate', ['id' => $status->imi_id]) }}");
                            $('#modal_title').html('Update Medicine');
                            $('#submit_button').html('Update');    
                            $('#modal').modal('show'); 
                        @endif

                    @endif
                @endif            
                    
            @endif

            $('#add').click(function(){
                clear();
                $('#modal_title').html('Add Medicine');
                $('#submit_button').html('Add');
                $('#modal').modal('show'); 
            });
        });
    </script>
@endpush