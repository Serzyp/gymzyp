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
                        {{ __('Most commented tables') }}
                    </h5>
                </div>

                <div class="card-body pt-2 pb-1">
                    @foreach ($tableComments as $table)
                    <a href="{{ route('table.show',$table->id) }}" style="color: rgb(0, 0, 0);text-decoration: none;">
                        <div class="p-1 row border border-secondary rounded barTable">

                            <div class="col-2">
                                <img alt="imagen" src="{{ route('table.image',['filename' => $table->image_path]) }}" class="h-3 w-3" />
                            </div>

                            <div class="col-5 d-flex justify-content-center align-items-center">
                                <span class="align-middle"> {{ $table->name }} </span>
                            </div>

                            <span class="col-5 d-flex justify-content-center align-items-center">
                                <div class="p-1 bd-highlight">
                                    <span>{{ $table->likes->count() }} <i class="fa-solid fa-heart"></i></span>
                                </div>
                                <div class="p-1 bd-highlight">
                                    <span>{{ $table->commentCount }} <i class="fa-solid fa-comment"></i></span>
                                </div>
                                <div class="p-1 bd-highlight">
                                    <span>{{ $table->user->nick }} <i class="fa-solid fa-user"></i></span>
                                </div>
                            </span>

                        </div>
                    </a>

                    @endforeach
                    <div class="row mt-4">
                        <div class="col">
                            <div class="d-flex justify-content-center">
                                {!! $tableComments->links() !!}
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
                        {{ __('Recently added tables') }}
                    </h5>
                </div>

                <div class="card-body pt-2 pb-1">
                    @foreach ($tableNewest as $table)
                    <a href="{{ route('table.show',$table->id) }}" style="color: rgb(0, 0, 0);text-decoration: none;">
                        <div class="p-1 row border border-secondary rounded barTable">

                                <div class="col-2">
                                    <img alt="imagen" src="{{ route('table.image',['filename' => $table->image_path]) }}" class="h-3 w-3" />
                                </div>

                                <div class="col-5 d-flex justify-content-center align-items-center">
                                    <span class="align-middle"> {{ $table->name }} </span>
                                </div>

                                <span class="col-5 d-flex justify-content-center align-items-center">

                                    <div class="p-1 bd-highlight">
                                        <span>{{ $table->likes->count() }} <i class="fa-solid fa-heart"></i></span>
                                    </div>
                                    <div class="p-1 bd-highlight">
                                        <span>{{ $table->comments->count() }} <i class="fa-solid fa-comment"></i></span>
                                    </div>
                                    <div class="p-1 bd-highlight">
                                        <span>{{ $table->user->nick }} <i class="fa-solid fa-user"></i></span>
                                    </div>
                                </span>

                        </div>
                    </a>
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
                        {{ __('Most liked tables') }}
                    </h5>
                </div>

                <div class="card-body pt-2 pb-1">
                    @foreach ($tableLikes as $table)
                    <a href="{{ route('table.show',$table->id) }}" style="color: rgb(0, 0, 0);text-decoration: none;">
                        <div class="p-1 row border border-secondary rounded barTable">

                            <div class="col-2">
                                <img alt="imagen" src="{{ route('table.image',['filename' => $table->image_path]) }}" class="h-3 w-3" />
                            </div>

                            <div class="col-5 d-flex justify-content-center align-items-center">
                                <span class="align-middle"> {{ $table->name }} </span>
                            </div>

                            <span class="col-5 d-flex justify-content-center align-items-center">
                                <div class="p-1 bd-highlight">
                                    <span>{{ $table->likeCount}} <i class="fa-solid fa-heart"></i></span>
                                </div>
                                <div class="p-1 bd-highlight">
                                    <span>{{ $table->comments->count() }} <i class="fa-solid fa-comment"></i></span>
                                </div>
                                <div class="p-1 bd-highlight">
                                    <span>{{ $table->user->nick }} <i class="fa-solid fa-user"></i></span>
                                </div>
                            </span>

                        </div>
                    </a>
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
        @if(auth()->user()->role == 'pro' || auth()->user()->role == 'admin')
            <div class="col-md-6 col-12 mt-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-center">
                            {{ __('Premium tables') }}
                        </h5>
                    </div>

                    <div class="card-body pt-2 pb-1">
                        @foreach ($tablePremium as $table)
                        <a href="{{ route('table.show',$table->id) }}" style="color: rgb(0, 0, 0);text-decoration: none;">
                            <div class="p-1 row border border-secondary rounded barTable">

                                <div class="col-2">
                                    <img alt="imagen" src="{{ route('table.image',['filename' => $table->image_path]) }}" class="h-3 w-3" />
                                </div>

                                <div class="col-5 d-flex justify-content-center align-items-center">
                                    <span class="align-middle"> {{ $table->name }} </span>
                                </div>

                                <span class="col-5 d-flex justify-content-center align-items-center">
                                    <div class="p-1 bd-highlight">
                                        <span>{{ $table->likes->count()}} <i class="fa-solid fa-heart"></i></span>
                                    </div>
                                    <div class="p-1 bd-highlight">
                                        <span>{{ $table->comments->count() }} <i class="fa-solid fa-comment"></i></span>
                                    </div>
                                    <div class="p-1 bd-highlight">
                                        <span>{{ $table->user->nick }} <i class="fa-solid fa-user"></i></span>
                                    </div>
                                </span>

                            </div>
                        </a>
                        @endforeach
                        <div class="row mt-4">
                            <div class="col">
                                <div class="d-flex justify-content-center">
                                    {!! $tablePremium->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-6 col-12 mt-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-center">
                            {{ __('Premium tables') }}
                        </h5>
                    </div>

                    <div class="card-body bg-dark text-light">
                        <div class="d-flex justify-content-center mt-3 mb-3">
                            <p>{{ __('This content is blocked because you have the free version.') }}</p>
                        </div>
                        <div class="d-flex justify-content-center mt-3 mb-3">
                            <i class="fas fa-lock fa-8x"></i>
                        </div>
                        <div class="d-flex justify-content-center mt-3 mb-3">
                            <p>{{ __('If you want to purchase the pro version, click on this button.') }}</p>
                        </div>
                        <div class="d-flex justify-content-center mt-3 mb-3">
                            <a href="{{ route('paypal.index') }}" id="features" class="btn">Buy premium features</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>

@endsection
