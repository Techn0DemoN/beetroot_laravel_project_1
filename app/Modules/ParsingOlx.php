<?php

namespace App\Modules;

use Symfony\Component\DomCrawler\Crawler;

class ParsingOlx
{
    private $link; //Ссылка на ресурс

    /**
     * Parsing constructor.
     * @param $link
     */
    public function __construct($link)
    {
        $this->link = $link;
    }

    /**
     * Получаем данные из ссылки которая была указана при инициализации класса
     *
     * @return array
     */
    public function getContent()
    {
        $crawler = $this->instanceForParser($this->link);

        $data = [];

        $crawler->filter('.wrap')->each(function (Crawler $crawler, $key) use (&$data) {
             $data[++$key] = [
                 'Title' => $crawler->filter('.marginright5')->text(),
                 'Price' => trim((preg_replace('%[\D]%', '', $crawler->filter('.price')->text())))
             ];
        });

        return $data;
    }

    /**
     * @param $url
     * @return Crawler
     */
    protected function instanceForParser($url): Crawler
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $html = curl_exec($ch);
        curl_close($ch);

        $crawler = new Crawler(null, $url);
        $crawler->addHtmlContent($html, 'UTF-8');

        return $crawler;
    }
}
