<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

@extends('layouts.app')
@section('content')
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- search form--}}
                @csrf
                <form action="{{route('liveSearchResult')}}" method="get" autocomplete="off">
                    <div class="input-group">
                        <input type="text" class="form-control" id="search" name="search" placeholder="Поиск" style="color: grey">
                            <button type="submit" value="" class="btn btn-flat" style="background-color: powderblue"><i class="fa fa-search"></i></button>
                    </div>
                </form>
                {{-- end search form--}}
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    {{--var csrf = '{{ csrf_token() }}';--}}
    var route = "{{ url('searchAutocomplete')}}";
    $('#search').typeahead({
    source: function(term, process){
        return $.get(route, {term: term}, function(data){
            return process(data);
        });
    }
});

</script>

