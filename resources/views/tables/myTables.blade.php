@extends('layouts.app')

@section('page_title')
{{ __('My tables') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-3 card-newtable">
                <a href="javascript:void(0)" class="text-center text-decoration-none text-newtable" id="tableNewTables" ><h2 class="p-3 mb-0"><i class="fa-regular fa-square-plus"></i> {{ __('Add new table empty') }}</h2></a>
            </div>
        </div>

    </div>
    <script>

        function refresh_likes(id){
            var url = "{{ route('like.reload', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response){
                    $(".likeCount_"+id).html(response);
                },
                complete: function(){
                    setTimeout( refresh_likes(id), 1000);
                }
            });


        }
    </script>
    <div class="row justify-content-center">
        @foreach ($myTables as $myTable)
            <div class="col-8">
                <div class="card mb-3" >
                    <div class="row ">
                        <div class="col-md-4 align-middle">
                            <img src="{{ route('table.image',['filename' => $myTable->image_path]) }}" class="img-fluid rounded-end p-2 card-img-top" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $myTable->name }}</h5>
                                <p class="card-text">{{ substr($myTable->description,0,130);}}... </p>
                                <p class="card-text">
                                    <div id="like-{{ $myTable->id }}">
                                        <a href="{{ route('table.exercises', $myTable->id) }}" class="btn btn-primary">{{ __('Show more') }}</a>

                                        {{-- Averiguar cuantos likes tiene la tabla y si el usuaria que esta viendo la pagina ha dado o no like --}}
                                        {{ $userlike = false; }}
                                        @foreach ($myTable->likes as $like)
                                            @if ($like->user->id == Auth::user()->id)
                                                <?php $userlike = true; ?>
                                            @endif
                                        @endforeach

                                        @if ($userlike)
                                            <a class="btn-dislike btn btn-danger" data-id="{{ $myTable->id }}">
                                            <i class="ico{{ $myTable->id }} fa-solid fa-heart"></i>
                                        @else
                                            <a class="btn-like btn btn-danger" data-id="{{ $myTable->id }}">
                                            <i class="ico{{ $myTable->id }} fa-regular fa-heart"></i>
                                        @endif
                                        | <span class="likeCount_{{ $myTable->id }}"></span>
                                        </a>
                                        <script>refresh_likes({{ $myTable->id }});</script>
                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


    </div>
    <div class="row mt-4">
        <div class="col">
            <div class="d-flex justify-content-center">
                {!! $myTables->links() !!}
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tablesModalTable" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal header -->
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeading">{{ __('New table') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal body -->
            <form id="tablesFormTable" enctype="multipart/form-data" method="POST" class="form-group">
                @csrf

                <div class="modal-body">
                    <div class="form-group" hidden>
                        <label>Id</label>
                        <input type="text" class="form-control" id="id" name="id">
                        <span class="text-danger error-text id_error"></span>
                    </div>
                    <div class="form-group" hidden>
                        <label>IdUser</label>
                        <input type="text" class="form-control" id="user_id" name="user_id">
                        <span class="text-danger error-text user_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Title') }}</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Title">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>{{ __('Description') }}</label>
                            <textarea name="description" id="description" class="form-control" cols="170" rows="5"></textarea>
                            <span class="text-danger error-text description_error"></span>
                        </div>
                    </div>
                    @if (Auth::user()->role == 'premium' || Auth::user()->role == 'admin')

                        <div class="form-row">
                            <div class="form-group">
                                <label>{{ __('Premium') }}</label>
                                <select name="paid_mode" class="form-select" id="paid_mode">
                                    <option value="0">{{ __('No') }}</option>
                                    <option value="1">{{ __('Yes') }}</option>
                                </select>
                                <span class="text-danger error-text paid_mode_error"></span>
                            </div>
                        </div>
                    @endif
                    <div class="form-row">
                        <div class="form-group">
                            <label for="image_path">{{ __('Imagen') }}</label>

                            <div class="col-md-6">

                                <input id="image_path" type="file" class="form-control @error('image_path') is-invalid @enderror" name="image_path">
                            </div>
                            <span class="text-danger error-text image_path_error"></span>
                        </div>

                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="tablesSubmitForm">{{ __('Add') }}</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __('Close') }}</button>

                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        clean_fields();

        function clean_fields() {
            $('#tablesFormTable').trigger("reset");
            resetErrorMsg();
            $('.error-text').text('');
        }

        $('#tableNewTables').click(function() {
            clean_fields();
            $('#tablesModalTable').modal('show');
        });

        $('#tablesSubmitForm').click(function(e) {
            /** Problemas con serialize y default form upload
             *
             * Si serializas los datos no se envían los del archivo adjunto.
             * La solución es utilizar FormData, comento las líneas añadidas y modificadas.
             *
             **/
            var that = $(this);
            e.preventDefault();
            var data = new FormData($("#tablesFormTable")[0]); //FormData
            console.log(data);
            $.ajax({
                data: data,
                url: "{{ route('table.store') }}",
                type: "POST",
                dataType: 'json', //Se mantiene esta línea porque es el formato que lee store
                processData: false, //FormData
                contentType: false, //FormData
                beforeSend: function(data) {
                    that.hide();
                },
                complete: function(data) {
                    that.show();
                },
                success: function(data) {
                    //console.log("Data: "+ data.error)
                    if ($.isEmptyObject(data.validation_error) &&
                        $.isEmptyObject(data.submit_store_error)) {
                        //alert(data.success);
                        $('#tablesFormTable').trigger("reset");
                        $('#tablesModalTable').modal('hide');
                        var Reset = (data.success);
                        if (Reset !== '') {
                            setTimeout(function () {
                                window.location.reload();
                            }, 3500);
                        }
                        clean_fields();
                        toastr.success(data.submit_store_success, '', {
                            "positionClass": "toast-top-right",
                            "timeOut": "3000",
                        });
                    } else {
                        //Si falla la validación de campos
                        if (!$.isEmptyObject(data.validation_error)) {
                            printErrorMsg(data.validation_error);
                        }
                        //Si al guardar salta el catch (foreign key o cualquier exception sql)
                        else if (!$.isEmptyObject(data.submit_store_error)) {
                            printErrorMsg(data.validation_error);
                            toastr.warning(data.submit_store_error, '', {
                                "positionClass": "toast-top-right",
                                "timeOut": "3000",
                            });
                        } else {
                            @if (App::isLocale('es'))
                                toastr.error(
                                    'Error no encontrado, porfavor contacte con los administradores',
                                    '', {
                                        "positionClass": "toast-top-right",
                                        "timeOut": "3000",
                                    }
                                );
                            @else
                                toastr.error(
                                    'Uncaught error, please contact with administrators',
                                    '', {
                                        "positionClass": "toast-top-right",
                                        "timeOut": "3000",
                                    }
                                );

                            @endif
                        }
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                    @if (App::isLocale('es'))
                        toastr.error(
                            'Error no esperado, porfavor contacte con los administradores',
                            '', {
                                "positionClass": "toast-top-right",
                                "timeOut": "3000",
                            }
                        );
                    @else
                        toastr.error(
                            'Not expected error!, please contact with administrators',
                            '', {
                                "positionClass": "toast-top-right",
                                "timeOut": "3000",
                            }
                        );
                    @endif

                }

            });
        });

        function printErrorMsg(msg) {
            $('.error-text').text('');
            $.each(msg, function(key, value) {
                console.log(key);
                $('.' + key + '_error').text(value);
            });
        }

        function resetErrorMsg() {
            $('.error-text').text('');
        }

        // Botón de like
        function like(){
            $('.btn-like').unbind('click').click(function(){
                console.log('like');
                $(this).addClass('btn-dislike').removeClass('btn-like');

                var id = $(this).data('id');
                console.log(id);
                var url = "{{ route('like.save', ':table_id') }}";
                    url = url.replace(':table_id', id);

                var classr = ".ico"+id;
                console.log(classr);
                $(classr).addClass('fa-solid').removeClass('fa-regular');
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response){
                        if(response.like){
                            console.log('Has dado like a la tabla');

                            $("#like").load(" #like-"+id);
                        }else{
                            console.log('Error al dar like');
                        }
                    }
                });
                dislike();
            });
        }
        like();

        // Botón de dislike
        function dislike(){
            $('.btn-dislike').unbind('click').click(function(){
                $(this).addClass('btn-like').removeClass('btn-dislike');

                var id = $(this).data('id');
                console.log(id);
                var url = "{{ route('like.delete', ':table_id') }}";
                    url = url.replace(':table_id', id);
                    var classr = ".ico"+id;
                console.log(classr);
                $(classr).addClass('fa-regular').removeClass('fa-solid');
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response){
                        if(response.like){
                            console.log('Has dado dislike a la tabla');
                            $("#like").load(" #like-"+id);
                        }else{
                            console.log('Error al dar dislike');
                        }
                    }
                });

                like();
            });
        }
	    dislike();



    });
</script>
@endsection

