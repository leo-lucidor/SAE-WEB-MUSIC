<link rel="stylesheet" href="./css/lecteurMusique.css">

<div class="container-lecteur" style="display:none">
    <div class="container-lecteur-left">
        <img class="pochette" src="images/ALBUMS/default.jpg" alt="pochette">
        <div class="container-lecteur-bottom-left-bottom">
            <p class="titre-musique-lecteur">Titre</p>
            <p class="nom-artiste-lecteur">Artiste</p>
        </div>
    </div>
    <div class="container-lecteur-milieu">
        <div class="container-lecteur-milieu-top">
            <button id="btn-previous"><img class="icon" src="./images/LECTEUR/precedentLecteur.png" alt=""></button>
            <button id="btn-play" style="display:none"><img class="icon imgPlay" src="./images/LECTEUR/playLecteur.png" alt=""></button>
            <button id="btn-pause"><img class="icon imgPause" src="./images/LECTEUR/pauseLecteur.png" alt=""></button>
            <button id="btn-next"><img class="icon" src="./images/LECTEUR/suivantLecteur.png" alt=""></button>
        </div>
        <div class="container-lecteur-milieu-bottom">
            <p class="temps-lecture">0:00</p>
            <input type="range" min="0" max="100" value="0" class="slider-lecture" id="slider-lecture">
            <p class="temps-total">0:00</p>
        </div>
    </div>
    <div class="container-lecteur-right">
        <input type="range" min="0" max="100" value="50" class="slider-volume" id="slider-volume">
    </div>
</div>