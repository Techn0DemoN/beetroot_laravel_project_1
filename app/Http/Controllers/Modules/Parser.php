<?php

namespace App\Http\Controllers\Modules;
use Illuminate\Support\Facades\Config;
use Symfony\Component\DomCrawler\Crawler;
class Parser
{
    //ссылка на сайт
    protected $site = 'https://obyava.ua/ru/nedvizhimost/prodazha-kvartir';

    protected function getCrawler($url)
    {
        $html = file_get_contents($url);
        $crawler = new Crawler(null, $url);
        $crawler->addHtmlContent($html, 'UTF-8');
        return $crawler;
    }

    //получает ссылки на все категории
    public function getCategories()
    {
        $page = $this->getCrawler($this->site);
        $categories = array();
        $page = $page->filter('.link');
        foreach ($page as $item) {
            $categories[] = [
                'name' => trim((preg_replace('%\(\d+\)%', '', $item->textContent))),
                'link' => trim($item->getAttribute('href'), '/'),
            ];
        }
        return $categories;
    }
    //получаем обьявления
    public function getDataInfo($category)
    {
        $page = $this->getCrawler($category);
        $data['title'] = $page->filter('.classified-title')->text();
        $data['price'] = preg_replace('/[^0-9]/', '', $page->filter('.classified-price')->text());
        $data['city'] = $page->filter('.location')->text();
        $data['description'] = $page->filter('.one-line')->text();
        return $data;
    }

    public function getData(){
        $categories = $this->getCategories(); //ссылки на категории
        foreach ($categories as $category) {
            $result = $this->getDataInfo($category['link']);
            echo "<br>";
            echo $category['name'];
            echo "<br>";
            foreach ($result as $key=>$val) {
                echo $key . ' [ ' . $val . ' ] ';
                echo "<br>";
            }
        }
    }
}
