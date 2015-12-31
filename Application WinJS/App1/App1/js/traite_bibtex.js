/////Espace traîtement fichier BibTex
var bouton = document.getElementById('bouton_upload_bibtex');
bouton.addEventListener('click', checkExtension, false);

contentDialog = new WinJS.UI.ContentDialog(document.getElementById("error_bibtex_extension"), {
    title: 'L\'extension du fichier doit être bib !',
    primaryCommandText: 'Fermer'
});

contentDialog2 = new WinJS.UI.ContentDialog(document.getElementById('error_bibtex_publications'), {
    primaryCommandText: 'Fermer'
});

contentDialog3Intraitable = new WinJS.UI.ContentDialog(document.getElementById('error_bibtex_file'), {
    primaryCommandText: 'Fermer'
});

contentDialog4Succes = new WinJS.UI.ContentDialog(document.getElementById('succes_bibtex'), {
    primaryCommandText: 'Fermer'
});

function checkExtension() {
    var fichier = document.getElementById('fichier');
    var file = fichier.files[0];
    var tab = file.name.split('.');
    var content = null;
    if (tab[1].toLowerCase() !== 'bib') {
        contentDialog.show();
    }
    else { //récupération du contenu du fichier
        var reader = new FileReader();
        reader.readAsBinaryString(file);
        reader.onloadend = function () { //onloadend déclenché à la fin de readAsBinaryString
            content = reader.result;
            var dataBibtex = parseFile(content);
            if (dataBibtex === null) {
                contentDialog3Intraitable.title = 'Le fichier ne peut être traîté. Vérifiez que votre fichier ne contient pas de \'@string\' ou \'@preamble\'.'
                contentDialog3Intraitable.show();
            }
            else {
                var tabBadPubli = [];
                for (var i = 0; i < dataBibtex.length; i++) {
                    var badPubli = mappingBibtex(dataBibtex[i]); //mapping et création
                    if(badPubli !== undefined) tabBadPubli.push(badPubli);
                }
                console.log(tabBadPubli);
                if (tabBadPubli.length > 0) {
                    contentDialog2.title = 'Les publications avec les références suivantes n\'ont pu être insérées: '
                        + tabBadPubli.join(', ');
                    contentDialog2.show();
                }
                else if(tabBadPubli.length === 0) {
                    contentDialog4Succes.title = 'Publications insérées avec succès.';
                    contentDialog4Succes.show();
                }
            }
        }
    }
}

//pas de gestion de @preamble et @string donc il en faut pas sinon ça casse !!
function parseFile(content) {
    var bibtex = new BibTex;
    bibtex.content = content;
    var booleen = bibtex.parse();
    if (!booleen){
        return null;
    }
    else {
        return bibtex.data;
    }
}

function mappingBibtex(p) {
    if (p.hasOwnProperty('entryType') && p.hasOwnProperty('cite')) {
        if (p.hasOwnProperty('entryType') && Object.prototype.toString.call(p.author) === '[object Array]') {
            var auteurs = "";
            for (var j = 0; j < p.author.length; j++) {
                if (j !== p.author.length - 1) auteurs += p.author[j].last + " and ";
                else auteurs += p.author[j].last;
            }
            var reference = p.cite;
            var titre = p.title;
            var type = p.entryType;

            //Attribution des variables
            for (var attr in p) {
                window[attr] = p[attr];
            }

            //Creation date_display
            if (p.hasOwnProperty('year')) {
                var date = p.year + "01-01";
                if (p.hasOwnProperty('month')) {
                    var date_display = p.month + ", " + p.year;
                }
                else {
                    var date_display = p.year;
                }
            }
            else {
                var date_display = "";
            }

                //Attribution num selon type
                var categ_id = 0;
                if (p.entryType.toLowerCase() === 'article') categ_id = 1;
                else if (p.entryType.toLowerCase() === 'inproceedings') categ_id = 2;
                else if (p.entryType.toLowerCase() === 'techreport') categ_id = 3;
                else if (p.entryType.toLowerCase() === 'phdthesis') categ_id = 4;
                else if (p.entryType.toLowerCase() === 'misc') categ_id = 5;
                else if (p.entryType.toLowerCase() === 'inbook') categ_id = 6;

                //Vérification champs manquants
                if (categ_id === 1) {
                    if (!p.hasOwnProperty('journal')) {
                        return p.cite;
                    }
                }
                if (categ_id === 2 || categ_id === 6) {
                    if (p.hasOwnProperty('booktitle')) {
                        return p.cite;
                    }
                }
                if (categ_id === 3 || categ_id === 4) {
                    if (!p.hasOwnProperty('type') || !p.hasOwnProperty('institution')) {
                        return p.cite;
                    }
                }
                if (categ_id === 5) {
                    if (!p.hasOwnProperty('editor')) {
                        return p.cite;
                    }
                }
                if (categ_id === 0) {
                    return p.cite;
                }
                
                //Création publication
                if (categ_id === 1 || categ_id === 2 || categ_id === 3 || categ_id === 4 || categ_id === 5 || categ_id === 6)
                {
                    var publication = {
                        reference: reference,
                        auteurs: auteurs,
                        titre: titre,
                        date: date,
                        journal: p.journal,
                        volume: p.volume,
                        number: p.number,
                        pages: p.pages,
                        note: p.note,
                        abstract: p.abstract,
                        keywords: p.keywords,
                        series: p.series,
                        localite: p.localite,
                        publisher: p.publisher,
                        editor: p.editor,
                        pdf: null,
                        date_display: date_display,
                        categorie_id: categ_id,
                        doi: p.doi,
                        url: p.url,
                        institution: p.institution,
                        howpublished: p.howpublished,
                        urldate: p.urldate,
                        isbn: p.isbn,
                        chapter: p.chapter,
                        booktitle: p.booktitle,
                        type: type,
                    };
                    for (var a in publication) {
                        if(publication[a] === undefined) publication[a] = null;
                    }
                    createPublication(publication); //création de la publication en base de données
                }
            }
            else {
                return p.cite;
            }
        }
}