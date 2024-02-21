<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class CrawlController extends Controller
{
    //
    public function lotsView()
    {
        $url = 'https://dantri.com.vn/giao-duc/vu-lo-de-thi-sinh-8-thi-sinh-duoc-mom-de-can-xu-ly-the-nao-20230620004656478.htm';

        $client = new Client();

        $data = array();

        $crawler = $client->request('GET', $url);
        $crawler->filter('article.article-lot article.article-item')->each(
            function (Crawler $node) use (&$data) {
                $nameNode = $node->filter('h3.article-title a');
                $name = $nameNode->text();
                $urlNode = $node->filter('h3.article-title a');
                $url = $urlNode->getUri();
                $thumbNode = $node->filter('div.article-thumb a img');
                $thumb = $thumbNode->attr('data-src');

                $item = [
                    'name' => $name,
                    'url' => $url,
                    'thumbnail_image' => $thumb,
                ];
                $data[] = $item;
            }
        );
        dd($data);


        $response = Http::get('https://dantri.com.vn/giao-duc/vu-lo-de-thi-sinh-8-thi-sinh-duoc-mom-de-can-xu-ly-the-nao-20230620004656478.htm');
        $dom = new \DOMDocument();
        // dd($response);
        @$dom->loadHTML(mb_convert_encoding((string) $response->body(), 'HTML-ENTITIES',  'UTF-8'));
        $xpath = new \DOMXPath($dom);
        $images_query = $xpath->query('.//article[contains(@class, "article-lot")] //article[contains(@class, "article-item") //div[contains(@class, "article-thumb") //a //img');
        $urls = $xpath->query('.//article[contains(@class, "article-lot")] //article[contains(@class, "article-item") //div[contains(@class, "article-thumb") //a');
        $titles = $xpath->query('.//article[contains(@class, "article-lot")] //article[contains(@class, "article-item") //h3[contains(@class, "article-title") //a');
        $data = [];
        foreach ($images_query as $key => $image) {
            $data[] = [
                'thumbnail_image' => $image->getAttribute("data-src"),
                'url' => $urls[$key] ? $urls[$key]->getAttribute("href") : '',
                'title' => $titles[$key] ? $titles[$key]->textContent : '',
            ];
        }

        // dd($data);
        return json_encode($data);
    }
    public function related()
    {
        $url = 'https://dantri.com.vn/giao-duc/vu-lo-de-thi-sinh-8-thi-sinh-duoc-mom-de-can-xu-ly-the-nao-20230620004656478.htm';

        $client = new Client();

        $data = array();

        $crawler = $client->request('GET', $url);
        $crawler->filter('aside.article-related article.article-item')->each(
            function (Crawler $node) use (&$data) {
                $nameNode = $node->filter('div.article-content h3.article-title a');
                $name = $nameNode->text();
                $descNode = $node->filter('div.article-content div.article-excerpt a');
                $desc = $descNode->text();
                $urlNode = $node->filter('div.article-content h3.article-title a');
                $url = $urlNode->getUri();
                $thumbNode = $node->filter('div.article-thumb a img');
                $thumb = $thumbNode->attr('data-src');

                $item = [
                    'name' => $name,
                    'url' => $url,
                    'description' => $desc,
                    'thumbnail_image' => $thumb,
                ];
                $data[] = $item;
            }
        );
        dd($data);
    }


    public function care()
    {
        $url = 'https://dantri.com.vn/giao-duc/vu-lo-de-thi-sinh-8-thi-sinh-duoc-mom-de-can-xu-ly-the-nao-20230620004656478.htm';

        $client = new Client();

        $data = array();

        $crawler = $client->request('GET', $url);
        $crawler->filter('div.article-care article.article-item')->each(
            function (Crawler $node) use (&$data) {
                $nameNode = $node->filter('div.article-content h3.article-title a');
                $name = $nameNode->text();
                $descNode = $node->filter('div.article-content div.article-excerpt a');
                $desc = $descNode->text();
                $urlNode = $node->filter('div.article-content h3.article-title a');
                $url = $urlNode->getUri();
                $thumbNode = $node->filter('div.article-thumb a img');
                $thumb = $thumbNode->attr('data-src');

                $item = [
                    'name' => $name,
                    'url' => $url,
                    'description' => $desc,
                    'thumbnail_image' => $thumb,
                ];
                $data[] = $item;
            }
        );
        dd($data);
    }
}
