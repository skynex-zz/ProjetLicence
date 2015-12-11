
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
        data: JSON.stringify(datas),
        headers: {"Content-Type": "application/json;charset=utf-8"}
    };

    WinJS.xhr(options).done(
        function success(request) {
            var res = request.response;
            return res;
        },
        function error(err) {
            console.log("je passseeeee");
            var statut = err.status;
            if (statut > 299) {
                return false;
            } 
        }
    );

}

function getAllRubriques() {
    var options = {
        type: 'GET',
        url: 'http://localhost/rest/web/index.php/rubriques',
    };

    WinJS.xhr(options).done(
        function success(request) {
            var res = request.response;
            var tabRubriques = JSON.parse(res);
            var arrayRubriques = [];
            var tbody = document.getElementsByTagName('tbody')[0];
            tabRubriques.forEach(function (rubrique) {
                //arrayRubriques.push({titre: rubrique.titre_en, text: rubrique.titre_fr, picture: "/images/fruits/60Mint.png" });
                tbody.innerHTML = tbody.innerHTML +
                        "<tr><td>" + rubrique.titre_fr + "</td>" +
                        "<td>" + rubrique.titre_en + "</td>" +
                        "<td>" + rubrique.date_creation + "</td>" +
                        "<td>" + rubrique.date_modification + "</td>" +
                        "<td>" + rubrique.actif + "</td>" +
                        "<td>" + rubrique.position + "</td>" +
                        "<td><button class='win-button' onclick='formModifRubrique()'>Modfier</button><button class='win-button' onclick='supprimerRubrique(" + rubrique.menu_id + ")'>Supprimer</button></td></tr>";
            });
            /*WinJS.Namespace.define("Sample.ListView", {
                data: new WinJS.Binding.List(arrayRubriques)
            });
            WinJS.UI.processAll();*/
            //WinJS.Navigation.navigate('http://localhost/index.html', {key : res}); //marche pas
        },
        function error(err) {
            var statut = err.status;
            if (statut > 299) {
                WinJS.UI.processAll().done(function () {
                    var contentDialog = document.getElementById('dialog_no_rubriques').winControl;
                    contentDialog.show();
                });
            }
        }
    );

    function supprimerRubrique(id) {
        var token = 'WU8nb/rCD6JgtiyxTW3ZP+s4n9Vg9liUllh5bZLoLQhAMMoCaHE72nYLQSsw12uhkgWJLDmgMmZVD+aIk6BsZw==';
        var options = {
            type: 'DELETE',
            url: 'http://localhost/testwinjs/rest/web/index.php/admin/rubriques/' + id,
            data: '{"a": "' + token + '"}'
        };

        WinJS.xhr(options).done(
            function success(request) {
                var res = request.response;
                WinJS.UI.processAll().done(function () {
                    var contentDialog = document.getElementById('dialog_supp_rubrique_ok').winControl;
                    contentDialog.show();
                });
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
}