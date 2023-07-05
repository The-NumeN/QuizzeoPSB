var ident = 1;
function addquest() {
  var ajou = document.querySelectorAll('.id_question');
  ident = ajou.length + 1;

  var addquestHTML = document.getElementById('crea').innerHTML;

  addquestHTML += '<div class="id_question"><br><form method="post"><input type="text" name="intitule' + ident + '" placeholder="Intitulé" required><br><input type="text" name="bonne_reponse' + ident + '" placeholder="Bonne réponse"required><br><input type="text" name="reponse1-' + ident + '" placeholder="Mauvaise réponse"required><br><input type="text" name="reponse2-' + ident + '" placeholder="Mauvaise réponse"required><br><input type="text" name="reponse3-' + ident + '" placeholder="Mauvaise réponse"required><br><input type="hidden" name="ident" value="' + ident + '"required></form></div>';

  document.getElementById('crea').innerHTML = addquestHTML;
}
function suppquest() {
  var element = document.querySelector('.id_question:last-of-type');
  element.remove();
}
var slideIndex = 1;
showSlides(slideIndex);
function plusSlide(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}
function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("cache");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slides[slideIndex-1].style.display = "block";  
}
document.querySelector('form').addEventListener('change', function () {
var elts = document.querySelectorAll('input');
		for (var i = 0; i < elts.length; i++) {
			if ( elts[i].checked === true ) break;
		}
	console.log('value => '+elts[i].value);
})
