@extends('layouts.app')

@section('page_title')
{{ __('Index') }}
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3 col-12 mt-4">
            <div class="d-flex flex-column align-items-stretch bg-white">
                <a href="#" class="d-flex align-items-center flex-shrink-0 p-3 text-decoration-none justify-content-center border-bottom">
                  <span class="fs-5 fw-semibold">{{ __('Categories') }}</span>
                </a>
                <div class="list-group list-group-flush border-bottom scrollarea">
                    <a href="{{ route('home') }}" class="list-group-item py-3 lh-tight {{ Request::route()->getName() == 'home' ? 'active' : '' }}">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">{{ __('All tables') }}</strong>
                        </div>
                    </a>
                    <a href="{{ route('home.new') }}" class="list-group-item py-3 lh-tight {{ Request::route()->getName() == 'home.new' ? 'active' : '' }}">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">{{ __('Most recently') }}</strong>
                        </div>
                    </a>
                    <a href="{{ route('home.like') }}" class="list-group-item py-3 lh-tight {{ Request::route()->getName() == 'home.like' ? 'active' : '' }}">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">{{ __('Most likes') }}</strong>
                        </div>
                    </a>
                    <a href="{{ route('home.comment') }}" class="list-group-item py-3 lh-tight {{ Request::route()->getName() == 'home.comment' ? 'active' : '' }}">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">{{ __('Most comments') }}</strong>
                        </div>
                    </a>
                    <a href="{{ route('home.premium') }}" class="list-group-item py-3 lh-tight {{ Request::route()->getName() == 'home.premium' ? 'active' : '' }}">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">{{ __('Premium') }}</strong>
                        </div>
                    </a>
                    <a href="{{ route('home.userlike') }}" class="list-group-item py-3 lh-tight {{ Request::route()->getName() == 'home.userlike' ? 'active' : '' }}">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">{{ __('My likes') }}</strong>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        @if(Request::route()->getName() == 'home' || Request::route()->getName() == 'home.comment' || Request::route()->getName() == 'home.new' || Request::route()->getName() == 'home.like' || Request::route()->getName() == 'home.userlike')
            <div class="col-md-8 col-12 mt-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-center">
                            @if (Request::route()->getName() == 'home')
                                {{ __('All tables') }}
                            @elseif (Request::route()->getName() == 'home.comment')
                                {{ __('Most commented tables') }}
                            @elseif (Request::route()->getName() == 'home.new')
                                {{ __('Recently added tables') }}
                            @elseif (Request::route()->getName() == 'home.like')
                                {{ __('Most liked tables') }}
                            @else
                                {{ __('Tables I liked') }}
                            @endif
                        </h5>
                    </div>

                    <div class="card-body pt-2 pb-1">
                        @foreach ($tableView as $table)
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
                                        @if ($table->user->nick)
                                            <span>{{ $table->user->nick }} <i class="fa-solid fa-user"></i></span>
                                        @else
                                            <span>{{ $table->user->name }} <i class="fa-solid fa-user"></i></span>
                                        @endif
                                    </div>
                                </span>

                            </div>
                        </a>

                        @endforeach
                        <div class="row mt-4">
                            <div class="col">
                                <div class="d-flex justify-content-center">
                                    {!! $tableView->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-8 col-12 mt-4">
                @if(auth()->user()->role == 'premium' || auth()->user()->role == 'admin')
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0 text-center">
                                {{ __('Premium tables') }}
                            </h5>
                        </div>

                        <div class="card-body pt-2 pb-1">
                            @foreach ($tableView as $table)
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
                                            @if ($table->user->nick)
                                                <span>{{ $table->user->nick }} <i class="fa-solid fa-user"></i></span>
                                            @else
                                                <span>{{ $table->user->name }} <i class="fa-solid fa-user"></i></span>
                                            @endif

                                        </div>
                                    </span>

                                </div>
                            </a>
                            @endforeach
                            <div class="row mt-4">
                                <div class="col">
                                    <div class="d-flex justify-content-center">
                                        {!! $tableView->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @else
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
                @endif
            </div>
        @endif
    </div>
</div>

@endsection
