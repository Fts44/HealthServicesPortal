@extends('Layouts.AdminMain')

@push('title')
    <title>Announcement</title>
@endpush

@section('content')
<main id="main" class="main">
    <div class="pagetitle mb-2">
        <h1 class="mb-1">Announcement</h1>
        <div class="page-nav">
        </div>
    </div>
    <section class="section mt-2">

        <div class="row d-flex justify-content-around">
            <div class="col-lg-2">
                <div class="card">
                    <div class="list-group">
                        <a style="cursor: default; background-color: #f7f5f5; border-color: #E8E9EB; color: black; font-weight: 900;" class="list-group-item list-group-item-action active text-center " aria-current="true">
                            Action
                        </a>
                        <button type="button" class="list-group-item nav" data-bs-toggle="modal" data-bs-target="#modal" onclick='post_clear()'>Add</button>
                        <button type="button" class="list-group-item nav" id="edit" value="0">Edit</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-10">
                @foreach($announcements as $a)
                    <div class="card col-lg-8" style="margin-left: 20px;">
                        <div class="card-body p-4">  
                            <h5><b>{{ $a->anm_title }}</b></h5>
                            <label>By: {{ $a->position." ".$a->firstname }}</label><br>
                            <label>Status: 
                                @if($a->anm_active_until>=date('Y-m-d'))
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Not Active</span>
                                @endif
                            </label>
                            <br><br>

                            <textarea class="a-body" id="{{ $a->anm_id }}" borderless>
                                {{ $a->anm_body }}
                            </textarea>

                            <label class="mt-4 action-button d-none">
                                <button class="btn btn-sm btn-primary" onclick='post_edit("{{ $a->anm_id }}","{{ $a->anm_active_until }}","{{ $a->anm_title }}")'><i class="bi bi-pencil"></i> Edit</button>
                                <button class="btn btn-sm btn-danger" onclick="post_delete('{{ $a->anm_id }}')"><i class="bi bi-eraser"></i> Delete</button>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>        
        
    </section>

    {{ $announcements->links() }}
</main>

    <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Add New Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <label class="form-control border-0 p-0 mb-2 d-none">
                        ID:
                        <input type="number" name="id" id="id" class="form-control">
                    </label>
                    <label class="form-control border-0 p-0 mb-2">
                        Active Until:
                        <input type="date" name="active_until" id="active_until" class="form-control">
                        <span class="text-danger error-message" id="active_until_error"></span>
                    </label>
                    <label class="form-control border-0 p-0 mb-2">
                        Title:
                        <input type="text" name="title" id="title" class="form-control">
                        <span class="text-danger error-message" id="title_error"></span>
                    </label>

                    <label class="form-control border-0 p-0 mb-2">
                        Body:
                        <textarea name="body" id="body">

                        </textarea>
                        <span class="text-danger error-message" id="body_error"></span>
                    </label>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save" value="0">Add</button>
                </div>
            </div>    
        </div>
    </div>
@endsection

@push('script')
    <!-- datatable js -->
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script>
        // declare textare
        const divArea = tinymce.init({
            selector: "textarea.a-body",
            plugins: ['autoresize'],
            menubar:false,
            statusbar: false,
            toolbar: false,
            readonly: true,
            skin: 'borderless'
        });

        const textArea = tinymce.init({
            selector: "textarea#body",
            height: 200,
            plugins: [
                'lists'
            ],
            menubar:false,
            statusbar: false,
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist',
            spellchecker_dialog: true,
            skin: 'jam',
            icons: 'jam'
        });

        function post_clear(){
            $('#save').val('0');
            $('#save').html('insert');
            $('#modal_title').html('Add Announcement');
            $('#id').val('');
            $('#title').val('');
            $('#active_until').val('');
            tinymce.get('body').setContent('');
            $('#modal').modal('show');
        }

        function post_edit(id, active_until, title){
            $('#save').val('1');
            $('#save').html('Update');
            $('#modal_title').html('Update Announcement');
            $('#id').val(id);
            $('#title').val(title);
            $('#active_until').val(active_until);
            tinymce.get('body').setContent(tinymce.get(id).getContent());
            $('#modal').modal('show');
        }

        function post_delete(id){
            swal({
                title: 'Warning',
                text: ('Your about to delete anouncement #'+id),
                icon: 'warning',
                buttons: ["Cancel", "Yes"],
                dangerMode: true,
            }).then(function(value) {
                if(value){
                    var url = "{{ route('AdminAnnouncementDelete', ['id'=>'id']) }}";
                    url = url.replace('id', id);
                    console.log(url);
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        data: {
                            "_token": "{{csrf_token()}}",
                        },
                        success: function(response){
                            console.log(response);
                            response = JSON.parse(response);
                            swal(
                                response.title,
                                response.message,
                                response.icon
                            ).then(function() {
                                location.reload();
                            });
                        },
                        error: function(response){
                            console.log(response);
                        }
                    })
                }
            });
        }


        $(document).ready(function(){

            $('#save').click(function(){
                $('.error-message').html("");
                if($(this).val()=='0'){
                    $.ajax({
                        type: "POST",
                        url: "{{ route('AdminAnnouncementInsert') }}",
                        data: {
                            "_token": "{{csrf_token()}}",
                            "active_until": $('#active_until').val(),
                            "title": $('#title').val(),
                            "body": tinymce.get("body").getContent()
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
                    var url = "{{ route('AdminAnnouncementUpdate', ['id'=>'id']) }}";
                    url = url.replace('id', $('#id').val());
                    $.ajax({
                        type: "PUT",
                        url: url,
                        data: {
                            "_token": "{{csrf_token()}}",
                            "id": $('#id').val(),
                            "active_until": $('#active_until').val(),
                            "title": $('#title').val(),
                            "body": tinymce.get("body").getContent()
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

            $('#edit').click(function(){
                if($(this).val()==1){
                    $(this).val('0');
                    $(this).removeClass('btn-danger');
                    $('.action-button').addClass('d-none');
                    $(this).html('Edit');
                    $(this).css('background-color', '#fff');
                    $(this).css('color', '#000');
                }
                else{
                    $(this).val('1');
                    $(this).addClass('btn-danger');
                    $('.action-button').removeClass('d-none');
                    $(this).html('Cancel');
                    $(this).css('background-color', '#dc3545');
                    $(this).css('color', '#fff');
                }
                
            });

        });
    </script>
@endpush