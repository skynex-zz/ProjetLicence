(function () {
    /*"use strict";

    var dataArray = [
        { titre_fr: "Basic banana", titre_en: "Low-fat frozen yogurt", position: "images/60banana.png" },
        { titre_fr: "Basic banana", titre_en: "Low-fat frozen yogurt", position: "images/60banana.png" },
        { titre_fr: "Basic banana", titre_en: "Low-fat frozen yogurt", position: "images/60banana.png" },
        { titre_fr: "Basic banana", titre_en: "Low-fat frozen yogurt", position: "images/60banana.png" },
        { titre_fr: "Basic banana", titre_en: "Low-fat frozen yogurt", position: "images/60banana.png" },
        { titre_fr: "Basic banana", titre_en: "Low-fat frozen yogurt", position: "images/60banana.png" },
        { titre_fr: "Basic banana", titre_en: "Low-fat frozen yogurt", position: "images/60banana.png" }
    ];

    var dataList = new WinJS.Binding.List(dataArray);

    var rubriques = { itemList: dataList };

    WinJS.Namespace.define("DataRubriques", rubriques); //pour rendre public -> accessible par la ListView*/

    var Data = {};
    var options = {
        type: 'GET',
        url: 'http://localhost/rest/web/index.php/rubriques',
        data: JSON.stringify(Data),
        headers: { "Content-Type": "application/json;charset=utf-8" },
        responseType: 'json'
    };

    WinJS.xhr(options).done(
        function success(request) {
            var res = request.response;
            console.log(res);
            //console.log(JSON.parse(res));
            //var tabRubriques = JSON.parse(res);
            var arrayRubriques = [];
            var tbody = document.getElementsByTagName('tbody')[0];
            res.forEach(function (rubrique) {
                var rub = [rubrique.titre_fr, rubrique.titre_en, rubrique.content_fr, rubrique.content_en, rubrique.actif, rubrique.position];
                var tab = JSON.stringify(rub);

                tbody.innerHTML = tbody.innerHTML +
                        "<tr><td>" + rubrique.titre_fr + "</td>" +
                        "<td>" + rubrique.titre_en + "</td>" +
                        "<td>" + rubrique.date_creation + "</td>" +
                        "<td>" + rubrique.date_modification + "</td>" +
                        "<td>" + rubrique.actif + "</td>" +
                        "<td>" + rubrique.position + "</td>" +
                        "<td><button class='win-button' onclick='formModifRubrique(" + tab + ")'>Modifier</button>" +
                        "<button class='win-button' onclick='deleteRubrique(" + rubrique.id_menu + ")'>Supprimer</button></td></tr>";
            });


            WinJS.Namespace.define("DataRubriques", {
                data: new WinJS.Binding.List(res)
            });



            WinJS.UI.processAll().done(function () {
                var contentDialog = document.getElementById('dialog_no_rubriques').winControl;
                contentDialog.show();
            });
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


})();