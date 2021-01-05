<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{ asset("/js/like.js") }}" type="text/javascript" charset="utf-8"></script>


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
                             {!!$post->content!!}
                            </p>
                            <p>{!!$post->qr_code!!}</p>
                            <p>
                            Created by: {{$post->user->name}}
                            </p>
                            <div class="justify-content-end">
                                 <span id="likes-count">
                                     {{ $post->like->count() }}
                                    </span>
                                <a href="#" id="btn-like" onclick="likePost({{$post->id}})" class="btn btn-success">
                                    <span class="glyphicon glyphicon-thumbs-up"></span>
                                </a>
                            </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
<script>
    var actionLike = '{{ route('actionLike')}}';
    var csrf = '{{ csrf_token() }}';
</script>



