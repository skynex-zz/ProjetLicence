<?php

namespace Application\Model;

use Zend\Http\Client;

class ClientRequest {
    
    public static function sendRequest($request) {
        $client = new Client();
        $response = $client->send($request); //envoie la requ�te au service REST
        return $response;
    }
    
}