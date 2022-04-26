@extends('layouts.app')

@section('page_title')
{{ __('My tables') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-3">
                <a href="javascript:void(0)" class="text-center text-decoration-none" id="tableNewTables" style="color: grey"><h2 class="p-3 mb-0"><i class="fa-regular fa-square-plus"></i> {{ __('Añadir una nueva tabla vacia') }}</h2></a>
            </div>
        </div>

    </div>
    <div class="row justify-content-center">
        @foreach ($myTables as $myTable)
            <div class="col-md-5 col-sd-8">
                <div class="card mb-3" style="max-width: 540px;">
                    <img src="{{ route('table.image',['filename' => $myTable->image_path]) }}" class="img-fluid rounded-end p-2 card-img-top" alt="...">

                    <div class="card-body">
                        <h5 class="card-title">{{ $myTable->name }}</h5>
                        <p class="card-text">{{ substr($myTable->description,0,90);}}... </p>
                        <p class="card-text"><a href="{{ route('table.exercises', $myTable->id) }}" class="btn btn-primary">{{ __('Ver más') }}</a> <small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>

        @endforeach
        {{-- <div class="col-md-5">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                <div class="col-md-4 align-middle">
                    <img src="{{ asset('img/PreTablasGymzyp.png') }}" class="img-fluid rounded-end p-1" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting.This content is a little bit longer... </p>
                    <p class="card-text"><a href="#" class="btn btn-primary">Go somewhere</a> <small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
                </div>
            </div>
        </div> --}}

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
<div class="modal fade" id="tablesModaTable" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal header -->
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeading">New table</h4>
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

                    {{-- <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="created_at">Fecha de creación</label>
                            <input type="date" name="created_at" id="created_at" class="form-control">
                            <span class="text-danger error-text created_at_error"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="updated_at">Fecha de actualización</label>
                            <input type="date" name="updated_at" id="updated_at" class="form-control">
                            <span class="text-danger error-text updated_at_error"></span>
                        </div>
                    </div> --}}
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="tablesSubmitForm">Add</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

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
            $('#tablesModaTable').modal('show');
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
                    if ($.isEmptyObject(data.validation_error) && $.isEmptyObject(data
                                .submit_store_error) && $.isEmptyObject(data
                                .cancel_store_trait_error)) {
                        //alert(data.success);
                        $('#tablesFormTable').trigger("reset");
                        $('#tablesModaTable').modal('hide');

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
                        //Si el cancel trait está activado inhabilitando la edición
                        }else if (!$.isEmptyObject(data.cancel_store_trait_error)) {
                                toastr.error(data.cancel_store_trait_error, '', {
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
    });
</script>
@endsection

