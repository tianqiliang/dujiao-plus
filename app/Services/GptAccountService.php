<?php

namespace App\Services;

use GuzzleHttp\Client;

class GptAccountService
{
    private $session_url = 'https://chatgpt-node-mirror.q2g.one/getsession';

    public function getAccountSession($email, $password){
        $client = new Client([

            'base_uri' => $this->session_url,
            'timeout' => 2.0, //超时时间2秒
        ]);
        $promise = $client->requestAsync('GET', 'http://httpbin.org/get');
        $promise->then(
            function (ResponseInterface $res) {
                echo $res->getStatusCode() . "\n";
            },
            function (RequestException $e) {
                echo $e->getMessage() . "\n";
                echo $e->getRequest()->getMethod();
            }
        )->wait();
    }

}
