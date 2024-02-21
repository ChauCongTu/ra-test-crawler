<?php

namespace App\Scraper;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class TGDD
{

    public function scrape()
    {
        $url = 'https://www.thegioididong.com/dtdd';

        $client = new Client();

        $data = array();

        $crawler = $client->request('GET', $url);
        $crawler->filter('ul.listproduct li.item a.main-contain')->each(
            function (Crawler $node) {
                // Kiểm tra xem có node <h3> trong node <a> hay không
                $h3Node = $node->filter('h3');

                if ($h3Node->count() > 0) {
                    // Truy cập <h3> chỉ khi có ít nhất một node <h3> được tìm thấy
                    $name = $h3Node->text();
                    $data[] = [
                        'name' => $name
                    ];
                } else {
                    // Xử lý khi không tìm thấy node <h3>
                    echo "Không tìm thấy node <h3>.";
                }
            }
        );
    }
}
