document.addEventListener('DOMContentLoaded', function () {

const btnInscription = document.getElementById('btn-inscription');
const btnConnexion = document.getElementById('btn-connexion');
const inscriptionForm = document.getElementById('inscription-form');
const connexionForm = document.getElementById('connexion-form');

function affichageInscription() {
    btnInscription.style.display = 'block';
    btnConnexion.style.display = 'none';
    inscriptionForm.style.display = 'flex';
    connexionForm.style.display = 'none';
}

function affichageConnexion() {
    btnInscription.style.display = 'none';
    btnConnexion.style.display = 'block';
    inscriptionForm.style.display = 'none';
    connexionForm.style.display = 'flex';
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