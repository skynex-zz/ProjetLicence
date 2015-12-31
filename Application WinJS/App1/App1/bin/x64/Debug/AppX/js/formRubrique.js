
function formModifRubrique(/*rubrique*/) {
    var rubrique = ['test0', 'test1', 'test2', 'test3', 1, 12];
    document.getElementById('titre_fr').value = rubrique[0];
    document.getElementById('titre_en').value = rubrique[1];
    document.getElementById('content_fr').value = rubrique[2];
    document.getElementById('content_en').value = rubrique[3];
    var radios = document.getElementsByName('actif');
    if(rubrique[4] === 1) radios[0].checked = true;
    else if(rubrique[4] === 0) radios[1].checked = true;
    document.getElementById('position').value = rubrique[5];
}