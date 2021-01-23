@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{route('startParserOLX')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input  class="form-control" type="text" name="title">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
        <div id="divChart">
            <canvas id="myChart"></canvas>
        </div>
        <p>{{ json_encode($chart['chartData']) }}</p>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Price</th>
            </tr>
            </thead>
            <tbody>
                @if(isset($bodies))
                     @foreach($bodies as $key=>$body)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$body['title']}}</td>
                            <td>{{$body['price']}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    @if(isset($chart))
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script>
        var chartData = JSON.parse("{{$chart['chartData']}}");
        console.log(chartData);
        var chartLabels = ['10-100', '100-1000', '1000-10000', '10000-100000'];
    </script>
    <script src="{{asset('js/my.js')}}"></script>
    @endif
@endsection

