<?php

namespace Application\Model;

use Zend\Http\Request;
use Zend\Http\Client;
use Zend\Stdlib\Parameters;

class PublicationModel {
    
    /**
     * Appel web service pour r�cup�rer toutes les rubriques
     * @return array
     */
    public function fetchAll() 
    {
        $request = new Request();
        //ajoute des headers et modifie la requ�te
        $request->getHeaders()->addHeaders(array(
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'
        ));
        $request->setUri('http://localhost/rest/web/index.php/publications'); //URL du webservice en dehors du projet 
        $request->setMethod('GET');
        //$request->setPost(new Parameters(array('someparam' => 'salut')));
        
        $client = new Client();
        $response = $client->send($request); //envoie la requ�te au service REST
        $statut = $response->getStatusCode();
        
        //Traitement selon statut
        if($statut >= 200 && $statut <= 299) {
            return json_decode($response->getBody(), true);
        }
        else if($statut >= 300) {
            throw new \Exception();
        }
    }
    
    public function fetchAllByDate() 
    {
        $request = new Request();
        //ajoute des headers et modifie la requête
        $request->getHeaders()->addHeaders(array(
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'
        ));
        $request->setUri('http://localhost/rest/web/index.php/publications/date'); //URL du webservice en dehors du projet 
        $request->setMethod('GET');
        //$request->setPost(new Parameters(array('someparam' => 'salut')));
        
        $client = new Client();
        $response = $client->send($request); //envoie la requête au service REST
        $statut = $response->getStatusCode();
        
        //Traitement selon statut
        if($statut >= 200 && $statut <= 299) {
            return json_decode($response->getBody(), true);
        }
        else if($statut >= 300) {
            throw new \Exception();
        }
    }
    
    public function findOne($token, $idPublication) 
    {
        $request = new Request();
        //ajoute des headers et modifie la requ�te
        $request->getHeaders()->addHeaders(array(
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'
        ));
        $request->setUri('http://localhost/rest/web/index.php/admin/publications/'.$idPublication); //URL du webservice en dehors du projet 
        $request->setMethod('GET');
        $request->setContent(json_encode(array('a' => $token)));
        
        $client = new Client();
        $response = $client->send($request); //envoie la requ�te au service REST
        $statut = $response->getStatusCode();
        
        //Traitement selon statut
        if($statut >= 200 && $statut <= 299) {
            return json_decode($response->getBody(), true);
        }
        else if($statut >= 300) {
            //throw new \Exception();
            var_dump($response);
        }
    }
}

?>