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
			    var itemArray = [
                { title: "Marvelous Mint", text: "Gelato", picture: "/images/fruits/60Mint.png" },
                { title: "Succulent Strawberry", text: "Sorbet", picture: "/images/fruits/60Strawberry.png" },
                { title: "Banana Blast", text: "Low-fat frozen yogurt", picture: "/images/fruits/60Banana.png" },
                { title: "Lavish Lemon Ice", text: "Sorbet", picture: "/images/fruits/60Lemon.png" },
                { title: "Creamy Orange", text: "Sorbet", picture: "/images/fruits/60Orange.png" },
                { title: "Very Vanilla", text: "Ice Cream", picture: "/images/fruits/60Vanilla.png" },
                { title: "Banana Blast", text: "Low-fat frozen yogurt", picture: "/images/fruits/60Banana.png" },
                { title: "Lavish Lemon Ice", text: "Sorbet", picture: "/images/fruits/60Lemon.png" }
			    ];

			    var items = [];

			    // Generate 160 items
			    for (var i = 0; i < 20; i++) {
			        itemArray.forEach(function (item) {
			            items.push(item);
			        });
			    }


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
