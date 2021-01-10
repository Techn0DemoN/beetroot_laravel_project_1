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
                        <form action="{{route('add_post')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input class="form-control" type="text" name="title" value="{{old('title')}}">
                                @error('title')
                                <span class="invalid" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <input class="form-control" type="text" name="description"
                                       value="{{old('description')}}">
                                @error('description')
                                <span class="invalid" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Content</label>
                                <textarea class="form-control" name="content">{{old('content')}}</textarea>
                                @error('content')
                                <span class="invalid" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                @foreach($categories as $category)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="category"
                                               name="categories[]"
                                               value="{{$category->id}}">
                                        <label class="form-check-label" for="category">{{$category->title}}</label>
                                    </div>
                                @endforeach   
                            </div>
                            <div class="form-group">
                                <input name="image" type="file" class="btn btn-outline-success">
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
