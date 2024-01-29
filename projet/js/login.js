document.addEventListener('DOMContentLoaded', function () {

const btnInscription = document.getElementById('btn-inscription');
const btnConnexion = document.getElementById('btn-connexion');
const inscriptionForm = document.getElementById('inscription-form');
const connexionForm = document.getElementById('connexion-form');
const subtitleConnexion = document.getElementById('subtitle-connexion');
const subtitleInscription = document.getElementById('subtitle-inscription');

function affichageInscription() {
    inscriptionForm.style.display = 'flex';
    connexionForm.style.display = 'none';
    subtitleConnexion.style.display = 'none';
    subtitleInscription.style.display = 'flex';
}

function affichageConnexion() {
    inscriptionForm.style.display = 'none';
    connexionForm.style.display = 'flex';
    subtitleConnexion.style.display = 'flex';
    subtitleInscription.style.display = 'none';
}

btnInscription.addEventListener('click', affichageInscription);
btnConnexion.addEventListener('click', affichageConnexion);


function togglePasswordVisibility() {
    var passwordInput = document.getElementById('password');
    var toggleIcon = document.getElementById('toggle-password');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.textContent = '🙈'; // Change icon or text accordingly
    } else {
        passwordInput.type = 'password';
        toggleIcon.textContent = '👁️'; // Change icon or text accordingly
    }
}


});