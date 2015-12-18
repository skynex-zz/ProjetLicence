(function () {

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
                    window['ID' + i] = items[i].ID;
                    items[i].supp = WinJS.Utilities.markSupportedForProcessing(function (e) {
                        console.log(e);
                        deletePublication(window.ID + i);
                    });
                    items[i].modif = WinJS.Utilities.markSupportedForProcessing(function (e) {
                        modifPublication(items[i].ID);
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
                if (request.status == '400') { alert("La publication n'existe pas"); }
                else if (request.status == '404') { alert("Aucun contenue"); }
                else if (request.status == '403') { alert("Vous n'etes pas connecté"); }
                else if (request.status == '200') {
                    alert("Publication Supprimé");
                }
                console.log(request.status);
                //location.href = "/default.html";
            },
        function (error) { console.log(error); },
        function (progress) { }
        );
    }
})();


