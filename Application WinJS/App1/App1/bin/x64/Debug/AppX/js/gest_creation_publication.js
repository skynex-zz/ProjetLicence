////////Création de la publication (createPublication dans adminModel.js) au clique
var boutonCreationPublication = document.getElementById('bouton_create_publication');
boutonCreationPublication.addEventListener('click', buttonCreatePublicationEvent, false);

var changeCateg = document.getElementById('select_categories');
changeCateg.onchange = function () {
    categ = document.getElementById('select_categories').value;
    afficher(categ);
};

function buttonCreatePublicationEvent(eventInfo) {
    var publication = doPublication();
    createPublication(publication);
}

function afficherInput(eventInfo) {
    categ = document.getElementById('select_categories').value;
    afficher(categ);
}

function afficher(numCateg) {
    var categorie = document.getElementById('select_categories').value;
    if (numCateg == 1) {

        document.getElementById('auteurs').style.display = "inline";
        document.getElementById('titre').style.display = "inline";
        document.getElementById('booktitle').style.display = "inline";
        document.getElementById('date_display').style.display = "inline";
        document.getElementById('date').style.display = "inline";
        document.getElementById('editor').style.display = "inline";
        document.getElementById('journal').style.display = "inline";
        document.getElementById('series').style.display = "inline";
        document.getElementById('volume').style.display = "inline";
        document.getElementById('number').style.display = "inline";
        document.getElementById('pages').style.display = "inline";
        document.getElementById('note').style.display = "inline";
        document.getElementById('abstract').style.display = "inline";


        document.getElementById('reference').style.display = "none";
        document.getElementById('chapter').style.display = "none";
        document.getElementById('type').style.display = "none";
        document.getElementById('publisher').style.display = "none";
        document.getElementById('localite').style.display = "none";
        document.getElementById('institution').style.display = "none";
        document.getElementById('isbn').style.display = "none";
        document.getElementById('howpublished').style.display = "none";
        
        
        
    }
    else if (numCateg == 2) {

        document.getElementById('auteurs').style.display = "inline";
        document.getElementById('titre').style.display = "inline";
        document.getElementById('date_display').style.display = "inline";
        document.getElementById('date').style.display = "inline";
        document.getElementById('editor').style.display = "inline";
        document.getElementById('type').style.display = "inline";
        document.getElementById('localite').style.display = "inline";
        document.getElementById('howpublished').style.display = "inline";
        document.getElementById('note').style.display = "inline";
        document.getElementById('isbn').style.display = "inline";

        document.getElementById('abstract').style.display = "inline";

        document.getElementById('pages').style.display = "none";
        document.getElementById('journal').style.display = "none";
        document.getElementById('booktitle').style.display = "none";
        document.getElementById('reference').style.display = "none";
        document.getElementById('chapter').style.display = "none";
        document.getElementById('series').style.display = "none";
        document.getElementById('volume').style.display = "none";
        document.getElementById('number').style.display = "none";
        document.getElementById('publisher').style.display = "none";
        document.getElementById('institution').style.display = "none";
        
       

    }
    else if ((numCateg == 3) && (numCateg == 4)) {

        document.getElementById('auteurs').style.display = "inline";
        document.getElementById('titre').style.display = "inline";
        document.getElementById('booktitle').style.display = "inline";
        document.getElementById('date_display').style.display = "inline";
        document.getElementById('date').style.display = "inline";
        document.getElementById('editor').style.display = "inline";
        document.getElementById('journal').style.display = "none";
        document.getElementById('series').style.display = "inline";
        document.getElementById('volume').style.display = "inline";
        document.getElementById('number').style.display = "inline";
        document.getElementById('pages').style.display = "inline";
        document.getElementById('note').style.display = "inline";

        document.getElementById('abstract').style.display = "inline";

        document.getElementById('reference').style.display = "none";
        document.getElementById('chapter').style.display = "none";
        document.getElementById('type').style.display = "none";
        document.getElementById('publisher').style.display = "none";
        document.getElementById('localite').style.display = "none";
        document.getElementById('institution').style.display = "none";
        document.getElementById('isbn').style.display = "none";
        document.getElementById('howpublished').style.display = "none";

    }
    else if (numCateg == 5) {

        document.getElementById('auteurs').style.display = "inline";
        document.getElementById('titre').style.display = "inline";
        document.getElementById('booktitle').style.display = "inline";
        document.getElementById('date_display').style.display = "inline";
        document.getElementById('date').style.display = "inline";
        document.getElementById('editor').style.display = "inline";
        document.getElementById('journal').style.display = "none";
        document.getElementById('series').style.display = "inline";
        document.getElementById('volume').style.display = "inline";
        document.getElementById('number').style.display = "inline";
        document.getElementById('pages').style.display = "inline";
        document.getElementById('note').style.display = "inline";

        document.getElementById('abstract').style.display = "inline";

        document.getElementById('reference').style.display = "none";
        document.getElementById('chapter').style.display = "none";
        document.getElementById('type').style.display = "none";
        document.getElementById('publisher').style.display = "none";
        document.getElementById('localite').style.display = "none";
        document.getElementById('institution').style.display = "none";
        document.getElementById('isbn').style.display = "none";
        document.getElementById('howpublished').style.display = "none";
 
    }
    else if (numCateg == 6) {

        document.getElementById('auteurs').style.display = "inline";
        document.getElementById('titre').style.display = "inline";
        document.getElementById('booktitle').style.display = "inline";
        document.getElementById('date_display').style.display = "inline";
        document.getElementById('date').style.display = "inline";
        document.getElementById('editor').style.display = "inline";
        document.getElementById('journal').style.display = "none";
        document.getElementById('series').style.display = "inline";
        document.getElementById('volume').style.display = "inline";
        document.getElementById('number').style.display = "inline";
        document.getElementById('pages').style.display = "inline";
        document.getElementById('note').style.display = "inline";

        document.getElementById('abstract').style.display = "inline";

        document.getElementById('reference').style.display = "none";
        document.getElementById('chapter').style.display = "none";
        document.getElementById('type').style.display = "none";
        document.getElementById('publisher').style.display = "none";
        document.getElementById('localite').style.display = "none";
        document.getElementById('institution').style.display = "none";
        document.getElementById('isbn').style.display = "none";
        document.getElementById('howpublished').style.display = "none";

    }

    document.getElementById('doi').style.display = "inline";
    document.getElementById('url').style.display = "inline";
    document.getElementById('urldate').style.display = "inline";
    document.getElementById('keywords').style.display = "inline";
    document.getElementById('pdf').style.display = "inline";


}

function doPublication() {
    var categorie = document.getElementById('select_categories').value;
    var reference = document.getElementById('reference').value;
    var auteurs = document.getElementById('auteurs').value;
    var titre = document.getElementById('titre').value;
    var booktitle = document.getElementById('booktitle').value;
    var editor = document.getElementById('editor').value;
    var series = document.getElementById('series').value;
    var volume = document.getElementById('volume').value;
    var number = document.getElementById('number').value;
    var pages = document.getElementById('pages').value;
    var chapter = document.getElementById('chapter').value;
    var type = document.getElementById('type').value;
    var publisher = document.getElementById('publisher').value;
    var dateDisplay = document.getElementById('date_display').value;
    var localite = document.getElementById('localite').value;
    var institution = document.getElementById('institution').value;
    var isbn = document.getElementById('isbn').value;
    var journal = document.getElementById('journal').value;
    var doi = document.getElementById('doi').value;
    var howpublished = document.getElementById('howpublished').value;
    var urldate = document.getElementById('urldate').value;
    var url = document.getElementById('url').value;
    var note = document.getElementById('note').value;
    var abstract = document.getElementById('abstract').value;
    var keywords = document.getElementById('keywords').value;
    var pdf = document.getElementById('pdf').value;
    var date = document.getElementById('date').value;

    var publication = {
        reference: reference,
        auteurs: auteurs,
        titre: titre,
        date: date,
        journal: journal,
        volume: volume,
        number: number,
        pages: pages,
        note: note,
        abstract: abstract,
        keywords: keywords,
        series: series,
        localite: localite,
        publisher: publisher,
        editor: editor,
        pdf: pdf,
        date_display: dateDisplay,
        categorie_id: categorie,
        doi: doi,
        url: url,
        institution: institution,
        howpublished: howpublished,
        urldate: urldate,
        isbn: isbn,
        chapter: chapter,
        booktitle: booktitle,
        type: type,
    };

    return publication;
}