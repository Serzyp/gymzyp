@extends('layouts.app')

@section('page_title')
{{ __('My table') }}
@endsection

@section('content')

<div class="container-fluid">
    <div class="row mt-2">
        <div class="col-md-11">
            <h1>{{ __('Tabla') }}</h1>
        </div>
        {{-- <div class="col-md-1">
            <a class="btn btn-primary btn-lg active" href="{{ url()->previous() }}">{{ __('messages.back') }}</a>
        </div> --}}
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div>
                    <form action="#" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row mt-2">
                            {{-- <div class="col-md-1 col-sm-12">
                                <i class="fas fa-search" style="font-size: 2em;"></i>
                            </div> --}}
                            {{-- <div class="col-md-2 col-sm-12">
                                <label for="filter_employee">Employee</label>
                                <p>
                                    <select class="expense_filters" name="filter_employee" id="filter_employee">
                                        <option value="xxx"> -- --</option>
                                        @foreach ($expenseEmployees as $expense)
                                            <option value="{{ $expense->codEmployee }}">
                                                {{ $expense->employee }}</option>
                                        @endforeach
                                    </select>
                                </p>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="filter_credit_card">Expense type</label>
                                <p>
                                    <select class="expense_filters" name="filter_credit_card" id="filter_credit_card">
                                        <option value="xxx"> -- --</option>
                                        <option value="null">Cash expense</option>
                                        <option value="1">Credit card</option>
                                    </select>
                                </p>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="filter_cost_type">Cost type</label>
                                <p>
                                    <select class="expense_filters" name="filter_cost_type" id="filter_cost_type">
                                        <option value="xxx"> -- --</option>
                                        @foreach ($expenseCostTypes as $expense)
                                            <option value="{{ $expense->codCostType }}">
                                                {{ $expense->cost_type }}</option>
                                        @endforeach
                                    </select>
                                </p>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="filter_validation_status">Validation status</label>
                                <p>
                                    <select class="expense_filters" name="filter_validation_status"
                                        id="filter_validation_status">
                                        <option value="xxx"> -- --</option>
                                        @foreach ($expenseStatuses as $expense)
                                            <option value="{{ $expense->codValidationStatus }}">
                                                {{ $expense->validationStatus }}</option>
                                        @endforeach
                                    </select>
                                </p>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label>Approval status</label>
                                <p>
                                    <select class="expense_filters" name="filter_ApprovedRejectedPending"
                                        id="filter_ApprovedRejectedPending">
                                        <option value="xxx"> -- --</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                        <option value="Pending">Pending</option>
                                    </select>
                                </p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 col-sm-12">
                                <label for="filter_company">Company</label>
                                <p>
                                    <select class="expense_filters" name="filter_company" id="filter_company">
                                        <option value="xxx"> -- --</option>
                                        @foreach ($companies as $model)
                                            <option value="{{ $model->codCompany }}">
                                                {{ $model->company }}</option>
                                        @endforeach
                                    </select>
                                </p>
                            </div> --}}
                            {{-- <div class="col-md-2 col-sm-12">
                                <label for="filter_validation_created_at">Date create validation</label>
                                <p>
                                    <input class="form-control expense_filters_input" type="date"
                                        name="filter_validation_created_at" id="filter_validation_created_at">
                                </p>
                            </div> --}}
                            <div class="col-md-1 col-sm-12">
                                <label>Filtering</label>
                                <a href="javascript:void(0)" id="reseteador" class="btn btn-secondary">Reset filters</a>
                            </div>
                            <div class="col-md-1 col-sm-12">
                                <label>Export data</label>
                                <button type="submit" class="btn btn-success">Excel export</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row mb-2">
                    <a class="btn btn-success" href="javascript:void(0)" id="createNewExpense"> <i
                            class="fas fa-plus"></i>
                        {{ __('messages.add') }}</a>
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped data-table" style="width:100%">

                    </table>
                </div>
            </div>

        </div>
    </div>
</div>





<script type="text/javascript">
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
            colReorder: true,
            autoWidth: false,
            ordering: false,
            serverSide: true,
            stateSave: true,
            //orderable: false,
            processing: true,
            responsive: true,
            bLengthChange: false,
            lengthMenu: [
                [25, 40, 50],
                ['25 rows', '40 rows', '50 rows']
            ],
            dom: 'Bfrtip',
            buttons: [
                'pdf',
                //'copy',
                'colvis',
                'pageLength',
                'excel'
            ],

            columns: [
                {
                    data: 'id',
                    name: 'id',
                    title: '#'
                },
                {
                    data: 'Actions',
                    name: 'Actions',
                    orderable: false,
                    serachable: false,
                    sClass: 'text-center',
                    title: '&nbsp;&nbsp;&nbsp;&nbsp;Actions&nbsp;&nbsp;&nbsp;'
                },
                {
                    data: 'sets',
                    name: 'sets',
                    title: 'sets'
                },
                {
                    data: 'reps',
                    name: 'reps',
                    title: 'reps'
                },
                {
                    data: 'content',
                    name: 'content',
                    title: 'content'
                },
                {
                    data: 'day',
                    name: 'day',
                    title: 'day'
                },
                {
                    data: 'moment',
                    name: 'moment',
                    title: 'moment'
                },
                {
                    data: 'header',
                    name: 'header',
                    title: 'Header',
                    default: ''
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

        //Collapsar acordeón
        $('#datatable tbody').on('click', 'svg.collapseSpan', function() {
            var name = $(this).data('name2');
            collapsedGroups[name] = !collapsedGroups[name];
            datatable.draw(false);
        });
    });
</script>


@endsection
