@extends('layouts.app')

@section('content')
    <div class="mt-2 ml-5 mr-5">
        <form method="POST" action="{{ route('parisng_obyava') }}">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlSelect1">Chose category</label>
                <select class="form-control" id="exampleFormControlSelect1" name="category">
                    <option value="all">Show all category</option>

                    @foreach($result as $key => $category)
                        <option value="{{ $key }}">{{ $category['Name'] }}</option>
                    @endforeach

                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    @if (strlen($ads))
        <div class="mt-2 ml-5 mr-5">
            <table class="table text-center">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Заголовок</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Город</th>
                    <th scope="col">Описание</th>
                </tr>
                </thead>
                <tbody>

                @foreach($result as $category)
                    @if(isset($category['Data']))
                        <tr class="bg-primary">
                            <th colspan="5">{{ $category['Name'] }}</th>
                        </tr>

                        @foreach($category['Data'] as $key => $ads)
                            <tr>
                                <th scope="row">{{ ++$key }}</th>
                                <td>{{ $ads['Title'] }}</td>
                                <td>{{ $ads['Price'] }} грн.</td>
                                <td>{{ $ads['Location'] }}</td>
                                <td>{{ $ads['Description'] }}</td>
                            </tr>
                        @endforeach

                    @endif
                @endforeach

                </tbody>
            </table>
        </div>
    @endif
@endsection
