@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ADMIN PANEL</h1>
@stop


@section('content')
    <p>This zone is only for admin. Here you can see several statistics about the website.</p>

    @section('plugins.Chartjs', true)
    <div class="row justify-content-center">
        <div class="col-xl-6 col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        <h5 class="card-title text-center">
                            Global statistics
                        </h5>
                    </div>
                    <div class="card-body cleartfix">
                        <canvas id="chartCount" style="display:block; width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xl-6 col-md-12">
            <div class="card overflow-hidden">
                <div class="card-content">
                    <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                            <div class="align-self-center">
                                <i class="fas fa-solid fa-table fa-4x mr-3 text-primary"></i>
                            </div>
                            <div class="media-body">
                                <h4>Total Publications</h4>
                                <span>Annual publications on website</span>
                            </div>
                            <div class="align-self-center">
                                <h1>{{ $contTable }}</h1>
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
                                <i class="far fa-comments fa-4x mr-3 text-warning"></i>
                            </div>
                            <div class="media-body">
                                <h4>Total Comments</h4>
                                <span>Annual publication comments</span>
                            </div>
                            <div class="align-self-center">
                                <h1>{{ $contComment }}</h1>
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
                                <i class="far fa-user fa-4x mr-3 text-success"></i>
                            </div>
                            <div class="media-body">
                                <h4>Total Users</h4>
                                <span>Annual users on website</span>
                            </div>
                            <div class="align-self-center">
                                <h1>{{ $contUser }}</h1>
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
                                <i class="far fa-heart fa-4x mr-3 text-danger"></i>
                            </div>
                            <div class="media-body">
                                <h4>Total Likes</h4>
                                <span>Annual likes on website</span>
                            </div>
                            <div class="align-self-center">
                                <h1>{{ $contLike }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
<script>
const labels = [
    'Tables',
    'Comments',
    'Users',
    'Likes'
];
const values = [{{ $contTable }},{{ $contComment }},{{ $contUser }},{{ $contLike }}]
const data = {

    labels: labels,
    datasets: [{
    label: 'Global statistics',
    data: values,
    backgroundColor: [
      'rgb(0, 123, 255)',
      'rgb(255, 193, 7)',
      'rgb(40, 167, 69)',
      'rgb(220, 53, 69)'
    ],
    hoverOffset: 4
  }]
};

const config = {
  type: 'doughnut',
  data: data,
};

const myChart = new Chart(
    document.getElementById('chartCount'),
    config
  );
</script>

@stop
