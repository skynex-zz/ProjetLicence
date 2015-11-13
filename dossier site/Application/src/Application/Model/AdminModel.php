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
        $retour = $response->getBody(); //récupération du retour

        if($response->getStatusCode() == 404 && substr($retour, 1) == "No content") {
            throw new \Exception("Erreur dans la requête: Pas de contenu.");
        }
        if($response->getStatusCode() == 404 && substr($retour, 1) == "Attributes username or password not here") {
            throw new \Exception("Il manque le nom d'utilisateur et/ou le mot de passe.");
        }
        if($response->getStatusCode() == 400 && substr($retour, 1) == "User don't exist") {
            throw new \Exception("Le nom d'utilisateur n'existe pas.");
        }
        if($response->getStatusCode() == 400 && substr($retour, 1) == "Admin not connected") {
            throw new \Exception("Le mot de passe est incorrect.");
        }
        if($response->getStatusCode() == 200) {
            return substr($retour, 1);
        }       
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