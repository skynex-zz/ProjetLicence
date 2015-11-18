<?php

namespace Application\Model;

use Zend\Http\Request;
use Zend\Http\Client;
use Zend\Stdlib\Parameters;

class AdminModel {
    
    
    /**
     * Appel web service pour connecter ou non l'utilisateur
     * @return array
     */
    public function verifyUser($login, $password) 
    {
        $request = new Request();
        //ajoute des headers et modifie la requête
        $request->getHeaders()->addHeaders(array(
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'
        ));
        $request->setUri('http://localhost/rest/web/index.php/login'); //URL du webservice en dehors du projet 
        $request->setMethod('POST');
        $request->setContent(json_encode(array(
            'username' => $login,
            'password' => $password,
        )));

        $client = new Client();
        $response = $client->send($request); //envoie la requête au service REST
        $token = $response->getBody(); //récupération du token
        
        return $token;
    }
    
    public function modifRubrique($token, $rubrique, $menu) 
    {
        $request = new Request();
        //ajoute des headers et modifie la requête
        $request->getHeaders()->addHeaders(array('Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'));
        $request->setUri('http://localhost/rest/web/index.php/admin/rubriques/'.$menu->id); //URL du webservice en dehors du projet 
        $request->setMethod('PUT');
        $request->setContent(json_encode(array(
            'a' => $token,
            'titre_fr' => $menu->titre_fr,
            'titre_en' => $menu->titre_en,
            'content_fr' => $rubrique->content_fr,
            'content_en' => $rubrique->content_en,
            'actif' => $menu->actif,
            'position' => $menu->position
        )));
        
        $client = new Client();
        $response = $client->send($request); //envoie la requête au service REST
        $data = $response->getBody(); //récupération du token
            
        //return $data;
    }
    
    public function createRubrique($token, $rubrique, $menu) {
        $request = new Request();
        //ajoute des headers et modifie la requête
        $request->getHeaders()->addHeaders(array('Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'));
        $request->setUri('http://localhost/rest/web/index.php/admin/rubrique'); //URL du webservice en dehors du projet 
        $request->setMethod('POST');
        $request->setContent(json_encode(array(
            'a' => $token,
            'ID' => $menu->id,
            'titre_fr' => $menu->titre_fr,
            'titre_en' => $menu->titre_en,
            'content_fr' => $rubrique->content_fr,
            'content_en' => $rubrique->content_en,
            'actif' => $menu->actif,
            'position' => $menu->position,
        )));
        
        $client = new Client();
        $response = $client->send($request); //envoie la requête au service REST
        $data = $response->getBody(); //récupération du token
        
        //return $data;
    }
    
    public function deleteRubrique($token, $idMenu) {
        $request = new Request();
        //ajoute des headers et modifie la requête
        $request->getHeaders()->addHeaders(array('Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'));
        $request->setUri('http://localhost/rest/web/index.php/admin/rubriques/'.$idMenu); //URL du webservice en dehors du projet 
        $request->setMethod('DELETE');
        $request->setContent(json_encode(array('a' => $token)));
        
        $client = new Client();
        $response = $client->send($request); //envoie la requête au service REST
        $data = $response->getBody(); //récupération du token
                
        return $data;
    }
    
    
    
    
    
    
    
    
    
    
    
    public function testToken($token) 
    {
        $request = new Request();
        //ajoute des headers et modifie la requête
        $request->getHeaders()->addHeaders(array('Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'));
        $request->setUri('http://localhost/rest/web/index.php/admin/publications/asc'); //URL du webservice en dehors du projet 
        $request->setMethod('GET');
        $request->setContent(json_encode(array('a' => $token)));
        
        $client = new Client();
        $response = $client->send($request); //envoie la requête au service REST
        $data = $response->getBody(); //récupération du token
        
        var_dump($response);
        
        //return $data;
    }

}

?>