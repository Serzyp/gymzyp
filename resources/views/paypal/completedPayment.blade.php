@extends('layouts.app')

@section('page_title')
{{ __('Completed payment') }}
@endsection

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center text-center">
        <div class="col-md-8 col-12 mt-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-center">
                        {{ __('Payment successfully completed') }}
                    </h5>
                </div>
                <div class="card-body pt-2 pb-1">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-12">
                            <br>
                            <i class="fas fa-check-circle text-success fa-6x"></i>
                            <br>
                            <br>
                            <p>{{ __('Congratulations! You have made the payment correctly.') }}</p>
                            <p>{{ __("Don't forget to take advantage of the premium user's benefits.") }}</p>
                            <p>{{ __('Many thanks for the support on the website.') }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
