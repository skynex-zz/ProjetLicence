(function () {
    /*chargeRubriques();
    makeAppBar();*/

    function makeNavBar() {
        var navBar = document.getElementById('navBar');
        var cmdAddRubrique = document.getElementById('cmd1');
        var cmdPublications = document.getElementById('cmd2');
        //var cmdAddPublicationBibtex = document.getElementById('cmd3');
        var cmdRubrique = new WinJS.UI.NavBarCommand(cmdAddRubrique, {
            label: 'Ajouter une rubrique',
            icon: '\uE109',
        });
        var cmdVoirPublications = new WinJS.UI.NavBarCommand(cmdPublications, {
            label: 'Voir publications',
            icon: '\uE12A',
        });
        /*var cmdPublicationBibtex = new WinJS.UI.NavBarCommand(cmdAddPublicationBibtex, {
            label: 'Ajouter des publication via fichier BibTex',
            icon: '\uE1A5',
        });*/
        var cmdsNavBar = new WinJS.UI.NavBar(navBar, [cmdRubrique, cmdVoirPublications]);
    }

    WinJS.UI.Pages.define("/rubriques.html", {
        ready: function () {
            chargeRubriques();
            makeNavBar();
        }
    });

})();