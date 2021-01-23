<?php
namespace App;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class ParserOLX
{
    private $link = 'https://www.olx.ua/list/q-';
    public function start($queryString){
        $link = $this->link . str_replace(' ','-', $queryString);
        $search = $this->getCrawler($link);
        $bodies = $search->filter('.wrap')->each(function (Crawler $node, $i) {
            return [
                'title'=>$node->filter('.title-cell strong')->text(),
                'price'=>preg_replace("/[^0-9]/", '', $node->filter('.td-price strong')->text())
            ];
        });
        return $bodies;
    }
    private function getCrawler($url)
    {
        $html = file_get_contents($url);
        $crawler = new Crawler(null, $url);
        $crawler->addHtmlContent($html, 'UTF-8');
        return $crawler;
    }

}
