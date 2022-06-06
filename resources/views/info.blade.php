@extends('layouts.app')

@section('page_title')
{{ __('Help Center') }}
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-12 mt-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-center">
                        {{ __('Help Center') }}
                    </h5>
                </div>

                <div class="card-body text-center p-3">
                    <h2>{{ __('General Information') }}</h2>
                    <p>{{ __('This page has been created for any user to share everything about their workouts or who wants to find inspiration from other people.') }}</p>
                    <p>{{ __('Everyone can benefit from the website, you can create, edit and view training charts, also in the chart description you can add your tips or diets.') }}</p>
                    <h2>{{ __('Advance Information') }}</h2>
                    <p>{{ __('If you have any doubts about how to use the website you can see everything that is offered and how the website works in the user manual.') }}</p>
                    <a href="#" class="btn btn-info">{{ __('Manual User') }}</a>
                </div>

            </div>
        </div>
        <div class="col-md-6 col-12 my-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-center">{{ __('Contact Us') }}</h5>
                </div>
                <div class="row p-3">

                    <div class="col-md-4 align-middle">
                        {{-- https://www.flaticon.com/free-icon/help-desk_4961736?term=help%20center&related_id=4961736# --}}
                        <img src="{{ asset('img/Info-icons.png') }}" width="100%">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <p class="card-text">{{ __('If you have any suggestions, questions or problems you can send us an email, we will answer you as soon as possible.') }}</p>
                            <a href='mailto:gymzyp@gmail.com' class="btn btn-primary">{{ __('Send email') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
