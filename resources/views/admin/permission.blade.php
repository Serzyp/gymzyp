@extends('adminlte::page')

@section('title', 'Permission')

@section('content_header')
    <h1>Permissions</h1>
@stop

@section('plugins.Datatables', true)
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div>
                    <form action="#" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row mt-2">
                            <div class="col-md-3 col-sm-12">
                                <button type="submit" class="btn btn-success">{{ __('Excel export') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="usersModalRol" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal header -->
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeading">{{ __('Edit user rol') }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form id="usersFormRol" enctype="multipart/form-data" method="POST" class="form-group">
                @csrf

                <div class="modal-body">
                    <div class="form-group" hidden>
                        <label>Id</label>
                        <input type="text" class="form-control" id="id" name="id">
                        <span class="text-danger error-text id_error"></span>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" id="email" name="email" readonly>
                        <span class="text-danger error-text email_error"></span>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="custom-select" id="role" name="role">
                            <option value="user">User</option>
                            <option value="premium">Premium</option>
                            <option value="admin">Admin</option>
                        </select>
                        <span class="text-danger error-text role_error"></span>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="usersSubmitForm">{{ __('Edit') }}</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>

                </div>
            </form>
        </div>
    </div>
</div>

@stop


@section('js')
    <script type="text/javascript">
    $(document).ready(function() {
         var dataTable = $('#datatable').DataTable({
            dom: 'Bfrtip',
            lengthMenu: [
                [10, 40, 50],
                ['10 rows', '40 rows', '50 rows']
            ],
            buttons: [
            //     // 'pdf',
            //     //'copy',
            //     'colvis',
            //     'pageLength',
            //     // 'excel',
            ],
            serverSide: true,
            processing: true,
            colReorder: true,
            autoWidth: false,
            stateSave: true,
            responsive: true,
            bLengthChange: false,
            ajax: "{{ route('admin.permissions.getDatatable') }}",
            columns: [{
                    data: 'id',
                    name: 'id',
                    title: '#'
                },
                {
                    data: 'email',
                    name: 'email',
                    title: 'Email'
                },
                {
                    data: 'role',
                    name: 'role',
                    title: 'Role'
                },
                {
                    data: 'Actions',
                    name: 'Actions',
                    orderable: false,
                    serachable: false,
                    sClass: 'text-center',
                    title: '&nbsp;&nbsp;&nbsp; Actions &nbsp;&nbsp;&nbsp;'
                },
            ]
        });

        $('#usersSubmitForm').click(function(e) {
            /** Problemas con serialize y default form upload
             *
             * Si serializas los datos no se envían los del archivo adjunto.
             * La solución es utilizar FormData, comento las líneas añadidas y modificadas.
             *
             **/
            var that = $(this);
            e.preventDefault();
            var data = new FormData($("#usersFormRol")[0]); //FormData
            console.log(data);
            $.ajax({
                data: data,
                url: "{{ route('admin.permissions.store') }}",
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
                        $('#usersFormRol').trigger("reset");
                        $('#usersModalRol').modal('hide');

                        dataTable.ajax.reload(null,false); //los parámetros permiten que aunque se refresque, te quedes en la misma página;

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
                                }
                            );
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

        // EDITAR UN USUARIO //

        $('body').on('click', '.editUser', function() {
            var idUser = $(this).data("iduser");
            console.log(idUser);
            $('#usersModalRol').trigger("reset");
            $('#id').val(idUser);
            var url = "{{ route('admin.permissions.edit', ':id') }}";
            url = url.replace(':id', idUser);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    console.log(data.user);
                    $('#id').val(data.user.id).change();
                    $('#email').val(data.user.email).change();
                    $("#role").val(data.user.role).change();;

                },
                error: function(data) {
                    console.log('Error:', data);
                    toastr.error(
                        'Not expected error!, please contact with administrators45',
                        '', {
                            "positionClass": "toast-top-right",
                            "timeOut": "3000",
                        }
                    );

                }
            });
            $('#usersModalRol').modal('show');
        });
    });

    </script>
@stop
