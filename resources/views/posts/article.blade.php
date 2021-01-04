<script src="{{ asset('js/likes.js') }}"></script>
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
                            {!! $post->content !!}
                        </p>

                        <div class="row justify-content-center">
                            {!! $post->qr !!}
                        </div>

                            <div class="d-flex justify-content-between">
                                <div class="p-2">
                                    <p>
                                        Created by: {{$post->user_id}}
                                    </p>
                                </div>
                                <div class="one">
                                    <svg id="like" onclick="changeStatus({{$post->id}})" viewBox="0 0 24 24" style="width:21px;vertical-align: middle;margin-right: 5px;" >
                                        <path d="M1 21h4V9H1v12zm22-11c0-1.1-.9-2-2-2h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 1 7.59 7.59C7.22 7.95 7 8.45 7 9v10c0 1.1.9 2 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73v-1.91l-.01-.01L23 10z"></path>
                                    </svg>
                                    <span id="count">
{{--                                        @dd($post)--}}
                                        {{ $post->likes->count() }}
                                    </span>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    var change_like_status_ajax = '{{ route('change_like_status_ajax')}}';
    var csrf = '{{ csrf_token() }}';
</script>
