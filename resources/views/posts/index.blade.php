
@extends('layouts.app')

@section('content')
    <style>
        .search{
            position:relative;
        }
        .search_result{
            background: #FFF;
            border: 1px #ccc solid;
            width: 100px;
            border-radius: 4px;
            max-height:100px;
            overflow-y:scroll;
            display:none;
        }
        .search_result li{
            list-style: none;
            padding: 5px 10px;
            margin: 0 0 0 -40px;
            color: #0896D3;
            border-bottom: 1px #ccc solid;
            cursor: pointer;
            transition:0.3s;
        }
        .search_result li:hover{
            background: #F9FF00;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <input type="text" name="referal" placeholder="Живой поиск" value="" class="who"  autocomplete="off">
                <ul class="search_result"></ul>
                <div>
                    @foreach($categories as $category)
                        <a href="{{route('posts_by_category', ['category'=>$category->id])}}">{{$category->name}}</a>
                    @endforeach
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
                                        Created by: {{$post->user->name}}
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
{{--<script>--}}
{{--    var search_article = '{{ route('search_article')}}';--}}
{{--    var csrf = '{{ csrf_token() }}';--}}
{{--</script>--}}
