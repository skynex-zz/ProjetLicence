//////Espace création rubriques
var boutonCreationRubrique = document.getElementById('bouton_create_rubrique');
boutonCreationRubrique.addEventListener('click', buttonCreateRubriqueEvent, false);

function buttonCreateRubriqueEvent(eventInfo) {
    createRubrique();
}