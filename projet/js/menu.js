const btnAccueil = document.getElementById('btn-accueil');
const btnExplorer = document.getElementById('btn-explorer');
const btnBiblio = document.getElementById('btn-biblio');

const imgAccueilVide = document.getElementById('img-accueil-vide');
const imgAccueilPlein = document.getElementById('img-accueil-plein');
const imgExplorerVide = document.getElementById('img-explorer-vide');
const imgExplorerPlein = document.getElementById('img-explorer-plein');
const imgBiblioVide = document.getElementById('img-biblio-vide');
const imgBiblioPlein = document.getElementById('img-biblio-plein');

function afficherAccueil() {
    // accueil
    imgAccueilVide.classList.add('img-hidden');
    imgAccueilPlein.classList.remove('img-hidden');
    // explorer
    imgExplorerPlein.classList.add('img-hidden');
    imgExplorerPlein.classList.remove('img-active');
    imgExplorerVide.classList.add('img-active');
    imgExplorerVide.classList.remove('img-hidden');
    // biblio
    imgBiblioPlein.classList.add('img-hidden');
    imgBiblioPlein.classList.remove('img-active');
    imgBiblioVide.classList.add('img-active');
    imgBiblioVide.classList.remove('img-hidden');
}

function afficherExplorer() {
    // explorer
    imgExplorerVide.classList.add('img-hidden');
    imgExplorerPlein.classList.remove('img-hidden');
    // accueil
    imgAccueilPlein.classList.add('img-hidden');
    imgAccueilPlein.classList.remove('img-active');
    imgAccueilVide.classList.add('img-active');
    imgAccueilVide.classList.remove('img-hidden');
    // biblio
    imgBiblioPlein.classList.add('img-hidden');
    imgBiblioPlein.classList.remove('img-active');
    imgBiblioVide.classList.add('img-active');
    imgBiblioVide.classList.remove('img-hidden');
}

function afficherBiblio() {
    // biblio    
    imgBiblioVide.classList.add('img-hidden');
    imgBiblioPlein.classList.remove('img-hidden');
    // accueil
    imgAccueilPlein.classList.add('img-hidden');
    imgAccueilPlein.classList.remove('img-active');
    imgAccueilVide.classList.add('img-active');
    imgAccueilVide.classList.remove('img-hidden');
    // explorer
    imgExplorerPlein.classList.add('img-hidden');
    imgExplorerPlein.classList.remove('img-active');
    imgExplorerVide.classList.add('img-active');
    imgExplorerVide.classList.remove('img-hidden');
}

btnAccueil.addEventListener('click', afficherAccueil);
btnExplorer.addEventListener('click', afficherExplorer);
btnBiblio.addEventListener('click', afficherBiblio);