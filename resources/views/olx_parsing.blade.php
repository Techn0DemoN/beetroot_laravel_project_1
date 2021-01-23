@extends('layouts.app')

@section('content')
    <div class="mt-2 ml-5 mr-5">

        <form method="POST" action="{{ route('parsing_olx') }}">
            @csrf
            <div class="form-group">
                <label for="search">Search phrase</label>
                <input type="text" class="form-control" name="search_phrase" id="search" placeholder="Search ...">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>

    @if (!empty($data))

        <div class="mt-2 ml-5 mr-5">
            Url: {{ $input }}
        </div>

        <div class="mt-2 ml-5 mr-5">
            AveragePrice: {{ $data['AveragePrice'] }} грн.
        </div>

        <div class="mt-2 ml-5 mr-5">
            MaxPrice: {{ $data['MaxPrice'] }} грн.
        </div>

        <div class="mt-2 ml-5 mr-5">
            MinPrice: {{ $data['MinPrice'] }} грн.
        </div>

        <div class="row justify-content-md-center">
            <div class="col-sm-6 ">
                <div id="divChart" class="mt-2 ml-5 mr-5">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>


        <div class="mt-2 ml-5 mr-5">
            <table class="table text-center">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Заголовок</th>
                    <th scope="col">Цена</th>
                </tr>
                </thead>
                <tbody>

                @foreach($data['ParsingData'] as $key => $ads)
                    <tr>
                        <th scope="row">{{ $key }}</th>
                        <td>{{ $ads['Title'] }}</td>
                        <td>{{ $ads['Price'] }} </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        <script>
            let prices = JSON.parse({!! json_encode($data['Prices'])!!});
            let chartLabels = JSON.parse({!! json_encode($data['Quantity'])!!});
        </script>
        <script src="{{asset('js/olxParser.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    @endif
@endsection







