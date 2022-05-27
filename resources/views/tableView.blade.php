@extends('layouts.app')

@section('page_title')
{{ __('Table') }}
@endsection

@section('content')

<div class="container">
    <script>

        function refresh_likes(id){
            var url = "{{ route('like.reload', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response){
                    $(".likeCount_"+id).html(response);
                },
                complete: function(){
                    setTimeout( refresh_likes(id), 1000);
                }
            });
        }
    </script>
    <div class="row">
        <div class="col-md-8 col-12 mt-4 mb-2">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-center">
                        {{ __('Titulo de la tabla') }}
                    </h5>
                </div>

                <div class="card-body pt-2 pb-1 text-center">
                    <p>
                        {{ $table->description }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12 mt-4 mb-2">
            <div class="row">
                <div class="card h-100 px-0">
                    <div class="card-header w-100">
                        <h5 class="card-title mb-0 text-center">
                            {{ __('User Details') }}
                        </h5>
                    </div>

                    <div class="card-body pt-2 pb-1 text-center justify-content-center">
                        {{-- <h3>{{ $table->user->name }}</h3>
                        <p>{{ $table->user->email }}</p> --}}
                        <div class="m-4">
                            @if($table->user->image)
                                <img src="{{ route('user.avatar',$table->user->image) }}"
                                class="rounded-circle img-fluid" style="width: 100px;" />
                            @else
                                {{-- https://pixabay.com/images/id-3331256/ --}}
                                <img src="{{ asset('img/DefaultUser.png') }}"
                                class="rounded-circle img-fluid" style="width: 100px;" />

                            @endif
                        </div>
                          <h4 class="mb-2">{{ $table->user->name }}</h4>
                          <p class="text-muted mb-2">{{ $table->user->email }}</p>

                          <button type="button" class="btn btn-primary btn-rounded btn-lg mb-2">
                            {{ __("Message now") }}
                          </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card h-100 px-0">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-center">
                            {{ __('Likes') }}
                        </h5>
                    </div>

                    <div class="card-body pt-2 pb-1">

                            <div class="info-box">
                                {{-- Averiguar cuantos likes tiene la tabla y si el usuaria que esta viendo la pagina ha dado o no like --}}
                                {{ $userlike = false; }}
                                @foreach ($table->likes as $like)
                                    @if ($like->user->id == Auth::user()->id)
                                        <?php $userlike = true; ?>
                                    @endif
                                @endforeach

                                @if ($userlike)
                                    <a class="btn-dislike info-box-icon btn bg-danger" data-id="{{ $table->id }}">
                                    <i class="ico{{ $table->id }} fa-solid fa-heart"></i>
                                @else
                                    <a class="btn-like info-box-icon btn bg-danger" data-id="{{ $table->id }}">
                                    <i class="ico{{ $table->id }} fa-regular fa-heart"></i>
                                @endif
                                </a>

                                {{-- <span class="info-box-icon bg-danger"><i class="fa-regular fa-heart"></i></span> --}}
                                <div class="info-box-content">
                                    <span class="info-box-text">Likes</span>
                                    {{-- <span class="">99999</span> --}}
                                    <span class="info-box-number likeCount_{{ $table->id }}"></span>

                                </div>
                                <script>refresh_likes({{ $table->id }});</script>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-2 pe-0">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-center">
                        {{-- {{ __('Tabla de ejercicios') }} --}}
                        {{ $table->name }}
                    </h5>
                </div>
                @php
                    $n = 1;
                @endphp
                <div class="card-body">
                    <table class="table table-bordered">
                        @foreach ($exercises as $i => $exercise)
                            @if ($loop->first)
                                <tr class="text-center bg-light">
                                    <th colspan="3">{{ $exercise->day }} - {{ $exercise->moment }}</th>
                                </tr>
                                <tr>
                                    <th>Ejercicio</th>
                                    <th>Series</th>
                                    <th>Repeticiones</th>
                                </tr>
                            @endif
                            @if($exercises[$i]->day_id != $exercises[$n]->day_id)
                                <tr class="text-center bg-light">
                                    <th colspan="3">{{ $exercise->day }} - {{ $exercise->moment }}</th>
                                </tr>
                                <tr>
                                    <th>Ejercicio</th>
                                    <th>Series</th>
                                    <th>Repeticiones</th>
                                </tr>
                                @php
                                    $n = $i +1;
                                @endphp
                            @else
                                <tr>
                                    <td>{{ $exercise->content }}</td>
                                    <td>{{ $exercise->sets }}</td>
                                    <td>{{ $exercise->reps }}</td>
                                </tr>
                            @endif

                            @if ($loop->last)
                                <tr>
                                    <td>{{ $exercise->content }}</td>
                                    <td>{{ $exercise->sets }}</td>
                                    <td>{{ $exercise->reps }}</td>
                                </tr>
                            @endif

                        @endforeach

                    </table>
                </div>
                <hr>
                <div class="card-body">
                    <form action="{{ route('comment.save') }}" method="post">
                        @csrf

                        <input type="hidden" name="table_id" value="{{ $table->id }}" />
                        <textarea class="form-control" rows="2" {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content"></textarea>

                        <div class="mt-2 clearfix">
                        <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-pencil fa-fw"></i> Share</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-2 pe-0">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-center">
                        {{ __('Comments') }}
                    </h5>
                </div>
                <div class="card-body">

                    @foreach ($table->comments as $comment)
                    <div class="comment-block">
                        <div class="d-flex justify-content-center">
                        <a class="btn fs-2 mx-4 d-flex justify-content-center" href="#">
                            @if($comment->user->image)
                                <img class="comment-profile" alt="Profile image" src="{{ route('user.avatar',$comment->user->image) }}"> - {{ $comment->user->nick }}</a>
                            @else
                                {{ $comment->user->nick }}</a>
                            @endif
                        </div>

                        <div class="comment-body mt-4">

                            <p>{{ $comment->content }}</p>

                            <div class="btn-group">
                                {{-- <a class="btn btn-sm btn-default btn-hover-success" href="#"><i class="fa-solid fa-pen-to-square"></i></a> --}}
                                @if ($comment->user_id == Auth::user()->id || Auth::user()->role == 'admin' || $comment->table->user_id == Auth::user()->id)
                                    <a class="btn btn-sm btn-default btn-hover-danger" href="{{ route('comment.delete',$comment->id); }}"><i class="fa-solid fa-trash-can"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <hr>
                <div class="card-body">
                    <form action="{{ route('comment.save') }}" method="post">
                        @csrf

                        <input type="hidden" name="table_id" value="{{ $table->id }}" />
                        <textarea class="form-control" rows="2" {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content"></textarea>

                        <div class="mt-2 clearfix">
                        <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-pencil fa-fw"></i> Share</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        // Botón de like
        function like(){
            $('.btn-like').unbind('click').click(function(){
                console.log('like');
                $(this).addClass('btn-dislike').removeClass('btn-like');

                var id = $(this).data('id');
                console.log(id);
                var url = "{{ route('like.save', ':table_id') }}";
                    url = url.replace(':table_id', id);

                var classr = ".ico"+id;
                console.log(classr);
                $(classr).addClass('fa-solid').removeClass('fa-regular');
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response){
                        if(response.like){
                            console.log('Has dado like a la tabla');

                            $("#like").load(" #like-"+id);
                        }else{
                            console.log('Error al dar like');
                        }
                    }
                });
                dislike();
            });
        }
        like();

        // Botón de dislike
        function dislike(){
            $('.btn-dislike').unbind('click').click(function(){
                $(this).addClass('btn-like').removeClass('btn-dislike');

                var id = $(this).data('id');
                console.log(id);
                var url = "{{ route('like.delete', ':table_id') }}";
                    url = url.replace(':table_id', id);
                    var classr = ".ico"+id;
                console.log(classr);
                $(classr).addClass('fa-regular').removeClass('fa-solid');
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response){
                        if(response.like){
                            console.log('Has dado dislike a la tabla');
                            $("#like").load(" #like-"+id);
                        }else{
                            console.log('Error al dar dislike');
                        }
                    }
                });

                like();
            });
        }
	    dislike();



    });
</script>

@endsection
