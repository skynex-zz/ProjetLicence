
function connect() {

    var login = document.getElementById('login').value;
    var password = document.getElementById('password').value;

    var datas = {
        'username': login,
        'password': password
    };

    var options = {
        type: 'POST',
        url: 'http://localhost/rest/web/index.php/login',
        data: JSON.stringify(datas)
    };

    WinJS.xhr(options).done(
        function success(request) {
            var res = request.response;
            console.log("Connecté !");
            location.href = '/rubriques.html';
            //WinJS.Navigation.navigate('/rubriques.html');
        },
        function error(err) {
            var statut = err.status;
            if (statut > 299) {
                WinJS.UI.processAll().done(function () {
                    var contentDialog = document.getElementById('dialog_error_connexion').winControl;
                    contentDialog.show();
                });
            }
        }
    );

}

//////Gestion Rubriques

function chargeRubriques() {
    var Data = {};
    var options = {
        type: 'GET',
        url: 'http://localhost/rest/web/index.php/rubriques',
        data: JSON.stringify(Data),
        headers: { "Content-Type": "application/json;charset=utf-8" },
        responseType: 'json'
    };

    WinJS.xhr(options).then(function (xhr) {
        var statut = xhr.status;
        if (statut > 299) {
            WinJS.UI.processAll().done(function () {
                var contentDialog = document.getElementById('dialog_no_rubriques').winControl;
                contentDialog.show();
            });
        }
        if (statut === 200) {
            var res = xhr.response;

            for (var i = 0; i < res.length; i++) {
                if (res[i].actif === '1') res[i].actif = 'Oui';
                else if (res[i].actif === '0') res[i].actif = 'Non';
                //Actions boutons modification et supression de rubrique
                window['menuId'] = res[i].menu_id;
                res[i].supp = WinJS.Utilities.markSupportedForProcessing(function (e) {
                    deleteRubrique(window['menuId']);
                });
            }

            //Pour ListView
            var list = new WinJS.Binding.List(res);
            var listview = document.getElementById("listView");
            WinJS.UI.processAll().done(function () {
                listview.winControl.itemDataSource = list.dataSource;
            });
        }
    });
}

function getOneRubrique(idMenu) {
    var token = 'WU8nb/rCD6JgtiyxTW3ZP+s4n9Vg9liUllh5bZLoLQhAMMoCaHE72nYLQSsw12uhkgWJLDmgMmZVD+aIk6BsZw==';
    var options = {
        type: 'GET',
        url: 'http://localhost/rest/web/index.php/rubriques/' + idMenu,
        data: '{"a": "' + token + '"}'
    };

    var a = WinJS.xhr(options).done(function (res) {
        var test;
        var statut = res.status;
        if (statut === 200) {
            test = JSON.parse(res.response);
            return test;
        }
        if (statut > 299) {
            test = false;
            return test;
        }
    });
    return a;
}

function getDatasFormsRubrique() {
    var titreFr = document.getElementById('titre_fr').value;
    var titreEn = document.getElementById('titre_en').value;
    var contentFr = document.getElementById('content_fr').value;
    var contentEn = document.getElementById('content_en').value;
    var radios = document.getElementsByName('actif');
    var actif = 0;
    for (var i = 0, length = radios.length; i < length; i++) {
        if (radios[i].checked) {
            actif = radios[i].value;
            break;
        }
    }
    var position = document.getElementById('position').value;
    var datas = [titreFr, titreEn, contentFr, contentEn, actif, position];
    return datas;
}


function createRubrique() {
    var token = 'WU8nb/rCD6JgtiyxTW3ZP+s4n9Vg9liUllh5bZLoLQhAMMoCaHE72nYLQSsw12uhkgWJLDmgMmZVD+aIk6BsZw==';

    var datas = getDatasFormsRubrique(); //récupération des données saisies

    var datas = {
        'a': token,
        //'ID': id, id du menu
        'titre_fr': datas[0],
        'titre_en': datas[1],
        'content_fr': datas[2],
        'content_en': datas[3],
        'actif': datas[4],
        'position': datas[5]
    };

    var options = {
        type: 'POST',
        url: 'http://localhost/rest/web/index.php/admin/rubrique',
        data: JSON.stringify(datas)
    };

    WinJS.xhr(options).done(
        function success(request) {
            var res = request.response;
            console.log('Rubrique créée !');
            WinJS.UI.processAll().done(function () {
                WinJS.Navigation.navigate('/rubriques.html', {key: token}); //marche pas
            });
            location.href = '/rubriques.html';
        },
        function error(err) {
            var statut = err.status;
            if (statut > 299) {
                WinJS.UI.processAll().done(function () {
                    var contentDialog = new WinJS.UI.ContentDialog(document.getElementById("dialog_create_rubrique_error"), {
                        title: 'Erreur création rubrique',
                        primaryCommandText: 'Fermer'
                    });
                });
            }
        }
    );
}

function modifRubrique(idMenu) {
    var token = 'WU8nb/rCD6JgtiyxTW3ZP+s4n9Vg9liUllh5bZLoLQhAMMoCaHE72nYLQSsw12uhkgWJLDmgMmZVD+aIk6BsZw==';

    var datas = getDatasFormsRubrique(); //récupération des données saisies

    var datas = {
        'a': token,
        //'ID': id, id du menu
        'titre_fr': datas[0],
        'titre_en': datas[1],
        'content_fr': datas[2],
        'content_en': datas[3],
        'actif': datas[4],
        'position': datas[5]
    };

    var options = {
        type: 'PUT',
        url: 'http://localhost/rest/web/index.php/admin/rubriques/' + idMenu,
        data: JSON.stringify(datas)
    };

    WinJS.xhr(options).done(
        function success(request) {
            var res = request.response;
            console.log("Rubrique modifiée !");
            WinJS.UI.processAll().done(function () {
                WinJS.Navigation.navigate('/rubriques.html', { key: token }); //marche pas
            });
        },
        function error(err) {
            var statut = err.status;
            if (statut > 299) {
                var contentDialog = new WinJS.UI.ContentDialog(document.getElementById("dialog_modif_rubrique_error"), {
                    title: 'Erreur modification rubrique',
                    primaryCommandText: 'Fermer'
                });
                contentDialog.show();
            }
        }
    );
}


function deleteRubrique(id) {
    var token = 'WU8nb/rCD6JgtiyxTW3ZP+s4n9Vg9liUllh5bZLoLQhAMMoCaHE72nYLQSsw12uhkgWJLDmgMmZVD+aIk6BsZw==';
    var options = {
        type: 'DELETE',
        url: 'http://localhost/rest/web/index.php/admin/rubriques/' + id,
        data: '{"a": "' + token + '"}'
    };

    WinJS.xhr(options).done(
        function success(request) {
            var res = request.response;
            WinJS.UI.processAll().done(function () {
                var contentDialog = document.getElementById('dialog_supp_rubrique_ok').winControl;
                contentDialog.show();
            });
            location.href = '/rubriques.html';
            //actualisation page pour voir la suppression et donc enlever ce qu'il y a au-dessus
        },
        function error(err) {
            var statut = err.status;
            if (statut > 299) {
                WinJS.UI.processAll().done(function () {
                    var contentDialog = document.getElementById('dialog_supp_rubrique_error').winControl;
                    contentDialog.show();
                });
            }
        }
    );
}

function createPublication(publication) {
    var token = 'WU8nb/rCD6JgtiyxTW3ZP+s4n9Vg9liUllh5bZLoLQhAMMoCaHE72nYLQSsw12uhkgWJLDmgMmZVD+aIk6BsZw==';

    var datas = {
        'a': token,
        'titre': publication.titre,
        'auteurs': publication.auteurs,
        'reference': publication.reference,
        'date': publication.date,
        'journal': publication.journal,
        'volume': publication.volume,
        'number': publication.number,
        'pages': publication.pages,
        'note': publication.note,
        'abstract': publication.abstract,
        'keywords': publication.keywords,
        'series': publication.series,
        'localite': publication.localite,
        'publisher': publication.publisher,
        'editor': publication.editor,
        'pdf': publication.pdf,
        'date_display': publication.date_display,
        'categorie_id': publication.categorie_id,
        'doi': publication.doi,
        'url': publication.url,
        'institution': publication.institution,
        'howpublished': publication.howpublished,
        'urldate': publication.urldate,
        'isbn': publication.isbn,
        'chapter': publication.chapter,
        'booktitle': publication.booktitle,
        'type': publication.type,
    }

    var options = {
        type: 'POST',
        url: 'http://localhost/rest/web/index.php/admin/publication',
        data: JSON.stringify(datas)
    };

    WinJS.xhr(options).done(
        function success(request) {
            var res = request.response;
            if (document.getElementById('res_create_publication') !== null) {
                document.getElementById('res_create_publication').innerHTML = 'Publication créée';
            }
            console.log('Publication créée !');
            //actualisation page pour voir la suppression et donc enlever ce qu'il y a au-dessus
        },
        function error(err) {
            var statut = err.status;
            if (statut > 299) {
                if (document.getElementById('res_create_publication') !== null) {
                    document.getElementById('res_create_publication').style.color = 'red';
                    document.getElementById('res_create_publication').innerHTML = 'Echec de création';
                }
                console.log('Publication non créée ! Echec !');
            }
        }
    );
}