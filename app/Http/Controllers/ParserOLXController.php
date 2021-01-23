<?php

namespace App\Http\Controllers;

use App\ParserOLX;
use Illuminate\Http\Request;

class ParserOLXController extends Controller
{
    public function index(){
        return view('parser.parserOLX');
    }
    public function start(Request $request){
        $searchString = $request->title;
        $parserObj = new ParserOLX();
        return view('parser.parserOLX', [
            'bodies'=>$parserObj->start($searchString),
            'chart'=>$this->prepareChartData('')
        ]);
    }
    private function prepareChartData($rawdata){
        $chartData = [
            [
                'label'=> 'iPhone 10',
                'backgroundColor'=> 'rgba(255, 99, 132, 0.7)',
                'borderColor'=> 'rgb(255, 99, 132)',
                'data'=> [0, 7, 2, 1]
            ],
            [
                'label'=> 'Huawei P30Pro',
                'backgroundColor'=> 'rgba(100, 99, 132, 0.7)',
                'borderColor'=> 'rgb(100, 99, 132)',
                'data'=> [0, 10, 5, 2]
            ]
        ];

        $chartLabels = ['10-100', '100-1000', '1000-10000', '10000-100000'];
        return ['chartData'=>json_encode($chartData), 'chartLabels'=>json_encode($chartLabels)];
    }
}
