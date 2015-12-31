//Actions boutons Modifier et Supprimer
var content = document.getElementById('content_rubrique').getElementsByTagName();

var boutonModificationRubrique = document.getElementById('modif_rubrique');
boutonModificationRubrique.addEventListener('click', function () {
    location.href = "/form_modif_rubrique.html";
}, false);
var boutonSuppressionRubrique = document.getElementById('supp_rubrique');
boutonSuppressionRubrique.addEventListener('click', function () {
    deleteRubrique(49);
}, false);