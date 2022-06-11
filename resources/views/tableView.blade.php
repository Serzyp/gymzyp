@php
    use Carbon\Carbon;
@endphp

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
                        {{ $table->name }}
                    </h5>
                </div>

                <div class="card-body pt-2 pb-1 text-center">
                    <div class="imageExercises">
                        <img src="{{ route('table.image',['filename' => $table->image_path]) }}" class="img-thumbnail rounded-end p-2 card-img-top imagenTableBackground" alt="...">
                    </div>
                    <p>
                        {!! $table->description !!}
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
                                class="rounded-circle img-fluid" style="width: 100px;  height: 100px;" />
                            @else
                                {{-- https://pixabay.com/images/id-3331256/ --}}
                                <img src="{{ asset('img/DefaultUserV2.jpg') }}"
                                class="rounded-circle img-fluid" style="width: 100px; height: 100px;" />

                            @endif
                        </div>
                          <h4 class="mb-2">{{ $table->user->name }}</h4>
                          <p class="text-muted mb-2">{{ $table->user->email }}</p>

                          <a class="btn btn-primary btn-rounded btn-lg mb-2" href='mailto:{{ $table->user->email }}'>
                            {{ __("Message") }}
                          </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card h-100 px-0 mt-2">
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
                    <h5 class="card-title text-center mb-0">
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
                                    <th>{{ __("Exercise") }}</th>
                                    <th>{{ __("Sets") }}</th>
                                    <th>{{ __("Reps") }}</th>
                                </tr>
                                <tr>
                                    <td>{{ $exercise->content }}</td>
                                    <td>{{ $exercise->sets }}</td>
                                    <td>{{ $exercise->reps }}</td>
                                </tr>
                                @php
                                    $n = $i;
                                @endphp
                            @else
                                @if($exercises[$i]->day_id != $exercises[$n]->day_id)
                                    <tr class="text-center bg-light">
                                        <th colspan="3">{{ $exercise->day }} - {{ $exercise->moment }}</th>
                                    </tr>
                                    <tr>
                                        <th>{{ __("Exercise") }}</th>
                                        <th>{{ __("Sets") }}</th>
                                        <th>{{ __("Reps") }}</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $exercise->content }}</td>
                                        <td>{{ $exercise->sets }}</td>
                                        <td>{{ $exercise->reps }}</td>
                                    </tr>
                                    @php
                                        $n = $i;
                                    @endphp
                                @else
                                    <tr>
                                        <td>{{ $exercise->content }}</td>
                                        <td>{{ $exercise->sets }}</td>
                                        <td>{{ $exercise->reps }}</td>
                                    </tr>
                                @endif
                                {{-- @if ($loop->last)
                                    <tr>
                                        <td>{{ $exercise->content }}</td>
                                        <td>{{ $exercise->sets }}</td>
                                        <td>{{ $exercise->reps }}</td>
                                    </tr>
                                @endif --}}
                            @endif
                        @endforeach

                    </table>
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

                        <div class="d-flex mt-4">
                            <div class="flex-shrink-0">
                                @if($comment->user->image)
                                    <img src="{{ route('user.avatar',$comment->user->image) }}" class="rounded-circle" alt="Sample Image" style="width: 60px; height: 60px; border: 1px solid grey;">
                                @else
                                    <img src="{{ asset('img/DefaultUserV2.jpg') }}" class="rounded-circle" alt="Sample Image" style="width: 60px; height: 60px; border: 1px solid grey;">
                                @endif

                            </div>
                            <div class="flex-grow-1 ms-3">
                                @if($comment->user->nick)
                                    <h5>{{ $comment->user->nick }}
                                @else
                                    <h5>{{ $comment->user->name }}
                                @endif
                                    <small class="text-muted">
                                        <i>{{ __('Posted on ') }}{{  Carbon::parse($comment->created_at)->formatLocalized('%d-%m-%Y'); }}</i>
                                    </small>
                                    @if ($comment->user_id == Auth::user()->id || Auth::user()->role == 'admin' || $comment->table->user_id == Auth::user()->id)
                                        <a class="btn-delete" href="{{ route('comment.delete',$comment->id); }}"><i class="fa-solid fa-trash-can"></i></a>
                                    @endif
                                </h5>
                                <p>{{ $comment->content }}</p>
                            </div>
                        </div>
                        @if(!$loop->last)
                            <hr>
                        @endif

                    @endforeach
                </div>
                <hr>
                <div class="card-body">
                    <form action="{{ route('comment.save') }}" method="post">
                        @csrf

                        <input type="hidden" name="table_id" value="{{ $table->id }}" />
                        <textarea class="form-control" rows="2" {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content"></textarea>

                        <div class="mt-2 clearfix">
                        <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-pencil fa-fw"></i> {{ __('Share') }}</button>
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
