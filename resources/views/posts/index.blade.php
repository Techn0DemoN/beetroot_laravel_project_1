@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="dropdown" style="margin-bottom: 15px">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Категория
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/">Все категории</a>
                        @foreach($categories as $category)
                            <a class="dropdown-item" href="{{ route('category_filter', ['id' => $category->id]) }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @foreach ($posts as $post)
                                <div class="container">
                                    <h2><a href="{{route('article_by_id', ['id' => $post->id])}}">{{$post->title}}</a></h2>
                                    <div class="card" >
                                        <div class="row no-gutters">
                                            <div class="col-sm-5">
                                                <img class="card-img" src="{{ asset('storage/' . $post->image) }}" alt="image">
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="card-body">
                                                    <p class="card-text" >{{$post->description}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer w-100 text-muted">
                                        <div class="d-flex justify-content-between">
                                            <div class="p-2">Created by: {{$post->user->name}}</div>
                                            <div class="p-2">
                                                @foreach($post->categories as $category)
                                                    <a href="{{ route('category_filter', ['id' => $category->id]) }}">#{{ $category->name }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <hr />
                       @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $posts->links() }}
    </div>

@endsection
