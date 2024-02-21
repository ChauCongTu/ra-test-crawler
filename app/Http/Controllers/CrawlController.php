<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CrawlController extends Controller
{
    //
    public function lotsView()
    {
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
        $response = Http::get('https://dantri.com.vn/giao-duc/vu-lo-de-thi-sinh-8-thi-sinh-duoc-mom-de-can-xu-ly-the-nao-20230620004656478.htm');
        $dom = new \DOMDocument();
        // dd($response);
        @$dom->loadHTML(mb_convert_encoding((string) $response->body(), 'HTML-ENTITIES',  'UTF-8'));
        $xpath = new \DOMXPath($dom);
        $images_query = $xpath->query('.//article[contains(@class, "article-related")] //article[contains(@class, "article-item") //div[contains(@class, "article-thumb") //a //img');
        $urls = $xpath->query('.//article[contains(@class, "article-related")] //article[contains(@class, "article-item") //div[contains(@class, "article-thumb") //a');
        $titles = $xpath->query('.//article[contains(@class, "article-related")] //article[contains(@class, "article-item") //div[contains(@class, "article-content") //h3[contains(@class, "article-title") //a');
        $descs = $xpath->query('.//article[contains(@class, "article-related")] //article[contains(@class, "article-item") //div[contains(@class, "article-content") //div[contains(@class, "article-excerpt") //a');
        $data = [];
        foreach ($images_query as $key => $image) {
            $data[] = [
                'thumbnail_image' => $image->getAttribute("data-src"),
                'url' => $urls[$key] ? $urls[$key]->getAttribute("href") : '',
                'title' => $titles[$key] ? $titles[$key]->textContent : '',
                'description' => $descs[$key] ? $descs[$key]->textContent : '',
            ];
        }

        // dd($data);
        return json_encode($data);
    }
    public function care(){

    }
}
