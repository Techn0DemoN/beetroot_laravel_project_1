<?php

namespace App\Modules;

use Symfony\Component\DomCrawler\Crawler;

class Parsing
{
    private $link; //Ссылка на ресурс

    /**
     * При записи 'all' будет находить данные по всех вложенных URL.
     * Если записать ключ, то будет находить данные только по URL который лежит в массиве по этому ключу.
     *
     * @var mixed
     */
    private $ads;


    /**
     * Parsing constructor.
     * @param $link
     * @param mixed $ads
     */
    public function __construct($link, $ads = false)
    {
        $this->link = $link;
        (!$ads) ?: $this->ads = $ads;
    }

    /**
     *
     * Возвращает массив с данными в котором находятся массивы вида ['Name' => Value, 'URL' => Url [,'Data' = []]].
     *
     * @return array
     */
    public function getContent(): array
    {
        $crawler = $this->instanceForParser($this->link);

        $data = [];

        //Находит все ссылки на категории и помещает их в массив
        $crawler->filter('.link')->each(function (Crawler $crawler, $key) use (&$data) {
            $data[++$key] = [
                'Name' => trim((preg_replace('%\(\d+\)%', '', $crawler->text()))),
                'URL' => $crawler->link()->getUri()
            ];
        });

        //Если при инициализации был указан второй аргумент - добавляем данные по нужной категории
        (!isset($this->ads)) ?: $data = $this->addLinksData($data, $this->ads);

        return $data;
    }


    /**
     *
     * Возвращает массив, в котором каждый вложенный массив получает новый ключ 'data', с данными каждого объявления.
     *
     * @param array $data
     * @param string $ads
     * @return array
     */
    private function addLinksData(array $data, $ads): array
    {
        //Если $ads не равно 'all' - то оно будет ключем массива для которого будем собирать $data.
        if ($ads !== 'all') {
            $crawler = $this->instanceForParser($data[$ads]['URL']);
            $data = $this->getDataFromCategory($crawler, $ads, $data);
            return $data;
        }

        //Если $ads равно 'all' - то $data будет собиратся для всех URL во вложенных массивах.
        foreach ($data as $key => $item) {
            $crawler = $this->instanceForParser($item['URL']);
            $data = $this->getDataFromCategory($crawler, $key, $data);
        }

        return $data;
    }

    /**
     * @param $url
     * @return Crawler
     */
    protected function instanceForParser($url): Crawler
    {
        $html = file_get_contents($url);

        $crawler = new Crawler(null, $url);
        $crawler->addHtmlContent($html, 'UTF-8');

        return $crawler;
    }

    /**
     * @param Crawler $crawler
     * @param string $key
     * @param array $data
     * @return array
     */
    private function getDataFromCategory(Crawler $crawler, string $key, array $data): array
    {
        $crawler->filter('.info-block')->each(function (Crawler $crawler) use ($key, &$data) {
            $data[$key]['Data'][] = [
                'Title' => $crawler->filter('.classified-title')->text(),
                'Price' => preg_replace('/[^0-9]/', '', $crawler->filter('.classified-price')->text()),
                'Location' => $crawler->filter('.location')->text(),
                'Description' => $crawler->filter('.one-line')->text()
            ];
        });
        return $data;
    }
}
