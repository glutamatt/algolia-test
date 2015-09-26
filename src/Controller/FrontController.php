<?php

namespace AlgoliaTest\Controller;

use AlgoliaSearch\Client;
use AlgoliaTest\Lib\Application;
use AlgoliaTest\Lib\Response;

class FrontController
{
    public function __construct(Application $app)
    {
        $app->get('/', function () {
            return new Response(file_get_contents(__DIR__ . '/../Template/index.html'));
        });

        $app->get('/search', function () use ($app) {
            $client = new Client($app->getConfig('algolia_app_id'), $app->getConfig('algolia_api_key'));
            $index = $client->initIndex("appstore");
            $answer = $index->search($_GET['q']);
            return new Response(json_encode($answer), 200, ['Content-type' => 'application/json']);
        });
    }
}
