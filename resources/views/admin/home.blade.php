@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ADMIN PANEL</h1>
@stop

@section('content')
    <p>This zone is only for admin. Here you can see several statistics about the website.</p>
    <div class="row">
        <div class="col-xl-6 col-md-12">
            <div class="card overflow-hidden">
                <div class="card-content">
                    <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                            <div class="align-self-center">
                                <i class="fas fa-solid fa-table fa-4x mr-3"></i>
                            </div>
                            <div class="media-body">
                                <h4>Total Publications</h4>
                                <span>Annual publications on website</span>
                            </div>
                            <div class="align-self-center">
                                <h1>18,000</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                            <div class="align-self-center">
                                <i class="far fa-comments fa-4x mr-3"></i>
                            </div>
                            <div class="media-body">
                                <h4>Total Comments</h4>
                                <span>Annual publication comments</span>
                            </div>
                            <div class="align-self-center">
                                <h1>84,695</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-md-12">
            <div class="card overflow-hidden">
                <div class="card-content">
                    <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                            <div class="align-self-center">
                                <i class="far fa-user fa-4x mr-3"></i>
                            </div>
                            <div class="media-body">
                                <h4>Total Users</h4>
                                <span>Annual users on website</span>
                            </div>
                            <div class="align-self-center">
                                <h1>18,000</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                            <div class="align-self-center">
                                <i class="far fa-heart fa-4x mr-3"></i>
                            </div>
                            <div class="media-body">
                                <h4>Total Likes</h4>
                                <span>Annual likes on website</span>
                            </div>
                            <div class="align-self-center">
                                <h1>84,695</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
