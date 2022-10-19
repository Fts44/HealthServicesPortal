@extends('Layouts.PatientMain')

@push('title')
    <title>Patient Document Uploads</title>
@endpush

@section('content')
<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Document Uploads</h1>
        <nav>
            <ol class="breadcrumb" style="--bs-breadcrumb-divider: '|';">
            </ol>
        </nav>
    </div>

    <section class="section">

        <div class="card" id="card-table">

            <div class="card-body px-4">

                <h5 class="card-title">Uploaded Document</h5>
                <a href="#" class="btn btn-secondary btn-sm" style="float: right; margin-top: -2.5rem;" data-bs-toggle="modal" data-bs-target="#modal">
                    <i class="bi bi-plus-lg"></i>          
                </a>
                <table id="table_uploads" class="table table-bordered" style="width: 100%;">
                    <thead class="table-light">
                        <th scope="col">ID</th>
                        <th scope="col">Document Type</th>
                        <th scope="col">Filename</th>
                        <th scope="col">Date Upload</th>
                        <th scope="col">Action</th>
                    </thead>
                    <tbody>
                        @foreach($uploads as $doc)
                            <tr>
                                <td>{{ $doc->pd_id }}</td>
                                <td>{{ $doc->dt_name }}</td>
                                <td>{{ $doc->pd_filename }}</td>
                                <td>{{ date_format(date_create($doc->pd_date),'F d, y g:h a') }}</td>
                                <td>
                                    <a href="{{ route('ViewDocument', ['pd_id' => $doc->pd_id ]) }}" target="_blank" class="btn btn-primary btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm">
                                        <i class="bi bi-eraser"></i>
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
    <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Upload New Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('PatientDocumnetsUploadsInsert') }}" method="POST" id="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="modal-body mb-4">
                        <label for="" class="col-form-label col-lg-12">Document Type
                            <select class="form-select form-select" name="document_type" id="">
                                <option value="">--- choose document type ---</option>
                                @foreach($document_type as $type)
                                    <option value="{{ $type->dt_id }}" {{ ($type->dt_id==old('document_type')) ? 'selected' : '' }}>{{ $type->dt_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="file_error">
                                @error('document_type')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                       
                        <label for="" class="col-form-label col-lg-12 mt-2">Document File
                            <input class="form-control" type="file" name="file" id="file">
                            <span class="text-danger" id="file_error">
                                @error('file')
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
@endsection

@push('script')

    <!-- datatable js -->
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script>
        @if(session('status'))  
            @php 
                $status = json_decode(session('status'));                      
            @endphp
            swal('{{$status->title}}','{{$status->message}}','{{$status->icon}}');
        @endif
        
        $(document).ready(function(){
            datatable_no_btn_class('#table_uploads');
            $('#file').change(function(){
                let MAX_FILE_SIZE = 5 * 1024 * 1024;
                let fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    $('#file_error').html("File must no be greater than 5mb!");
                    $(this).val('');
                } else {
                    $('#file_error').html("");
                }
            });
            @if($errors->any())
                $('#modal').modal('show');
            @endif
            
        });
    </script>
@endpush