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
                            Created by: {{$post->user_id}}
                        </p>

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
