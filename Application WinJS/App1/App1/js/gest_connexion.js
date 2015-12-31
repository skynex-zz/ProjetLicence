//////Espace connexion
var boutonConnexion = document.getElementById('bouton_connexion');
boutonConnexion.addEventListener('click', buttonConnectEvent, false);

function buttonConnectEvent(eventInfo) {
    connect();
}