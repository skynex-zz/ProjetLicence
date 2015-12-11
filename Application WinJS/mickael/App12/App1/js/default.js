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

			    //Connexion admin
			    var boutonConnexion = document.getElementById('bouton_connexion');
			    boutonConnexion.addEventListener('click', sendConnect, false); //appel fonction de connexion dans adminModel

			    //WinJS.UI.processAll();
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

	function sendConnect() {
	    var connexion = connect();
	    console.log("frfrrfrfrfr");
	    if (connexion === false) {
	        /*WinJS.UI.processAll().done(function () {
	            var contentDialog = document.getElementById('dialog_error_connexion').winControl;
	            contentDialog.show();
	        });*/
	        console.log('pas bon');
	    }
	    else {
	        //WinJS.Navigation.navigate('/default.html', { key: connexion });
	        console.log('bon');
	    }
    }

	app.start();
})();
