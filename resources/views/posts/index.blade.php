@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Categories:</h4>
        @foreach($categories as $category)
            <a class="btn btn-outline-success" href="{{route('category', [ $category->title ])}}">{{$category->title}}</a>
        @endforeach
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="input_weather">Please enter weather</label>
            <input id="input_weather" type="text" class="form-control" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">Use english only</small>
            <a id="my_button" href="#" class="btn btn-primary my-2">Main call to action</a>
        </div>
    </div>
    <div class="col-md-12">
        <div class="weatherCard">
            <div class="currentTemp">
                <span id="weather_temp" class="temp">temp</span>
                <span id="weather_city" class="location">city</span>
            </div>
            <div class="currentWeather">
                <span class="conditions"><img id="weather_img" src=""/></span>
                <div class="info">
                    <span id="weather_wind" class="wind">wind</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @foreach ($posts as $post)
                            <h3><a href="{{route('article_by_id', ['id' => $post->id])}}">{{$post->title}}</a></h3>
                            <p>
                                {{$post->description}}
                            </p>
                            <p>
                                Created by: {{$post->user->name}}
                            </p>
                            <p>
                                <span>Categories:</span>
                                @foreach($post->categories as $value)
                                    <strong><span style="color: red;">{{$value->title}}</span></strong>
                                @endforeach
                            </p>
                            <p>
                                <img src="{{ asset('storage/' . $post->image) }}" width="120px" height="160px"/>

                            </p>

                            <hr>
                    @endforeach
                    <!-- Pagination (5) -->
                        <div class="row">
                            <div class="col-12 text-center">
                                {{$posts->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
