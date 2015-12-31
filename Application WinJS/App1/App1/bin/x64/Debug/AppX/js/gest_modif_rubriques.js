//////Espace modification rubriques
formModifRubrique();
var boutonModificationRubrique = document.getElementById('bouton_modif_rubrique');
boutonModificationRubrique.addEventListener('click', buttonModifRubriqueEvent, false);

function buttonModifRubriqueEvent(eventInfo) {
    modifRubrique(32);
}