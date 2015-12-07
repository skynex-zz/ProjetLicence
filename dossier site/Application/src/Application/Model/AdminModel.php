<?php

namespace Application\Model;

use Zend\Http\Request;
use Application\Model\ClientRequest;

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
        
        $response = ClientRequest::sendRequest($request); 
        $statut = $response->getStatusCode(); //récupération du statut de la Response

        //Traitement selon statut
        if($statut >= 200 && $statut <= 299) {
            return substr($response->getBody(), 1); //renvoi token       
        }
        else if($statut >= 300) {
            throw new \Exception();
        }       
    }
    
     /********* Appels webservices de RUBRIQUES Admin *********/
    
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
        
        $response = ClientRequest::sendRequest($request);
        $statut = $response->getStatusCode();
        
        //Traitement selon statut
        if($statut >= 200 && $statut <= 299) {
            return substr($response->getBody(), 1);
        }
        else if($statut >= 300) {
            throw new \Exception();
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
        
        $response = ClientRequest::sendRequest($request);
        $statut = $response->getStatusCode();
        
        //Traitement selon statut
        if($statut >= 200 && $statut <= 299) {
            return substr($response->getBody(), 1);
        }
        else if($statut >= 300) {
            throw new \Exception();
        }
    }
    
    public function deleteRubrique($token, $idMenu) {
        $request = new Request();
        //ajoute des headers et modifie la requête
        $request->getHeaders()->addHeaders(array('Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'));
        $request->setUri('http://localhost/rest/web/index.php/admin/rubriques/'.$idMenu); //URL du webservice en dehors du projet 
        $request->setMethod('DELETE');
        $request->setContent(json_encode(array('a' => $token)));
        
        $response = ClientRequest::sendRequest($request); //envoie requête
        $statut = $response->getStatusCode();
        
        //Traitement selon statut
        if($statut >= 200 && $statut <= 299) {
            return substr($response->getBody(), 1);
        }
        else if($statut >= 300) {
            throw new \Exception();
        }
    }
    
    /********* Appels webservices de PUBLICATIONS Admin *********/
    
    public function createPublication($token, $publication) {
        $request = new Request();
        //ajoute des headers et modifie la requête
        $request->getHeaders()->addHeaders(array('Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'));
        $request->setUri('http://localhost/rest/web/index.php/admin/publication'); //URL du webservice en dehors du projet 
        $request->setMethod('POST');
        $request->setContent(json_encode(array(
            'a' => $token,
            'titre' => $publication->titre,
            'auteurs' => $publication->auteurs,
            'reference' => $publication->reference,
            'date' => $publication->date,
            'journal' => $publication->journal,            
            'volume' => $publication->volume,
            'number' => $publication->number,
            'pages' => $publication->pages,
            'note' => $publication->note,
            'abstract' => $publication->abstract,
            'keywords' => $publication->keywords,
            'series' => $publication->series,
            'localite' => $publication->localite,
            'publisher' => $publication->publisher,
            'editor' => $publication->editor,
            'pdf' => $publication->pdf,
            'date_display' => $publication->date_display,
            'categorie_id' => $publication->categorie_id,
            'doi' => $publication->doi,
            'url' => $publication->url,
            'institution' => $publication->institution,
            'howpublished' => $publication->howpublished,
            'urldate' => $publication->urldate,
            'isbn' => $publication->isbn,
            'chapter' => $publication->chapter,
            'booktitle' => $publication->booktitle,
            'type' => $publication->type,
        )));
        
        $response = ClientRequest::sendRequest($request); //envoie requête
        $statut = $response->getStatusCode();
        
        //Traitement selon statut
        if($statut >= 200 && $statut <= 299) {
            return substr($response->getBody(), 1);
        }
        else if($statut >= 300) {
            throw new \Exception();
        }
    }
       
    public function modifPublication($token, $publication) {
        $request = new Request();
        //ajoute des headers et modifie la requête
        $request->getHeaders()->addHeaders(array('Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'));
        $request->setUri('http://localhost/rest/web/index.php/admin/publications/'.$publication->id); //URL du webservice en dehors du projet 
        $request->setMethod('PUT');
        $request->setContent(json_encode(array(
            'a' => $token,
            'titre' => $publication->titre,
            'auteurs' => $publication->auteurs,
            'reference' => $publication->reference,
            'date' => $publication->date,
            'journal' => $publication->journal,            
            'volume' => $publication->volume,
            'number' => $publication->number,
            'pages' => $publication->pages,
            'note' => $publication->note,
            'abstract' => $publication->abstract,
            'keywords' => $publication->keywords,
            'series' => $publication->series,
            'localite' => $publication->localite,
            'publisher' => $publication->publisher,
            'editor' => $publication->editor,
            'pdf' => $publication->pdf,
            'date_display' => $publication->date_display,
            'categorie_id' => $publication->categorie_id,
            'doi' => $publication->doi,
            'url' => $publication->url,
            'institution' => $publication->institution,
            'howpublished' => $publication->howpublished,
            'urldate' => $publication->urldate,
            'isbn' => $publication->isbn,
            'chapter' => $publication->chapter,
            'booktitle' => $publication->booktitle,
            'type' => $publication->type,
        )));
        
        $response = ClientRequest::sendRequest($request); //envoie requête
        $statut = $response->getStatusCode();
        
        //Traitement selon statut
        if($statut >= 200 && $statut <= 299) {
            return substr($response->getBody(), 1);
        }
        else if($statut >= 300) {
            throw new \Exception();
        }
    }
    
    public function deletePublication($token, $idPublication) {
        $request = new Request();
        //ajoute des headers et modifie la requête
        $request->getHeaders()->addHeaders(array('Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'));
        $request->setUri('http://localhost/rest/web/index.php/admin/publications/'.$idPublication); //URL du webservice en dehors du projet 
        $request->setMethod('DELETE');
        $request->setContent(json_encode(array('a' => $token)));
        
        $response = ClientRequest::sendRequest($request); //envoie requête
        $statut = $response->getStatusCode();
        
        //Traitement selon statut
        if($statut >= 200 && $statut <= 299) {
            return substr($response->getBody(), 1);
        }
        else if($statut >= 300) {
            throw new \Exception();
        }
    }

}