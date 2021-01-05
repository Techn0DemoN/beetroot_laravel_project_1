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
                                    <label for="title_id">Title</label>
                                    <input  class="form-control" type="text" name="title" value="{{old('title')}}" id="title_id">
                                    @error('title')
                                    <span class="invalid" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description_id">Description</label>
                                    <input  class="form-control" type="text" name="description" value="{{old('description')}}" id="description_id">
                                    @error('description')
                                    <span class="invalid" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                <!-- Default dropleft button -->
                                    <div class="btn-group dropleft">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Select categories
                                        </button>
                                        <div class="dropdown-menu">
                                            <!-- Dropdown menu links -->

                                            @foreach($categories as $key=>$category)
                                            <div class="form-check" style="margin: 0 10px 0 10px">
                                                <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="cat{{ $key }}" name="categories[]">
                                                <label class="form-check-label" for="cat{{ $key }}">
                                                    {{ $category->name }}
                                                </label>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>



                                    @error('category')
                                    <span class="invalid" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control" name="content" id="content">{{old('content')}}</textarea>
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
