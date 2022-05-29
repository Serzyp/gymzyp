@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ADMIN</h1>
@stop

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

@stop


@section('js')
    <script type="text/javascript">
    $(document).ready(function() {
         var dataTable = $('#datatable').DataTables({
            dom: 'Bfrtip',
            lengthMenu: [
                [10, 40, 50],
                ['10 rows', '40 rows', '50 rows']
            ],
            serverSide: true,
            processing: true,
            colReorder: true,
            autoWidth: false,
            stateSave: true,
            responsive: true,
            bLengthChange: false,
            ajax: "{{ route('admin.users.userDatatable') }}",
            columns: [{
                    data: 'id',
                    name: 'id',
                    title: '#'
                },
                {
                    data: 'name',
                    name: 'name',
                    title: 'Name'
                },
                {
                    data: 'surname',
                    name: 'surname',
                    title: 'Surname'
                },
                {
                    data: 'nick',
                    name: 'nick',
                    title: 'Nickname'
                },
                {
                    data: 'email',
                    name: 'email',
                    title: 'Email'
                },
                {
                    data: 'image',
                    name: 'image',
                    title: 'Image Path'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    title: 'Created at'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                    title: 'Updated at'
                },
                {
                    data: 'external_auth',
                    name: 'external_auth',
                    title: 'External auth'
                },
            ]
        });
    });

    </script>
@stop
