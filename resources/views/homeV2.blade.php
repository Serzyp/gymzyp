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
                    <a href="javascript:void(0)" class="list-group-item py-3 lh-tight" id="allTables">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">{{ __('All tables') }}</strong>
                        </div>
                    </a>
                    <a href="javascript:void(0)" class="list-group-item py-3 lh-tight" id="recentTables">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">{{ __('Most recently') }}</strong>
                        </div>
                    </a>
                    <a href="javascript:void(0)" class="list-group-item py-3 lh-tight" id="likeTables">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">{{ __('Most likes') }}</strong>
                        </div>
                    </a>
                    <a href="javascript:void(0)" class="list-group-item py-3 lh-tight" id="commentTables">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">{{ __('Most comments') }}</strong>
                        </div>
                    </a>
                    <a href="javascript:void(0)" class="list-group-item py-3 lh-tight" id="premiumTables">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">{{ __('Premium') }}</strong>
                        </div>
                    </a>
                    <a href="javascript:void(0)" class="list-group-item py-3 lh-tight" id="mylikesTables">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">{{ __('My likes') }}</strong>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-12 mt-4 d-none" id="tableAll">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-center">
                        {{ __('All tables') }}
                    </h5>
                </div>

                <div class="card-body pt-2 pb-1">
                    @foreach ($tableAll as $table)
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
                                {!! $tableAll->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-12 mt-4 d-none" id="tableComment">
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
                                {!! $tableComments->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-12 mt-4 d-none" id="tableRecent">
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
                                {!! $tableNewest->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-12 mt-4 d-none" id="tableLikes">
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
                                {!! $tableLikes->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-12 mt-4 d-none" id="tablePremium">
            @if(auth()->user()->role == 'premium' || auth()->user()->role == 'admin')
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
                                    {!! $tablePremium->links() !!}
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

        <div class="col-md-8 col-12 mt-4 d-none" id="tableLikesUser">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-center">
                        {{ __('Tables I liked') }}
                    </h5>
                </div>

                <div class="card-body pt-2 pb-1">
                    @foreach ($tableLikesUser as $table)
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
                                {!! $tableLikesUser->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {
        function cleanAllClasses() {
            $("#tableAll").removeClass("d-none");
            $("#tableComment").removeClass("d-none");
            $("#tablePremium").removeClass("d-none");
            $("#tableLikes").removeClass("d-none");
            $("#tableRecent").removeClass("d-none");
            $("#tableLikesUser").removeClass("d-none");

            $("#tableAll").removeClass("d-block");
            $("#tableComment").removeClass("d-block");
            $("#tablePremium").removeClass("d-block");
            $("#tableLikes").removeClass("d-block");
            $("#tableRecent").removeClass("d-block");
            $("#tableLikesUser").removeClass("d-block");

            $("#allTables").removeClass("active");
            $("#recentTables").removeClass("active");
            $("#likeTables").removeClass("active");
            $("#commentTables").removeClass("active");
            $("#premiumTables").removeClass("active");
            $("#mylikesTables").removeClass("active");

        }


        $('#allTables').click(function(){
            cleanAllClasses();
            $('#allTables').addClass("active");
            $("#tableAll").addClass("d-block");
            $("#tableComment").addClass("d-none");
            $("#tablePremium").addClass("d-none");
            $("#tableLikes").addClass("d-none");
            $("#tableRecent").addClass("d-none");
            $("#tableLikesUser").addClass("d-none");
        });

        $('#recentTables').click(function(){
            cleanAllClasses();
            $('#recentTables').addClass("active");
            $("#tableAll").addClass("d-none");
            $("#tableComment").addClass("d-none");
            $("#tablePremium").addClass("d-none");
            $("#tableLikes").addClass("d-none");
            $("#tableRecent").addClass("d-block");
            $("#tableLikesUser").addClass("d-none");
        });

        $('#likeTables').click(function(){
            cleanAllClasses();
            $('#likeTables').addClass("active");
            $("#tableAll").addClass("d-none");
            $("#tableComment").addClass("d-none");
            $("#tablePremium").addClass("d-none");
            $("#tableLikes").addClass("d-block");
            $("#tableRecent").addClass("d-none");
            $("#tableLikesUser").addClass("d-none");
        });

        $('#commentTables').click(function(){
            cleanAllClasses();
            $('#commentTables').addClass("active");
            $("#tableAll").addClass("d-none");
            $("#tableComment").addClass("d-block");
            $("#tablePremium").addClass("d-none");
            $("#tableLikes").addClass("d-none");
            $("#tableRecent").addClass("d-none");
            $("#tableLikesUser").addClass("d-none");
        });

        $('#premiumTables').click(function(){
            cleanAllClasses();
            $('#premiumTables').addClass("active");
            $("#tableAll").addClass("d-none");
            $("#tableComment").addClass("d-none");
            $("#tablePremium").addClass("d-block");
            $("#tableLikes").addClass("d-none");
            $("#tableRecent").addClass("d-none");
            $("#tableLikesUser").addClass("d-none");
        });

        $('#mylikesTables').click(function(){
            cleanAllClasses();
            $("#mylikesTables").addClass("active");
            $("#tableAll").addClass("d-none");
            $("#tableComment").addClass("d-none");
            $("#tablePremium").addClass("d-none");
            $("#tableLikes").addClass("d-none");
            $("#tableRecent").addClass("d-none");
            $("#tableLikesUser").addClass("d-block");
        });


    });
</script>
@endsection
