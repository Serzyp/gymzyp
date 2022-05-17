@extends('layouts.app')

@section('page_title')
{{ __('Index') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-12 mt-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-center">
                        Tablas #1
                    </h5>
                </div>

                <div class="card-body pt-2 pb-1">
                    <div role="button" class="p-1 row border border-secondary rounded">

                            <div class="col-2">
                                <img alt="Gafollas" src="https://bootdey.com/img/Content/avatar/avatar1.png" class="h-3 w-3" />
                            </div>

                            <div class="col-5 d-flex justify-content-center align-items-center">
                                <span class="align-middle"> Titulo de la tabla </span>
                            </div>

                            <span class="col-5 d-flex justify-content-center align-items-center">

                                <div class="p-1 bd-highlight">
                                    <span>342345 <i class="fa-solid fa-heart"></i></span>
                                </div>
                                <div class="p-1 bd-highlight">
                                    <span>Vegeta777 <i class="fa-solid fa-user"></i></span>
                                </div>

                            </span>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mt-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-center">
                        Tablas #2
                    </h5>
                </div>

                <div class="card-body pt-2 pb-1">
                    @foreach ($tableNewest as $table)
                    <div role="button" class="p-1 row border border-secondary rounded">

                            <div class="col-2">
                                <img alt="Gafollas" src="https://bootdey.com/img/Content/avatar/avatar1.png" class="h-3 w-3" />
                            </div>

                            <div class="col-5 d-flex justify-content-center align-items-center">
                                <span class="align-middle"> {{ $table->name }} </span>
                            </div>

                            <span class="col-5 d-flex justify-content-center align-items-center">

                                <div class="p-1 bd-highlight">
                                    <span>{{ $table->likes->count() }} <i class="fa-solid fa-heart"></i></span>
                                </div>
                                <div class="p-1 bd-highlight">
                                    <span>{{ $table->user->nick }} <i class="fa-solid fa-user"></i></span>
                                </div>

                            </span>

                    </div>
                    @endforeach

                    <div class="row mt-4">
                        <div class="col">
                            <div class="d-flex justify-content-center">
                                {!! $tableNewest->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 mt-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-center">
                        Tablas #3
                    </h5>
                </div>

                <div class="card-body pt-2 pb-1">
                    @foreach ($tableLikes as $table)

                    <div role="button" class="p-1 row border border-secondary rounded">

                            <div class="col-2">
                                <img alt="Gafollas" src="https://bootdey.com/img/Content/avatar/avatar1.png" class="h-3 w-3" />
                            </div>

                            <div class="col-5 d-flex justify-content-center align-items-center">
                                <span class="align-middle"> {{ $table->name }} </span>
                            </div>

                            <span class="col-5 d-flex justify-content-center align-items-center">

                                <div class="p-1 bd-highlight">
                                    <span>{{ $table->likeCount}} <i class="fa-solid fa-heart"></i></span>
                                </div>
                                <div class="p-1 bd-highlight">
                                    <span>{{ $table->user->nick }} <i class="fa-solid fa-user"></i></span>
                                </div>

                            </span>

                    </div>

                    @endforeach
                    <div class="row mt-4">
                        <div class="col">
                            <div class="d-flex justify-content-center">
                                {!! $tableLikes->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
