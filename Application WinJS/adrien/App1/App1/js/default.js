// Pour obtenir une présentation du modèle Vide, consultez la documentation suivante :
// http://go.microsoft.com/fwlink/?LinkId=232509
(function () {
	"use strict";

	var app = WinJS.Application;
	var activation = Windows.ApplicationModel.Activation;

	app.onactivated = function (args) {
		if (args.detail.kind === activation.ActivationKind.launch) {
			if (args.detail.previousExecutionState !== activation.ApplicationExecutionState.terminated) {

			    // TODO: cette application vient d'être lancée. Initialisez votre application ici.

                //var items = [];
                //items = recupPublications();
                //console.log(items);


			    var beginAdress = "http://localhost/rest/web/index.php/";

			    var options = {
			        url: beginAdress + "publications",
			        type: "GET",
			        headers: { "Content-Type": "application/json;charset=utf-8" }
			    };
			    WinJS.xhr(options).done(

                    function success(request) {
                        var res = request.response;
                        var tabPublications = JSON.parse(res);
                        var item, items = [];
                        console.log(request);

                        //console.log(tabPublications);
                        tabPublications.forEach(function (publication) {
                            //vidage
                            var attribut = "";
                            for (attribut in publication) {
                                if (publication[attribut] == "") {
                                    delete publication[attribut];
                                }
                            }
                            items.push(publication);
                        });
                        console.log(items);
                        return items;
                    });


			    WinJS.Namespace.define("Sample.ListView", {
			        data: new WinJS.Binding.List(items)
			    });
			    WinJS.UI.processAll();

			} else {
				// TODO: cette application a été suspendue, puis terminée.
				// Pour créer une expérience utilisateur fluide, restaurez l'état de l'application ici afin de donner l'impression que l'application n'a jamais cessé de fonctionner.
			}
			args.setPromise(WinJS.UI.processAll());
		}
	};

	app.oncheckpoint = function (args) {
		// TODO: cette application va être suspendue. Enregistrez ici tous les états qui doivent être conservés entre les suspensions.
		// Vous utilisez l'objet WinJS.Application.sessionState, qui est automatiquement enregistré et restauré entre les suspensions.
		// Si vous devez effectuer une opération asynchrone avant la suspension de votre application, appelez args.setPromise().
	};
	app.start();
})();

function recupPublications() {
    var beginAdress = "http://localhost/rest/web/index.php/";

    var options = {
        url: beginAdress + "publications",
        type: "GET",
        headers: { "Content-Type": "application/json;charset=utf-8" }
    };
    WinJS.xhr(options).done(

        function success(request) {
            var res = request.response;
            var tabPublications = JSON.parse(res);
            var item, items = [];


            //console.log(tabPublications);
            tabPublications.forEach(function (publication) {
                //vidage
                for (attribut in publication) {
                    if (publication[attribut] == "") {
                        delete publication[attribut];
                    }
                }
                items.push(publication);
            });
            return items;
        });
}