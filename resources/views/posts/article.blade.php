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

                        <h3>{{$post->title}}</h3>
                        <hr>
                        <p>
                            {{$post->content}}
                        </p>

                        <p>
                            <img src="{{ asset('storage/' . $post->image) }}" width="120px" height="160px"/>
                        </p>
                        <p>
                            Created by: {{$post->user->name}}
                        </p>
                            {{$like}}
                            @if(Auth::check())
                        <form action="{{route('like', [ $post->id ])}}" method="post">
                            @csrf
                            <input type="image" name="image" src="https://img.icons8.com/material/48/000000/facebook-like--v1.png">
                        </form>
                                @endif

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <p>
                    {{$pageQR}}
                </p>
            </div>
        </div>
    </div>
@endsection
