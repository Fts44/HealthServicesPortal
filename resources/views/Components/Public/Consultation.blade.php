<div class="modal fade" id="modal_consultation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_prescription_label">Consultation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="form_consultation">
                    @csrf 
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <label class="form-control border-0 p-0">
                                Name
                                <input type="text" class="form-control" readonly value="{{ $patient_details->ttl_title.'. '.$patient_details->firstname.' '.(($patient_details->middlename) ? $patient_details->middlename[0].'. ' : '').$patient_details->lastname }}">
                            </label>
                        </div>

                        <div class="col-lg-6">
                            <label class="form-control border-0 p-0">
                                Program/ Office
                                <input type="text" name="cnslt_program_office" id="cnslt_program_office" class="form-control" value="">
                                <span class="text-danger cnslt-error" id="cnslt_program_office-error"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <label class="form-control border-0 mt-2">
                            Address
                            <input type="text" class="form-control" readonly value="{{ $patient_details->home_brgy_name.', '.$patient_details->home_mun_name.', '.$patient_details->home_prov_name }}">
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mt-2">
                            <label class="form-control border-0 p-0">
                                Nurse' Notes
                                <textarea name="cnslt_nnotes" id="cnslt_nnotes" class="form-control">
                                    
                                </textarea>
                                <span class="text-danger cnslt-error" id="cnslt_nnotes-error"></span>
                            </label>
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label class="form-control border-0 p-0">
                                Doctors Notes
                                <textarea name="cnslt_dnotes" id="cnslt_dnotes" class="form-control">
                                    
                                </textarea>
                                <span class="text-danger cnslt-error" id="cnslt_dnotes-error"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-lg-12 text-center mt-3 fw-bold">Assesment</label>
                        <div class="col-lg-3 mt-1">
                            <label class="form-control border-0 p-0">
                                BP
                                <input type="text" name="cnslt_bp" id="cnslt_bp" class="form-control">
                                <span class="text-danger cnslt-error" id="cnslt_bp-error"></span>
                            </label>
                        </div>
                        <div class="col-lg-3 mt-1">
                            <label class="form-control border-0 p-0">
                                Temperature
                                <input type="text" name="cnslt_temp" id="cnslt_temp" class="form-control">
                                <span class="text-danger cnslt-error" id="cnslt_temp-error"></span>
                            </label>
                        </div>
                        <div class="col-lg-3 mt-1">
                            <label class="form-control border-0 p-0">
                                Heart Rate
                                <input type="text" name="cnslt_hr" id="cnslt_hr" class="form-control">
                                <span class="text-danger cnslt-error" id="cnslt_hr-error"></span>
                            </label>
                        </div>
                        <div class="col-lg-3 mt-1">
                            <label class="form-control border-0 p-0">
                                Oxygen Level
                                <input type="text" name="cnslt_oxygen_level" id="cnslt_oxygen_level" class="form-control">
                                <span class="text-danger cnslt-error" id="cnslt_oxygen_level-error"></span>
                            </label>
                        </div>
                        <div class="col-lg-6 mt-1">
                            <label class="form-control border-0 p-0">
                                Chief Complain
                                <select name="cnslt_chief_complain" id="cnslt_chief_complain" class="form-select">
                                    <option value="">--- choose ---</option>
                                    @foreach($coc as $c)
                                        <option value="{{ $c->ccc_id }}">{{ $c->ccc_category }}</option>
                                    @endforeach 
                                </select>
                                <span class="text-danger cnslt-error" id="cnslt_chief_complain-error"></span>
                            </label>
                        </div>
                        <div class="col-lg-6 mt-1">
                            <label class="form-control border-0 p-0">
                                Diagnosis 
                                <input type="text" name="cnslt_diagnosis" id="cnslt_diagnosis" class="form-control">
                                <span class="text-danger cnslt-error" id="cnslt_diagnosis-error"></span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="cnslt_save_btn">Add</button>
            </div>
        </div>
    </div>
</div>
    
<script>
    const notes = tinymce.init({ 
        selector: "#cnslt_dnotes,#cnslt_nnotes",
        height: 400,
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

    $('#cnslt_save_btn').click(function(){
        $('.cnslt-error').html('');
        var url = $('#form_consultation').attr('action');
        $.ajax({
            type: "PUT",
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
                "cnslt_chief_complain": $('#cnslt_chief_complain').val(),
                'cnslt_program_office': $('#cnslt_program_office').val(),
                'cnslt_nnotes': tinymce.get("cnslt_nnotes").getContent(),
                'cnslt_dnotes': tinymce.get("cnslt_dnotes").getContent(),
                'cnslt_bp': $('#cnslt_bp').val(),
                'cnslt_temp': $('#cnslt_temp').val(),
                'cnslt_hr': $('#cnslt_hr').val(),
                'cnslt_oxygen_level': $('#cnslt_oxygen_level').val(),
                'cnslt_diagnosis': $('#cnslt_diagnosis').val(),
            },
            success: function(response){
                if(response.status == 400){
                    swal(response.title, response.message, response.icon);
                    $.each(response.errors, function(key, err_values){
                        $('#'+key+'-error').html(err_values);
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
    });

    function set_cnslt(data, href){
        data = JSON.parse(data);
        $('#cnslt_chief_complain').val( data.cnslt_chief_complain);
        $('#cnslt_program_office').val( data.cnslt_program_office);
        tinymce.get('cnslt_nnotes').setContent((data.cnslt_nnotes) ? data.cnslt_nnotes : '');
        tinymce.get('cnslt_dnotes').setContent((data.cnslt_dnotes) ? data.cnslt_dnotes : '');
        console.log(data.cnslt_nnotes);
        $('#cnslt_bp').val( data.cnslt_bp);
        $('#cnslt_temp').val( data.cnslt_temp);
        $('#cnslt_hr').val( data.cnslt_hr);
        $('#cnslt_oxygen_level').val( data.cnslt_ol);
        $('#cnslt_diagnosis').val( data.cnslt_diagnosis);
        $("#form_consultation").attr("action", href);
        $('#modal_consultation').modal('show');
    }

    function insert_cnslt(){
        var data = {
            "cnslt_chief_complain": "",
            "cnslt_program_office": "{{ $patient_details->prog_name }}",
            "cnslt_nnotes": "",
            "cnslt_dnotes": "",
            "cnslt_bp": "",
            "cnslt_temp": "",
            "cnslt_hr": "",
            "cnslt_oxygen_level": "",
            "cnslt_diagnosis": "",
        };
        set_cnslt(JSON.stringify(data), "{{ route('AdminCnsltInsert', ['id'=>$patient_details->acc_id]) }}");
        console.log(data);
    }

    function delete_cnslt(id, href){
        event.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Your about to delete form #"+id+"!",
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

    function retrieve_cnslt(id, href){
        console.log(href);
        $.ajax({
            type: "GET",
            url: href,
            success: function(response){
                response = JSON.parse(response);
                console.log(response);
                response = response.data;
                response = JSON.stringify(response);
                $('#cnslt_save_btn').html('Update');
                set_cnslt(response, ("{{ route('AdminCnsltUpdate', ['id'=>'id']) }}").replace('id', id));
            },
            error: function(response){
                console.log(response);
            }
        })
    }
</script>