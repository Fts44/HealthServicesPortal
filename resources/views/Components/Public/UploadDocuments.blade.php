

<!-- Modal -->
<div class="modal fade" id="modal_upload_documents" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_upload_documents_label">Upload Document</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="modal_upload_documents_form" action="">
                <div class="modal-body">
                    @csrf 
                    @method('PUT')
                    <label for="" class="form-control border-0 p-0">Document Type
                        <select class="form-select" name="document_type" id="document_type">
                            <option value="">--- choose document type ---</option>
                            @foreach($document_type as $type)
                                <option value="{{ $type->dt_id }}" {{ ($type->dt_id==old('document_type')) ? 'selected' : '' }}>{{ $type->dt_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger mud-error" id="document_type_error"></span>
                    </label>
                    <label for="" class="form-control border-0 p-0 mt-2">Document File
                        <input class="form-control" type="file" name="file" id="mud_file">
                        <span class="text-danger mud-error" id="file_error"></span>
                    </label>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="mud_submit_button">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function upload(){
        $('#modal_upload_documents').modal('show');
    }

    $('#mud_submit_button').click(function(){      
        $('.error-medicine_dispense').html('');
        var formData = new FormData($('#modal_upload_documents_form')[0]);
        var url = "{{ route('AdminPDUploads', ['pd_id'=>'pd_id']) }}";
        url = url.replace('pd_id', '{{ $patient_details->acc_id }}');
        $.ajax({
            type: "POST",
            url: url,
            contentType: false,
            processData: false,
            data: formData,
            enctype: 'multipart/form-data',
            success: function(response){
                response = JSON.parse(response);
                console.log(response);
                swal(response.title, response.message, response.icon);
                if(response.status == 400){
                    $.each(response.errors, function(key, err_values){
                        $('#'+key+'_error').html(err_values);
                    });
                }
                else{
                    swal(response.title, response.message, response.icon)
                    .then(function(){
                        location.reload();
                    });           
                }
            },
            error: function(response){
                // response = JSON.parse(response);
                console.log(response);
            }
        })
    });
</script>