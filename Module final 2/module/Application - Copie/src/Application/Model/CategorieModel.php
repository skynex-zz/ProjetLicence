<?php

namespace Application\Model;

use Zend\Http\Request;
use Zend\Http\Client;
use Zend\Stdlib\Parameters;

class CategorieModel {
    
    /**
     * Appel web service pour récupérer toutes les catégories
     * @return array
     */
    public function fetchAll() 
    {
        $request = new Request();
        //ajoute des headers et modifie la requête
        $request->getHeaders()->addHeaders(array(
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'
        ));
        $request->setUri('http://localhost/rest/web/index.php/categories'); //URL du webservice en dehors du projet 
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