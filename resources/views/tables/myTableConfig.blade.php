@php
    use Carbon\Carbon;
@endphp

@extends('layouts.app')

@section('page_title')
{{ __('My table') }}
@endsection

@section('content')

<div class="container-fluid">
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
    <div class="row m-2">
        <div class="col-md-8 col-12 mb-2">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-center">
                        {{ $table->name }}
                    </h5>
                </div>

                <div class="card-body pt-2 pb-1 text-center">
                    <div class="imageExercises">
                        <img src="{{ route('table.image',['filename' => $table->image_path]) }}" class="img-thumbnail rounded-end p-2 card-img-top imagenTableBackground" alt="...">
                    </div>
                    <div class="actionBox text-center m-1 my-3">
                        <a class="edit btn btn-primary btn-sm" id="editTable" href="javascript:void(0)" ><i class="fas fa-pen fa-2x"></i></a>

                        <a href="javascript:void(0)"  class="btn btn-danger btn-sm deleteTable"><i class="fas fa-trash-alt fa-2x"></i></a>
                    </div>
                    <div class="text-start">
                        {!! $table->description !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3 text-center">

            <div class="row">
                <div class="card h-100 px-0">
                    <div class="card-header w-100">
                        <h5 class="card-title mb-0 text-center">
                            {{ __('User Details') }}
                        </h5>
                    </div>

                    <div class="card-body pt-2 pb-1 text-center justify-content-center">
                        {{-- <h3>{{ $table->user->name }}</h3>
                        <p>{{ $table->user->email }}</p> --}}
                        <div class="m-4">
                            @if($table->user->image)
                                <img src="{{ route('user.avatar',$table->user->image) }}"
                                class="rounded-circle img-fluid" style="width: 100px;  height: 100px;" />
                            @else
                                {{-- https://pixabay.com/images/id-3331256/ --}}
                                <img src="{{ asset('img/DefaultUserV2.jpg') }}"
                                class="rounded-circle img-fluid" style="width: 100px; height: 100px;" />

                            @endif
                        </div>
                            <h4 class="mb-2">{{ $table->user->name }}</h4>
                            <p class="text-muted mb-2">{{ $table->user->email }}</p>

                            <a class="btn btn-primary btn-rounded btn-lg mb-2" href='mailto:{{ $table->user->email }}'>
                            {{ __("Message") }}
                            </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card h-100 px-0 mt-2">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-center">
                            {{ __('Likes') }}
                        </h5>
                    </div>

                    <div class="card-body pt-2 pb-1">
                        <div class="info-box">
                            {{-- Averiguar cuantos likes tiene la tabla y si el usuaria que esta viendo la pagina ha dado o no like --}}
                            {{ $userlike = false; }}
                            @foreach ($table->likes as $like)
                                @if ($like->user->id == Auth::user()->id)
                                    <?php $userlike = true; ?>
                                @endif
                            @endforeach

                            @if ($userlike)
                                <a class="btn-dislike info-box-icon btn bg-danger" data-id="{{ $table->id }}">
                                <i class="ico{{ $table->id }} fa-solid fa-heart"></i>
                            @else
                                <a class="btn-like info-box-icon btn bg-danger" data-id="{{ $table->id }}">
                                <i class="ico{{ $table->id }} fa-regular fa-heart"></i>
                            @endif
                            </a>

                            {{-- <span class="info-box-icon bg-danger"><i class="fa-regular fa-heart"></i></span> --}}
                            <div class="info-box-content">
                                <span class="info-box-text">Likes</span>
                                {{-- <span class="">99999</span> --}}
                                <span class="info-box-number likeCount_{{ $table->id }}"></span>

                            </div>
                            <script>refresh_likes({{ $table->id }});</script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-1 my-4 text-center">
            <a class="btn btn-primary btn-lg" href="{{ route('table.index') }}">{{ __('Back') }}</a>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div>
                    <form action="{{ route('table.export') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row mt-2">
                            <div class="col-md-3 col-sm-12">
                                <input type="hidden" name="id_table" value="{{ $table->id }}">
                                <button type="submit" class="btn btn-success">{{ __('Excel export') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row mt-2 mb-2">
                    <div class="col-3">
                        <a class="btn btn-success" href="javascript:void(0)" id="addDay"> <i
                            class="fas fa-plus"></i>
                        {{ __('Add Exercise') }}</a>
                    </div>

                </div>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">

                    </table>
                </div>
            </div>

        </div>
    </div>
    <br>

<!-- ZONA DE COMENTARIOS -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title text-center">
                    {{ __('Comments') }}
                </h5>
            </div>
            <div class="card-body">

                @foreach ($table->comments as $comment)

                    <div class="d-flex mt-4">
                        <div class="flex-shrink-0">
                            @if($comment->user->image)
                                <img src="{{ route('user.avatar',$comment->user->image) }}" class="rounded-circle" alt="Sample Image" style="width: 60px; height: 60px; border: 1px solid grey;">
                            @else
                                <img src="{{ asset('img/DefaultUserV2.jpg') }}" class="rounded-circle" alt="Sample Image" style="width: 60px; height: 60px; border: 1px solid grey;">
                            @endif

                        </div>
                        <div class="flex-grow-1 ms-3">
                            @if($comment->user->nick)
                                <h5>{{ $comment->user->nick }}
                            @else
                                <h5>{{ $comment->user->name }}
                            @endif
                                <small class="text-muted">
                                    <i>{{ __('Posted on ') }}{{  Carbon::parse($comment->created_at)->formatLocalized('%d-%m-%Y'); }}</i>
                                </small>
                                @if ($comment->user_id == Auth::user()->id || Auth::user()->role == 'admin' || $comment->table->user_id == Auth::user()->id)
                                    <a class="btn-delete" href="{{ route('comment.delete',$comment->id); }}"><i class="fa-solid fa-trash-can"></i></a>
                                @endif
                            </h5>
                            <p>{{ $comment->content }}</p>
                        </div>
                    </div>
                    @if(!$loop->last)
                        <hr>
                    @endif

                @endforeach
            </div>
            <hr>
            <div class="card-body">
                <form action="{{ route('comment.save') }}" method="post">
                    @csrf

                    <input type="hidden" name="table_id" value="{{ $table->id }}" />
                    <textarea class="form-control" rows="2" {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content"></textarea>

                    <div class="mt-2 clearfix">
                    <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-pencil fa-fw"></i> Share</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



        <!-- Modal DAY Y EXERCISE ADD-->
    <div class="modal fade" id="exerciseModal" data-backdrop="static">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="modalHeadingExercise">{{ __('Add Exercise') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal body -->
                <form id="exerciseFormBody" enctype="multipart/form-data" method="POST" class="form-group">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group" hidden>
                            <label>Id</label>
                            <input type="text" class="form-control" id="id" name="id">
                            <span class="text-danger error-text id_error"></span>
                        </div>
                        <div class="form-group" hidden>
                            <label>Table_Id</label>
                            <input type="text" class="form-control" id="table_id" name="table_id" value="{{ $table->id }}">
                            <span class="text-danger error-text table_id_error"></span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Exercise name') }}: </label>
                            <input type="text" class="form-control" id="content" name="content" placeholder="Press Bench">
                            <span class="text-danger error-text content_error"></span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Sets') }}:</label>
                            <input type="number" class="form-control" id="sets" name="sets" min="1" placeholder="3">
                            <span class="text-danger error-text sets_error"></span>
                        </div>
                        <div class="form-group">
                            {{-- Posibilidades de ser traducido en un futuro --}}
                            <label>{{ __('Reps') }}:</label>
                            <input type="text" class="form-control" id="reps" name="reps" placeholder="15 or 15-10-5 (Example)">
                            <span class="text-danger error-text reps_error"></span>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Day') }}</label>
                            <select name="day_id" id="day_id" class="form-select">
                                @foreach ($days as $day)
                                    <option value="{{ $day->id }}">{{ $day->day." - ".$day->moment }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text day_id_error"></span>
                        </div>

                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="exercisesSubmitForm">{{ __('Add') }}</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __('Close') }}</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

        <!-- Modal -->
    <div class="modal fade" id="tablesModalTable" data-backdrop="static">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="modalHeading">{{ __('Edit table') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal body -->
                <form id="tablesFormTable" enctype="multipart/form-data" method="POST" class="form-group">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group" hidden>
                            <label>Id</label>
                            <input type="text" class="form-control" id="id_table" name="id">
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
                                <textarea name="description" id="description" class="form-control summernote" cols="170" rows="5"></textarea>
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
                        <button type="submit" class="btn btn-success" id="tablesSubmitForm">{{ __('Edit') }}</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __('Close') }}</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    //DATATABLE

    $(document).ready(function() {
        var collapsedGroups = {};
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.summernote').summernote();

        var url = '{{ route('table.exerciseDatatable',$codTable) }}';
        var datatable = $('#datatable').DataTable({
            @if (App::isLocale('es'))


                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
            @endif
            ajax: url,
            // colReorder: true,
            autoWidth: false,
            ordering: false,
            serverSide: true,
            stateSave: true,
            paging: false,
            info: false,
            //orderable: false,
            processing: true,
            responsive: true,
            bLengthChange: false,
            dom: 'Bfrtip',

            buttons: [
            //     // 'pdf',
            //     //'copy',
            //     'colvis',
            //     'pageLength',
            //     // 'excel',
            ],

            columns: [
                // {
                //     data: 'id',
                //     name: 'id',
                //     title: '#'
                // },

                {
                    data: 'content',
                    name: 'content',
                    sClass: 'text-center',
                    title: '{{ __("Exercise name") }}'
                },
                {
                    data: 'sets',
                    name: 'sets',
                    sClass: 'text-center',
                    title: '{{ __("Sets") }}'
                },
                {
                    data: 'reps',
                    name: 'reps',
                    sClass: 'text-center',
                    title: '{{ __("Reps") }}'
                },
                {
                    data: 'Actions',
                    name: 'Actions',
                    orderable: false,
                    serachable: false,
                    sClass: 'text-center',
                    title: '&nbsp;&nbsp;&nbsp;&nbsp;{{ __("Actions") }}&nbsp;&nbsp;&nbsp;'
                },


            ],
            rowGroup: {
                //Sirve para inicializar el rowGroup. La opcion emptyDataGroup lo deja vacío Y SIN MOSTRAR
                //emptyDataGroup: null,
                dataSrc: "day_id",
                startRender: function(rows, group) {
                    var codExp = rows.data()[0].day_id;
                    var header = rows.data()[0].headerButtons;
                    var collapsed = !!collapsedGroups[group];
                    //Mostrar con líneas
                    if (rows.data()[0].day_id != null) {
                        rows.nodes().each(function(r) {
                            r.style.display = collapsed ? 'none' : '';
                        });
                        var toggleClass = collapsed ? 'fa-plus-square' : 'fa-minus-square';
                        // Add category name to the <tr>. NOTE: Hardcoded colspan
                        return $('<tr/>')
                            .append('<td  colspan="' + rows.columns()[0].length +
                                '" ><span class="fa fa-fw ' + toggleClass +
                                ' toggler collapseSpan" data-name2="' + codExp + '" > </span> ' +
                                header + ' </td>')
                            .attr('data-name', codExp)
                            .toggleClass('collapsed', collapsed);
                    }
                    //Ocultar sin líneas (sólo existe cabecera)
                    else {
                        rows.nodes().each(function(r) {
                            r.style.display = collapsed ? '' : 'none';
                        });
                        var toggleClass = collapsed ? 'fa-plus-square' : 'fa-minus-square';
                        return $('<tr/>')
                            .append('<td  colspan="' + rows.columns()[0].length +
                                '" ><span class="fa fa-fw fa-stopwatch toggler" data-name2="' +
                                codExp + '" ></i></span>&nbsp;' + header + ' </td>')
                            .attr('data-name', codExp)
                            .toggleClass('collapsed', collapsed);
                    }
                }
            },

        });

        //Collapsar acordeón de Datatable
        $('#datatable tbody').on('click', 'svg.collapseSpan', function() {
            var name = $(this).data('name2');
            collapsedGroups[name] = !collapsedGroups[name];
            datatable.draw(false);
        });

        clean_fields();

        function clean_fields() {
            $('#exerciseFormBody').trigger("reset");
            resetErrorMsg();
            $('.error-text').text('');
        }

        $('#addDay').click(function() {
            clean_fields();
            $('#modalHeadingExercise').html('{{ __('Add Exercise') }}');
            $('#exercisesSubmitForm').html('{{ __('Add') }}');
            $('#exerciseModal').modal('show');
        });

        // AÑADIR UN EJERCICIO //

        $('#exercisesSubmitForm').click(function(e) {
            /** Problemas con serialize y default form upload
             *
             * Si serializas los datos no se envían los del archivo adjunto.
             * La solución es utilizar FormData, comento las líneas añadidas y modificadas.
             *
             **/
            var that = $(this);
            e.preventDefault();
            var data = new FormData($("#exerciseFormBody")[0]); //FormData
            console.log(data);
            $.ajax({
                data: data,
                url: "{{ route('exercises.store') }}",
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
                    if ($.isEmptyObject(data.validation_error)) {
                        //alert(data.success);
                        $('#exerciseFormBody').trigger("reset");
                        $('#exerciseModal').modal('hide');

                        datatable.ajax.reload(null,false); //los parámetros permiten que aunque se refresque, te quedes en la misma página;

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


        // EDITAR UN EJERCICIO //

        $('body').on('click', '.editExercise', function() {
            var idExercise = $(this).data("idexercise");
            $('#exerciseModal').trigger("reset");
            $('#modalHeadingExercise').html('{{ __("Edit exercise") }}');
            $('#exercisesSubmitForm').html('{{ __("Edit exercise") }}');
            clean_fields();
            $('#id').val(idExercise);
            var url = "{{ route('exercises.edit', ':id') }}";
            url = url.replace(':id', idExercise);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    console.log(data.exercise);
                    $('#content').val(data.exercise.content).change();

                    $('#sets').val(data.exercise.sets).change();

                    $("#reps").val(data.exercise.reps);
                    $("#day_id").val(data.exercise.day_id);
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
            $('#exerciseModal').modal('show');
        });


        // ELIMINAR UN EJERCICIO //

        $('body').on('click', '.deleteExercise', function() {
            var idExercise = $(this).data("idexercise");
            var confir = confirm('{{ __("Are you sure you want to delete the record?") }}');
            if (confir == true) {
                var url = "{{ route('exercises.destroy', ':id') }}";
                url = url.replace(':id', idExercise);
                $.ajax({
                    type: "DELETE",
                    url: url,
                    success: function(data) {
                        if ($.isEmptyObject(data.submit_delete_error)) {

                            datatable.ajax.reload(null,false); //los parámetros permiten que aunque se refresque, te quedes en la misma página;
                            toastr.info(data.submit_delete_success, '', {
                                "positionClass": "toast-top-right",
                                "timeOut": "3000",
                            });
                        } else {
                            //Si al guardar salta el catch (foreign key o cualquier exception sql)
                            if (!$.isEmptyObject(data.submit_delete_error)) {
                                toastr.warning(data.submit_delete_error, '', {
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
            }
        });

        //  BOTÓN PARA ABRIR TABLA  //

        $('#editTable').click(function() {
            clean_fields();
            var id = "{{ $table->id }}";
                var url = "{{ route('table.edit', ':id') }}";
                url = url.replace(':id', id);

                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data) {
                        console.log(data);
                        $('#id_table').val(id).change();
                        $('#user_id').val(data.table.user_id).change();
                        $('#name').val(data.table.name);
                        $('#description').summernote("code", data.table.description);
                        // $('#description').val(data.table.description);
                        $('#paid_mode').val(data.table.paid_mode).change();

                        $('#tablesModalTable').modal('show');
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

        // EDITAR UNA TABLA //

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
                    if ($.isEmptyObject(data.validation_error)) {
                        //alert(data.success);
                        $('#tablesFormTable').trigger("reset");
                        $('#tablesModalTable').modal('hide');

                        var Reset = (data.success);
                        if (Reset !== '') {
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);
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

        //  ELIMINAR TABLA  //

        $('body').on('click', '.deleteTable', function() {
            var idTable = "{{ $table->id }}";
            var confir = confirm('{{ __("Are you sure you want to delete the record?") }}');
            if (confir == true) {
                var url = "{{ route('table.destroy', ':id') }}";
                url = url.replace(':id', idTable);
                $.ajax({
                    type: "DELETE",
                    url: url,
                    success: function(data) {
                        if ($.isEmptyObject(data.submit_delete_error)) {

                            var Reset = (data.success);
                            if (Reset !== '') {
                                setTimeout(function () {
                                    window.location.href = '{{ url()->previous() }}';
                                }, 2000);
                            }
                            toastr.info(data.submit_delete_success, '', {
                                "positionClass": "toast-top-right",
                                "timeOut": "3000",
                            });
                        } else {
                            //Si al guardar salta el catch (foreign key o cualquier exception sql)
                            if (!$.isEmptyObject(data.submit_delete_error)) {
                                toastr.warning(data.submit_delete_error, '', {
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
            }
        });


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
