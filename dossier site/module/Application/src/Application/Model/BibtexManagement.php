<?php
namespace Application\Model;

use Application\Model\BibtexFunctions;
use Application\Model\Publication;

class BibtexManagement
{

    public static function parsing($fichier)
    {
            //ini_set('memory_limit', '-1');
            set_time_limit('500');
            $uploadfile = dirname(__DIR__).'./../../../../public/useruploads/files/'.$fichier;
            // On dÃ©place le fichier dans le dossier d'upload
            if(file_exists($uploadfile))
            {
                $chaine = explode('.', $fichier);
                if($chaine[1] == 'bib') {
                    // On charge le fichier bibtex
                    $bibtex = new BibtexFunctions();
                    $ret = $bibtex->loadFile($uploadfile);

                    // On parse le fichier bibtex afin de remplir la structure.
                    $bibtex->parse();
                    $publication = new Publication();
                    $publis = array();
                    foreach ($bibtex->data as $datas)
                    {
                        $publi = BibtexManagement::mappingBibtex($datas);
                        //if($publi != null) {
                        $publis[] = $publi;
                        //}
                    }
                    if(!empty($publis)) {
                        return $publis;
                    }
                    else {
                        return false;
                    }
                }
                else {
                    return false;
                }
            }
            else
            {
		return false;
            }
    }
        
    public static function mappingBibtex($tableau)
    {
        // On initialise les variables 
        $date = /*date('Y')."-01-01";*/'';
        $date_display = "";
        $journal = "";
        $volume = "";
        $number = "";
        $pages = "";
        $note = "";
        $abstract = "";
        $keywords = "";
        $series = "";
        $localite = "";
        $publisher = "";
        $editor = "";
        $categorie = "";
        //rajout champs
        $doi = "";
        $url = "";
        $institution = "";
        $howpublished = "";
        $urldate = "";
        $isbn = "";
        $chapter = "";
        $booktitle = "";
        $type = "";
        $entryType = "";
        
        //Test s'il manque un ou plusieurs champs obligatoires à toutes les catégories
        if(isset($tableau['cite']) && isset($tableau['entryType'])) {
            if(isset($tableau['author']) && isset($tableau['title'])) 
            {
                $reference = $tableau["cite"];
                $auteurs = substr($tableau["author"], 1 ,-1);
                $auteurs = str_replace('Ã©', 'e', $auteurs);
                $titre = substr($tableau["title"], 1 ,-1);
                if(isset($tableau['keywords'])) $keywords = substr($tableau["keywords"], 1 ,-1); 
                if(isset($tableau['abstract'])) $abstract = substr($tableau["abstract"], 1 ,-1);
                if(isset($tableau['note'])) $note = substr($tableau["note"], 1 ,-1);  

                //Attribution d'une categorie à $entryType
                foreach($tableau as $key => $value) {
                    if($key == 'entryType') {
                        $entryType = $value;
                    }
                    else {
                        $keyMin = strtolower($key);
                        if(substr($value, 0, 1) == '{' && substr($value, -1, 1) == '}') {
                            ${$keyMin} = substr($value, 1, -1);
                        }
                        else {
                            ${$keyMin} = $value;
                        }
                    }
                }

                if(isset($tableau['year'])) {
                    if(substr($tableau['year'], 0, 1) == '{' && substr($tableau['year'], -1, 1) == '}') {
                        $tableau['year'] = substr($tableau["year"], 1 ,-1);
                    }
                    $date = $tableau['year'].'-01-01';
                    if(isset($tableau['month'])) {
                        if(substr($tableau['month'], 0, 1) == '{' && substr($tableau['month'], -1, 1) == '}') {
                            $tableau['month'] = substr($tableau["month"], 1 ,-1);
                        }
                        $date_display = $tableau['month']." ".$tableau['year'];
                    }
                }

                //Récupérer year et former la date de type 'year-01-01'
                //expression regulière pour nettoyer titre

                //Attribue un numéro de catégorie selon l'entryType
                if(in_array(strtolower($entryType), array('article'))) $categ_id = 1;
                else if(in_array(strtolower($entryType), array('inproceedings'))) $categ_id = 2;
                else if(in_array(strtolower($entryType), array('techreport'))) $categ_id = 3;
                else if(in_array(strtolower($entryType), array('phdthesis'))) $categ_id = 4;
                else if(in_array(strtolower($entryType), array('misc'))) $categ_id = 5;
                else if(in_array(strtolower($entryType), array('inbook'))) $categ_id = 6;
                else $categ_id = 0;

                //Vérification des champs obligatoires pour CHAQUE catégorie
                if($categ_id == 1) {
                    if(/*!isset($tableau['editor']) || !isset($tableau['series']) || !isset($tableau['volume']) || !isset($tableau['number']) 
                        || !isset($tableau['pages']) || !isset($tableau['doi']) || !isset($tableau['url']) || */!isset($tableau['journal'])) {
                        return $tableau['cite'];
                    }
                }

                if($categ_id == 2 || $categ_id == 6) {
                    if(/*!isset($tableau['editor']) || !isset($tableau['series']) || !isset($tableau['volume']) || !isset($tableau['number']) 
                        || !isset($tableau['pages']) || !isset($tableau['doi']) || !isset($tableau['url']) || )
                        || !isset($tableau['publisher']) || !isset($tableau['location']) || !isset($tableau['isbn']*/ !isset($tableau['booktitle'])) {
                        return $tableau['cite'];
                    } 

                }
                if($categ_id == 3 || $categ_id == 4) {
                    if(!isset($tableau['type']) || !isset($tableau['institution']) /*|| !isset($tableau['pages']) || !isset($tableau['url']) || !isset($tableau['location'])*/) {
                        return $tableau['cite'];
                    }
                }
                if($categ_id == 5) {
                    if(!isset($tableau['editor'])/*!isset($tableau['url']) || !isset($tableau['urldate']) || !isset($tableau['howpublished']) || !isset($tableau['location'])*/) {
                        return $tableau['cite'];
                    }
                }
                /*if($categ_id == 6) {
                    if(/* || !isset($tableau['series']) || !isset($tableau['volume']) || !isset($tableau['number']) 
                        || !isset($tableau['pages']) || !isset($tableau['doi']) || !isset($tableau['url'])!isset($tableau['booktitle'])
                        /*|| !isset($tableau['publisher']) || !isset($tableau['location']) || !isset($tableau['isbn']) || !isset($tableau['chapter'])) {
                        return $tableau['cite'];
                    }
                }*/
                if($categ_id == 0) {
                    return $tableau['cite'];
                }

                //Si la catégorie est valide on crée une Publication avec les données récoltées
                if($categ_id == "1" || $categ_id == "2" || $categ_id == "3" || $categ_id == "4" || $categ_id == "5" || $categ_id == "6") {
                    $publication = new Publication();
                    $publication->reference=$reference;
                    $publication->auteurs=$auteurs;
                    $publication->titre=$titre;
                    $publication->date=$date;
                    $publication->journal=$journal/*$datas['journal']*/;
                    $publication->volume=$volume;
                    $publication->number=$number;
                    $publication->pages=$pages;
                    $publication->note=$note;
                    $publication->abstract=$abstract;
                    $publication->keywords=$keywords;
                    $publication->series=$series;
                    $publication->localite=$localite;
                    $publication->publisher=$publisher;
                    $publication->editor=$editor;
                    $publication->pdf=null;
                    $publication->date_display=$date_display;
                    $publication->categorie_id = $categ_id;
                    //rajout données
                    $publication->doi = $doi;
                    $publication->url = $url;
                    $publication->institution = $institution;
                    $publication->howpublished = $howpublished;
                    $publication->urldate = $urldate;
                    $publication->isbn = $isbn;
                    $publication->chapter = $chapter;
                    $publication->booktitle = $booktitle;
                    $publication->type = $type;
                    return $publication;
                }
            }
            else {
                return $tableau['cite'];
            }
        }
        else {
            return false;
        }
        
        
        
    }
}