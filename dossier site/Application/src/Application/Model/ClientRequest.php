<?php

namespace Application\Model;

use Zend\Http\Client;

class ClientRequest {
    
    public static function sendRequest($request) {
        $client = new Client();
        $response = $client->send($request); //envoie la requête au service REST
        return $response;
    }
	
	public static function checkStatus($status) {
		//Traitement selon statut
        if($statut >= 200 && $statut <= 299) {
            return substr($response->getBody(), 1);
        }
        else if($statut >= 300) {
            throw new \Exception();
        } 
	}
    
}