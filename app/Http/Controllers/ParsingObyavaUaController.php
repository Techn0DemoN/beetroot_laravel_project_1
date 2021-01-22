<?php

namespace App\Http\Controllers;

use App\Modules\Parsing;
use Illuminate\Http\Request;

class ParsingObyavaUaController extends Controller
{
    public function index(Request $request)
    {
        $ads = $request->category ?? '';

        $data = new Parsing('https://obyava.ua/ru/nedvizhimost/prodazha-kvartir', $ads);

        return view('parsing', [
            'result' => $data->getContent(),
            'ads' => $ads
        ]);
    }
}
