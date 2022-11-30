<div class="modal fade" id="modal_prescription" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_prescription_label">Prescription</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="form_prescription">
                    <input type="hidden" name="pres_id" id="pres_id">
                    <label class="form-control p-0 border-0">
                        Date:
                        <input type="date" name="pres_date" id="pres_date" value="{{ date('Y-m-d') }}" class="form-control">
                        <span class="text-danger error-prescription" id="pres_date_error"></span>
                    </label>

                    <label class="form-control p-0 border-0 mt-2">
                        Name:
                        <input type="text" name="pres_name" id="pres_name" value="{{ $patient_details->firstname.' '.(($patient_details->middlename) ? $patient_details->middlename[0].'. ' : '' ).$patient_details->lastname }}" class="form-control" readonly>
                        <span class="text-danger error-prescription"></span>
                    </label>

                    @php 
                        $date = new DateTime($patient_details->birthdate);
                        $now = new DateTime();
                        $interval = $now->diff($date);
                    @endphp

                    <label class="form-control p-0 border-0 mt-2">
                        Age/Sex/Status:
                        <input type="text" name="pres_age_sex_status" id="pres_age_sex_status" value="{{ $interval->y.'/ '.ucwords($patient_details->gender).'/ '.ucwords($patient_details->civil_status) }}" class="form-control" readonly>
                        <span class="text-danger error-prescription"></span>
                    </label>

                    <label class="form-control p-0 border-0 mt-2">
                        Body:
                        <textarea name="pres_body" id="pres_body"></textarea>
                        <span class="text-danger error-prescription" id="pres_body_error"></span>
                    </label>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="pres_submit">Add</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.tiny.cloud/1/v5kgbmiwio8xrrxpr4j9g9mufnz4jlk4b021tm4az1j594p0/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
     
<script>

    const textArea = tinymce.init({ 
        selector: "textarea#pres_body",
        height: 200,
        plugins: [
            'lists'
        ],
        menubar:false,
        statusbar: false,
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist',
        spellchecker_dialog: true,
        skin: 'jam',
        icons: 'jam',
    });

    $('#pres_submit').click(function(){
        if($(this).html()=='Add'){
            var url = "{{ route('AdminPrescriptionInsert', ['id' => 'id']) }}";
            url = url.replace('id', '{{ $patient_details->acc_id }}');
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "pres_date": $('#pres_date').val(),
                    "pres_body": tinymce.get("pres_body").getContent()
                },
                success: function(response){
                    console.log(response);
                    response = JSON.parse(response);
                    
                    if(response.status == 400){
                        swal(response.title, response.message, response.icon);
                        $.each(response.errors, function(key, err_values){
                            $('#'+key+'_error').html(err_values);
                        });
                    }
                    else{
                        swal(
                            response.title,
                            response.message,
                            response.icon
                        ).then(function() {
                            location.reload();
                        });
                    }
                },
                error: function(response){
                    console.log(response);
                }
            })
        }
        else{
            var url = "{{ route('AdminPrescriptionUpdate', ['id' => 'id']) }}";
            url = url.replace('id', $('#pres_id').val());
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "pres_date": $('#pres_date').val(),
                    "pres_body": tinymce.get("pres_body").getContent()
                },
                success: function(response){
                    console.log(response);
                    response = JSON.parse(response);
                    
                    if(response.status == 400){
                        swal(response.title, response.message, response.icon);
                        $.each(response.errors, function(key, err_values){
                            $('#'+key+'_error').html(err_values);
                        });
                    }
                    else{
                        swal(
                            response.title,
                            response.message,
                            response.icon
                        ).then(function() {
                            location.reload();
                        });
                    }
                },
                error: function(response){
                    console.log(response);
                }
            })
        }
    });

    function set_pres_data(data, href){
        data = JSON.parse(data);
        // // console.log(data);    
        // console.log(data.form_date_created);
        $('#pres_date').val(data.form_date_created)
        tinymce.get('pres_body').setContent(data.pres_body);
        $('#pres_submit').html('Update');
        $('#modal_prescription').modal('show');
    }

    function detele_pres(id, href){
        event.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Your about to delete Prescription #"+id+"!",
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

    function retrieve_pres(id, href){
        $('#pres_id').val(id);
        console.log(id);
        console.log(href);
        var url = "{{ route('AdminPrescriptionRetrieve', ['id'=>'id']) }}";
        url = url.replace('id', id);
        $.ajax({
            type: "GET",
            url: href,
            success: function(response){
                // response = JSON.parse(response);
                // console.log(response);
                // response = response.data;
                // response = JSON.stringify(response);
                // $('#shr_save_btn').html('Update');
                set_pres_data(response, url);
            },
            error: function(response){
                // response = JSON.parse(response);
                console.log(response);
            }
        })
    }

    function insert_new_pres(){
        $('#pres_date').val("{{ date('Y-m-d') }}");
        tinymce.get('pres_body').setContent('');
        $('#pres_submit').html('Add');
    }
</script>