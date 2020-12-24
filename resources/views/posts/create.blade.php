<script src="{{ asset('/js/ckeditor/ckeditor.js') }}"
        type="text/javascript" charset="utf-8" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
                                    <label for="file">Image</label>
                                    <input  class="form-control" type="file" name="file" value="{{old('file')}}">
                                    @error('file')
                                    <span class="invalid" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input  class="form-control" type="text" name="title" value="{{old('title')}}">
                                    @error('title')
                                    <span class="invalid" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input  class="form-control" type="text" name="description" value="{{old('description')}}">
                                    @error('description')
                                    <span class="invalid" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control" name="content" id="editor1">{{old('content')}}</textarea>
                                    @error('content')
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
    <script>
        $(document).ready(function () {
            CKEDITOR.replace( 'editor1',{
                filebrowserBrowseUrl : '/elfinder/ckeditor'
            } );
        });
    </script>
@endsection

