var ident = 1;

function addquest() {
  var ajou = document.querySelectorAll('.id_question');
  ident = ajou.length + 1;
  
  var addquestHTML = document.getElementById('crea').innerHTML;
  
  addquestHTML += '<div class="id_question"><br><form method="post"><input type="text" name="intitule' + ident + '" placeholder="Intitulé"><br><input type="text" name="bonne_reponse' + ident + '" placeholder="Bonne réponse"><br><input type="text" name="reponse1-' + ident + '" placeholder="Mauvaise réponse "><br><input type="text" name="reponse2-' + ident + '" placeholder="Mauvaise réponse"><br><input type="text" name="reponse3-' + ident + '" placeholder="Mauvaise réponse"><br><input type="hidden" name="ident" value="' + ident + '"></form></div>';
 
  document.getElementById('crea').innerHTML = addquestHTML;
}
function suppquest() {
  var element = document.querySelector('.id_question:last-of-type');
  element.remove();
}
function selectquizz(){
  
}