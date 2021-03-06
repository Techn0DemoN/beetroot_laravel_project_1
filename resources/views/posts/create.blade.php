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
                                    <input  class="form-control" type="text" name="title" value="{{old('title')}}">
                                    @error('title')
                                    <span class="invalid" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <input  class="form-control" type="text" name="description" value="{{old('description')}}">
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
                                    <label for="exampleFormControlFile1">Picture</label>
                                    <input type="file" class="form-control-file pb-2" name="image" id="exampleFormControlFile1">
                                    @error('image')
                                    <span class="invalid" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>

                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
