@extends('layouts.app')

@section('page_title')
{{ __('Table') }}
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
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Clark</td>
                                <td>Kent</td>
                                <td>clarkkent@mail.com</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Peter</td>
                                <td>Parker</td>
                                <td>peterparker@mail.com</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>John</td>
                                <td>Carter</td>
                                <td>johncarter@mail.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
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
                                @if ($comment->user_id == Auth::user()->id || Auth::user()->role == 'admin')
                                    <a class="btn btn-sm btn-default btn-hover-danger" href="#"><i class="fa-solid fa-trash-can"></i></a>
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
                        @if($errors->has('content'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                        <div class="mt-2 clearfix">
                        <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-pencil fa-fw"></i> Share</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
