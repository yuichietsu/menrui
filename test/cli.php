<?php
namespace Menrui;

require_once __DIR__ . '/../vendor/autoload.php';

$b = new Bootstrap();
$b->flow = new Job\PrintR([
    new Job\UserFunction([
        new Job\Parameter(['function' => function ($data) {
            $ret = [];
            foreach ($data as $nodes) {
                for ($i = 0, $n = count($nodes); $i < $n && $i < 3; $i++) {
                    $ret[] = (string)$nodes[$i];
                }
            }
            return $ret;
        }]),
        new Job\Xml([
            new Job\Parameter(['xpath' => '/rss/channel/item/title']),
            new Job\Http([
                new Job\Parameter(['url' => 'https://news.yahoo.co.jp/rss/categories/domestic.xml']),
                new Job\Parameter(['url' => 'https://news.yahoo.co.jp/rss/categories/world.xml']),
                new Job\Parameter(['url' => 'https://news.yahoo.co.jp/rss/categories/business.xml']),
            ]),
        ]),
    ]),
]);
$b->run();
