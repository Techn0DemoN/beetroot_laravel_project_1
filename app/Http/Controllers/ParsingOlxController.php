<?php

namespace App\Http\Controllers;

use App\Modules\ParsingOlx;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ParsingOlxController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $input = '';
        $data = [];

        //Если пришел запрос на поиск - генерируем URL для парсера и получаем от него массив данных
        if (isset($request->search_phrase)) {
            $searchPattern = 'https://www.olx.ua/elektronika/telefony-i-aksesuary/mobilnye-telefony-smartfony/q-';
            $input = preg_replace('/ +/', '-', trim($searchPattern . $request->search_phrase . '/'));

            $parsingOlx = new ParsingOlx($input);

            $data['ParsingData'] = $parsingOlx->getContent();

            //Обрабатываем массив для получения дополнительных данных
            $data = $this->dataManipulation($data);
        }

        return view('olx_parsing', [
            'request' => $request->all(),
            'input' => $input,
            'data' => $data
        ]);
    }

    /**
     * Метод обрабатывает полученный массив данных и добавляет к этому массиву результаты обработки.
     *
     * @param $data
     * @return array
     */
    private function dataManipulation(array $data): array
    {
        //Получаем массив с ценами и чистим его от пустых значений
        $clear = array_diff(array_column($data['ParsingData'], 'Price'), array(''));

        //Сортируемм
        sort($clear);

        //В общий массив добавляем обработанные данные
        $data = array_merge($data, [
            'AveragePrice' => json_encode(ceil(array_sum($clear) / count($clear))),
            'MinPrice' => min($clear),
            'MaxPrice' => max($clear),
            'Prices' => json_encode($clear),
            'Quantity' => json_encode(array_keys($clear))
        ]);

        return $data;
    }
}
