<?php
namespace Application\Model;

use Application\Model\BibtexFunctions;
use Application\Model\Publication;

class BibtexManagement
{

    public static function parsing($fichier)
    {
            /*ini_set('memory_limit', '-1');
            set_time_limit('3600');*/
            $uploadfile = dirname(__DIR__).'./../../../../public/useruploads/files/'.$fichier;
            // On dÃ©place le fichier dans le dossier d'upload
            if (file_exists($uploadfile))
            {
                // On charge le fichier bibtex
		$bibtex = new BibtexFunctions();
		$ret = $bibtex->loadFile($uploadfile);
                
		// On parse le fichier bibtex afin de remplir la structure.
		$bibtex->parse();
		$publication = new Publication();
                $publis = array();
                foreach ($bibtex->data as $datas)
		{
                    // On crÃ©Ã© un objet Publication Ã  partir des donnÃ©es bibtex
                    $publis[] = BibtexManagement::mappingBibtex($datas);
                    //FonctionsCurl::CreatePublication($token,$model->reference,$model->auteurs,$model->titre,$model->date,$model->journal,$model->volume,$model->number,$model->pages,$model->note,$model->abstract,$model->keywords,$model->series,$model->localite,$model->publisher,$model->editor,$model->pdf,$model->date_display,$model->categorie_id);               
		}
                var_dump($publis);
                //return $publis;
            }
            /*else
            {
		throw new NotFoundHttpException('Fichier Introuvable: '.$fichier);
            }*/
    }
        
    public static function mappingBibtex($tableau)
    {
        // On initialise les variables 
        $date = date('Y')."-01-01";
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
        $date_display = "";
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
        
        //Test s'il manque un ou plusieurs champs obligatoire à toutes les catégories
        if(!isset($tableau['author']) && !isset($tableau['title']) && !isset($tableau['cite'])) {
            return false;
        }
        
        //Attribution d'une categorie à $entryType
        foreach($tableau as $key => $value) {
            if($key == 'entryType') {
                $entryType = $value;
            }
        }
        
        //Attribue un numéro de catégorie selon l'entryType
        if(in_array(strtolower($entryType), array('article'))) $categ_id = "1";
	else if(in_array(strtolower($entryType), array('inproceedings'))) $categ_id = "2";
	else if(in_array(strtolower($entryType), array('techreport'))) $categ_id = "3";
	else if(in_array(strtolower($entryType), array('phdthesis'))) $categ_id = "4";
	else if(in_array(strtolower($entryType), array('misc'))) $categ_id = "5";
        else if(in_array(strtolower($entryType), array('inbook'))) $categ_id = "6";
        else $categ_id = 0;
        
        if($categ_id == "1" || $categ_id == "2" || $categ_id == "3" || $categ_id == "4" || $categ_id == "5" || $categ_id == "6") {
                            // On crÃ©er la publication et on attribut les values
                            $publication = new Publication();
                            $publication->reference=$reference;
                            $publication->auteurs=$auteurs;
                            $publication->titre=$titre;
                            $publication->date=$date;
                            $publication->journal=$journal;
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
                            $publication->date_display=date('Y-m-d');
                            $publication->categorie_id = $categ_id;
                            //rajout données
                            $publication->doi = $doi;
                            $publication->url = $url;
                            $publication->institution = $institution;
                            $publication->howpublished = $howpublished;
                            $publication->urldate = $urldate;
                            $publication->isbn = $isbn;
                            $publication->chapter = $chapter;
                            return $publication;
                        }
        
        //Vérification des champs obligatoires pour CHAQUE catégorie
        /*if($categ_id == "1") {
            
        }
        if($categ_id == "2") {
            
        }
        if($categ_id == "3") {
            
        }
        if($categ_id == "4") {
            
        }
        if($categ_id == "5") {
            
        }
        if($categ_id == "6") {
            
        }
        if($categ_id == "0") {
            
        }*/
        
    }
}