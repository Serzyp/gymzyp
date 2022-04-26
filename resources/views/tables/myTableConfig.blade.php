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
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered data-table" style="width:100%">

                    </table>
                </div>
            </div>

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

        var datatable = $('#datatable').DataTable({
            ajax: '',
            serverSide: true,
            processing: true,
            columns: [

                {
                    data: 'id',
                    name: 'id',
                    title: '#'
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
            ]

        });
    });
</script>


@endsection
