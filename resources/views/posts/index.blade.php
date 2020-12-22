@extends('layouts.app')

@section('content')
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
