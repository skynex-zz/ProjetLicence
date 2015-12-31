(function () {

    makeNavBar();
    recupPublications();

    function recupPublications() {
        var beginAdress = "http://localhost/rest/web/index.php/";

        var options = {
            url: beginAdress + "publications",
            type: "GET",
            headers: { "Content-Type": "application/json;charset=utf-8" }
        };
        return WinJS.xhr(options).then(

            function (request) {

                var items = JSON.parse(request.response);

                for (var i = 0; i < items.length; i++) {
                    //Actions boutons modification et supression de rubrique
                    window['ID'] = items[i].ID;
                    items[i].supp = WinJS.Utilities.markSupportedForProcessing(function (e) {
                        deletePublication(window.ID);
                    });
                }
                var list = new WinJS.Binding.List(items);
                var listview = document.getElementById("listView");
                WinJS.UI.processAll().done(function () {
                    listview.winControl.itemDataSource = list.dataSource;
                });
            },
        function (error) { WinJS.UI.ContentDialog(error) },
        function (progress) { }

            );
    }

    function deletePublication(ID) {
        var token = 'WU8nb/rCD6JgtiyxTW3ZP+s4n9Vg9liUllh5bZLoLQhAMMoCaHE72nYLQSsw12uhkgWJLDmgMmZVD+aIk6BsZw==';
        var beginAdress = "http://localhost/rest/web/index.php/";
        var options = {
            url: beginAdress + "admin/publications/" + ID,
            type: "DELETE",
            data: '{"a": "' + token + '"}'
            //headers: { "Content-Type": "application/json;charset=utf-8" }
        };
        console.log(ID);
        return WinJS.xhr(options).then(

            function (request) {
                console.log(request.status);
                location.href = "/publications.html";
            },
        function (error) { console.log(error); },
        function (progress) { }
        );
    }

    function makeNavBar() {
        var navBar = document.getElementById('navBar');
        var cmdVoirRubriques = document.getElementById('cmd1');
        var cmdAddPublication = document.getElementById('cmd2');
        var cmdAddPublicationBibtex = document.getElementById('cmd3');
        var cmdRubriques = new WinJS.UI.NavBarCommand(cmdVoirRubriques, {
            label: 'Voir rubriques',
            icon: '\uE12A',
        });
        var cmdAddPublication = new WinJS.UI.NavBarCommand(cmdAddPublication, {
            label: 'Ajouter une publication',
            icon: '\uE109',
        });
        var cmdPublicationBibtex = new WinJS.UI.NavBarCommand(cmdAddPublicationBibtex, {
            label: 'Ajouter des publications via fichier BibTex',
            icon: '\uE1A5',
        });
        var cmdsNavBar = new WinJS.UI.NavBar(navBar, [cmdRubriques, cmdAddPublication, cmdPublicationBibtex]);
    }

})();


