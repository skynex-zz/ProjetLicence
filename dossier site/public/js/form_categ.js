
//champs obligatoires = titre, référence, auteurs, date, categorie

function choixThese() {
    $("#series_bloc").css('display','none'); 
    $("#publisher_bloc").css('display','none'); 
    $("#editor_bloc").css('display','none'); 
    $("#doi_bloc").css('display','none');
    $("#howpublished_bloc").css('display','none'); 
    $("#urldate_bloc").css('display','none');
    $("#journal_bloc").css('display','none'); 
    $("#volume_bloc").css('display','none');
    $("#nb_bloc").css('display','none'); 
    $("#isbn_bloc").css('display','none'); 
    $("#chapter_bloc").css('display','none'); 
    $("#booktitle_bloc").css('display','none');
    //$("input").attr("required", "true"); pour mettre le required de l'input à true quand on veut
    $("#type_bloc").css('display', 'block'); 
    $("#institution_bloc").css('display', 'block');
    $("#localite_bloc").css('display', 'block');
    $("#pages_bloc").css('display', 'block');
    $("#url_bloc").css('display', 'block');
}

function choixArticle() {
    $("#publisher_bloc").css('display','none');
    $("#isbn_bloc").css('display','none');
    $("#localite_bloc").css('display', 'none');
    $("#institution_bloc").css('display', 'none');
    $("#howpublished_bloc").css('display','none');
    $("#urldate_bloc").css('display','none');
    $("#chapter_bloc").css('display','none');
    $("#booktitle_bloc").css('display','none');
    $("#type_bloc").css('display','none');
    //$("input").attr("required", "true"); pour mettre le required de l'input à true quand on veut
    $("#journal_bloc").css('display', 'block'); 
    $("#editor_bloc").css('display', 'block');
    $("#series_bloc").css('display', 'block');
    $("#volume_bloc").css('display', 'block');
    $("#nb_bloc").css('display', 'block');
    $("#pages_bloc").css('display', 'block');
    $("#doi_bloc").css('display', 'block');
    $("#url_bloc").css('display', 'block');
}

function choixInproceedings() {
    $("#journal_bloc").css('display','none');
    $("#type_bloc").css('display','none');
    $("#howpublished_bloc").css('display','none');
    $("#institution_bloc").css('display','none');
    $("#urldate_bloc").css('display', 'none');
    $("#chapter_bloc").css('display', 'none');
    //$("input").attr("required", "true"); pour mettre le required de l'input à true quand on veut
    $("#booktitle_bloc").css('display', 'block'); 
    $("#editor_bloc").css('display', 'block');
    $("#series_bloc").css('display', 'block');
    $("#volume_bloc").css('display', 'block');
    $("#nb_bloc").css('display', 'block');
    $("#pages_bloc").css('display', 'block');
    $("#doi_bloc").css('display', 'block');
    $("#url_bloc").css('display', 'block');
    $("#isbn_bloc").css('display', 'block');
    $("#publisher_bloc").css('display', 'block');
    $("#localite_bloc").css('display', 'block');
}

function choixReport() {
    $("#journal_bloc").css('display','none');
    $("#series_bloc").css('display','none'); 
    $("#publisher_bloc").css('display','none'); 
    $("#editor_bloc").css('display','none'); 
    $("#doi_bloc").css('display','none');
    $("#howpublished_bloc").css('display','none'); 
    $("#urldate_bloc").css('display','none');
    $("#volume_bloc").css('display','none'); 
    $("#nb_bloc").css('display','none');
    $("#isbn_bloc").css('display','none');
    $("#chapter_bloc").css('display','none'); 
    $("#booktitle_bloc").css('display','none');
    //$("input").attr("required", "true"); pour mettre le required de l'input à true quand on veut
    $("#type_bloc").css('display', 'block');
    $("#institution_bloc").css('display', 'block');
    $("#localite_bloc").css('display', 'block');
    $("#pages_bloc").css('display', 'block');
    $("#url_bloc").css('display', 'block');
}

function choixMisc() {
    $("#journal_bloc").css('display','none');
    $("#type_bloc").css('display','none');
    $("#series_bloc").css('display','none'); 
    $("#publisher_bloc").css('display','none'); 
    $("#editor_bloc").css('display','none'); 
    $("#doi_bloc").css('display','none');
    $("#volume_bloc").css('display','none'); 
    $("#nb_bloc").css('display','none');
    $("#isbn_bloc").css('display','none'); 
    $("#chapter_bloc").css('display','none'); 
    $("#booktitle_bloc").css('display','none');
    $("#institution_bloc").css('display','none');
    $("#pages_bloc").css('display','none');
    //$("input").attr("required", "true"); pour mettre le required de l'input à true quand on veut
    $("#howpublished_bloc").css('display', 'block');
    $("#localite_bloc").css('display', 'block');
    $("#url_bloc").css('display', 'block');
    $("#urldate_bloc").css('display', 'block');
}

function choixInbook() {
    $("#journal_bloc").css('display','none');
    $("#type_bloc").css('display','none'); 
    $("#howpublished_bloc").css('display','none'); 
    $("#urldate_bloc").css('display','none');
    $("#institution_bloc").css('display','none');
    //$("input").attr("required", "true"); pour mettre le required de l'input à true quand on veut
    $("#booktitle_bloc").css('display', 'block');
    $("#localite_bloc").css('display', 'block');
    $("#url_bloc").css('display', 'block');
    $("#series_bloc").css('display', 'block');
    $("#editor_bloc").css('display', 'block');
    $("#volume_bloc").css('display', 'block');
    $("#nb_bloc").css('display', 'block');
    $("#publisher_bloc").css('display', 'block');
    $("#chapter_bloc").css('display', 'block');
    $("#doi_bloc").css('display', 'block');
    $("#pages_bloc").css('display', 'block');
    $("#isbn_bloc").css('display', 'block');
}

function choixCategorie(choix) {
    switch(choix) {
        case '1':
            choixArticle();
            break;
        case '2':
            choixInproceedings();
            break;
        case '3':
            choixReport();
            break;
        case '4':
            choixThese();
            break;
        case '5':
            choixMisc();
            break;
        case '6':
            choixInbook();
            break;
        default:
            alert('autre');
    }
}
