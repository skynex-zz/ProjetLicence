<?php

namespace Application\Model;

use Zend\Http\Request;
use Zend\Http\Client;
use Zend\Stdlib\Parameters;

class RubriqueModel {
    
    /**
     * Appel web service pour récupérer toutes les rubriques
     * @return array
     */
    public function fetchAll() 
    {
        $request = new Request();
        //ajoute des headers et modifie la requête
        $request->getHeaders()->addHeaders(array(
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'
        ));
        $request->setUri('http://localhost/rest/web/index.php/rubriques'); //URL du webservice en dehors du projet 
        $request->setMethod('GET');
        //$request->setPost(new Parameters(array('someparam' => 'salut')));
        
        $client = new Client();
        $response = $client->send($request); //envoie la requête au service REST        
        $statut = $response->getStatusCode(); //récupération du statut de la Response

        //Traitement selon statut
        if($statut >= 200 && $statut <= 299) {
            return json_decode($response->getBody(), true);
        }
        else if($statut >= 300) {
            throw new \Exception();
        }
    }
    
    /**
     * Appel web service pour récupérer une rubrique
     * @return array
     */
    public function findOne($idMenu) 
    {
        $request = new Request();
        //ajoute des headers et modifie la requête
        $request->getHeaders()->addHeaders(array(
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'
        ));
        $request->setUri('http://localhost/rest/web/index.php/rubriques/'.$idMenu.''); //URL du webservice en dehors du projet Zend 
        $request->setMethod('GET');
        //$request->setPost(new Parameters(array('someparam' => 'salut')));
        
        $client = new Client();
        $response = $client->send($request); //envoie la requête au service REST
        $statut = $response->getStatusCode(); //récupération du statut de la Response
        
        //Traitement selon statut
        if($statut >= 200 && $statut <= 299) {
            return json_decode($response->getBody(), true);
        }
        else if($statut >= 300) {
            throw new \Exception();
        }
        
    }
}

?>