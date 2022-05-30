@extends('layouts.app')

@section('page_title')
{{ __('Failed payment') }}
@endsection

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center text-center">
        <div class="col-md-8 col-12 mt-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-center">
                        {{ __('Ups! Failed payment') }}
                    </h5>
                </div>
                <div class="card-body pt-2 pb-1">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-12">
                            <br>
                            <i class="fas fa-times-circle text-danger fa-6x"></i>
                            <br>
                            <br>
                            <p>{{ __('Check with your bank to make sure that the payment has not been made.') }}</p>
                            <p>{{ __("Try to do the payment later.") }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
