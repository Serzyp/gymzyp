@extends('layouts.app')

@section('page_title')
{{ __('My table') }}
@endsection

@section('content')

<div class="container-fluid">
    <div class="row m-2">
        <div class="col-3">
            <div class="imageExercises">
                <img src="{{ route('table.image',['filename' => $table->image_path]) }}" class="img-thumbnail rounded-end p-2 card-img-top" width='50px' alt="...">
            </div>
            <div class="actionBox text-center m-1">
                <a class="edit btn btn-primary btn-sm" id="editTable" href="javascript:void(0)" ><i class="fas fa-pen fa-2x"></i></a>

                <a href="javascript:void(0)"  class="btn btn-danger btn-sm deleteTable"><i class="fas fa-trash-alt fa-2x"></i></a>
            </div>
        </div>
        <div class="col-5 text-center">
            <h1>{{ $table->name }}</h1>
            <p class="text-break">{{ $table->description }}</p>
        </div>
        <div class="col-3 text-center">
            <h1>User Details</h1>
            <h3>{{ $table->user->name }}</h3>
            <p>{{ $table->user->email }}</p>
        </div>
        <div class="col-1 text-center">
            <a class="btn btn-primary btn-lg active" href="{{ url()->previous() }}">{{ __('Back') }}</a>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div>
                    <form action="#" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row mt-2">
                            <div class="col-md-3 col-sm-12">
                                <button type="submit" class="btn btn-success">Excel export</button>
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

        <!-- Modal DAY Y EXERCISE ADD-->
    <div class="modal fade" id="exerciseModal" data-backdrop="static">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="modalHeadingExercise">Add exercise</h4>
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
                            <label>Exercise name: </label>
                            <input type="text" class="form-control" id="content" name="content" placeholder="Press Bench">
                            <span class="text-danger error-text content_error"></span>
                        </div>
                        <div class="form-group">
                            <label>Sets:</label>
                            <input type="number" class="form-control" id="sets" name="sets" min="1" placeholder="3">
                            <span class="text-danger error-text sets_error"></span>
                        </div>
                        <div class="form-group">
                            <label>Reps:</label>
                            <input type="text" class="form-control" id="reps" name="reps" placeholder="15 or 15-10-5 (Example)">
                            <span class="text-danger error-text reps_error"></span>
                        </div>

                        <div class="form-group">
                            <label>Day</label>
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
                        <button type="submit" class="btn btn-success" id="exercisesSubmitForm">Add</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

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
                    <h4 class="modal-title" id="modalHeading">Edit table</h4>
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
                            <label>Title</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Title">
                            <span class="text-danger error-text name_error"></span>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" id="description" class="form-control" cols="170" rows="5"></textarea>
                                <span class="text-danger error-text description_error"></span>
                            </div>
                        </div>
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
                        <button type="submit" class="btn btn-success" id="tablesSubmitForm">Edit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

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
        var url = '{{ route('table.exerciseDatatable',$codTable) }}';
        var datatable = $('#datatable').DataTable({
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
            lengthMenu: [
                [5, 10, 20],
                ['5 rows', '10 rows', '20 rows']
            ],
            dom: 'Bfrtip',
            buttons: [
                // 'pdf',
                //'copy',
                'colvis',
                'pageLength',
                // 'excel',
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
                    title: 'Content'
                },
                {
                    data: 'sets',
                    name: 'sets',
                    sClass: 'text-center',
                    title: 'Sets'
                },
                {
                    data: 'reps',
                    name: 'reps',
                    sClass: 'text-center',
                    title: 'Reps'
                },
                {
                    data: 'Actions',
                    name: 'Actions',
                    orderable: false,
                    serachable: false,
                    sClass: 'text-center',
                    title: '&nbsp;&nbsp;&nbsp;&nbsp;Actions&nbsp;&nbsp;&nbsp;'
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
                            toastr.error(
                                'Uncaught error, please contact with administrators',
                                '', {
                                    "positionClass": "toast-top-right",
                                    "timeOut": "3000",
                                });
                        }
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                    toastr.error(
                        'Not expected error!, please contact with administrators',
                        '', {
                            "positionClass": "toast-top-right",
                            "timeOut": "3000",
                        }
                    );
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
            $('#modalHeadingExercise').html("Edit exercise");
            $('#exercisesSubmitForm').html("Edit exercise");
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
                    toastr.error(
                        'Not expected error!, please contact with administrators',
                        '', {
                            "positionClass": "toast-top-right",
                            "timeOut": "3000",
                        }
                    );
                }
            });
            $('#exerciseModal').modal('show');
        });


        // ELIMINAR UN EJERCICIO //

        $('body').on('click', '.deleteExercise', function() {
            var idExercise = $(this).data("idexercise");
            var confir = confirm("Are you sure you want to delete the record?");
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
                                toastr.error(
                                    'Uncaught error, please contact with administrators',
                                    '', {
                                        "positionClass": "toast-top-right",
                                        "timeOut": "3000",
                                    });
                            }
                        }
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        toastr.error(
                            'Not expected error!, please contact with administrators',
                            '', {
                                "positionClass": "toast-top-right",
                                "timeOut": "3000",
                            }
                        );
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
                        $('#description').val(data.table.description);


                        $('#tablesModalTable').modal('show');
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        toastr.error(
                            'Not expected error!, please contact with administrators',
                            '', {
                                "positionClass": "toast-top-right",
                                "timeOut": "3000",
                            }
                        );
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
                            toastr.error(
                                'Uncaught error, please contact with administrators',
                                '', {
                                    "positionClass": "toast-top-right",
                                    "timeOut": "3000",
                                });
                        }
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                    toastr.error(
                        'Not expected error!, please contact with administrators',
                        '', {
                            "positionClass": "toast-top-right",
                            "timeOut": "3000",
                        }
                    );
                }

            });
        });

        //  ELIMINAR TABLA  //

        $('body').on('click', '.deleteTable', function() {
            var idTable = "{{ $table->id }}";
            var confir = confirm("Are you sure you want to delete the record?");
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
                                toastr.error(
                                    'Uncaught error, please contact with administrators',
                                    '', {
                                        "positionClass": "toast-top-right",
                                        "timeOut": "3000",
                                    });
                            }
                        }
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        toastr.error(
                            'Not expected error!, please contact with administrators',
                            '', {
                                "positionClass": "toast-top-right",
                                "timeOut": "3000",
                            }
                        );
                    }
                });
            }
        });

    });





</script>


@endsection
