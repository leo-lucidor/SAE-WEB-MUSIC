document.addEventListener('DOMContentLoaded', function () {
    const containers = document.querySelectorAll('.container-album-unique-artiste');

    let currentSongIndex = 0; // sert a rien

    let titreMusique = document.querySelector('.titre-musique-lecteur');
    let artisteMusique = document.querySelector('.nom-artiste-lecteur');
    let imageMusique = document.querySelector('.pochette');

    let listeMusiques = [];
    let lienMusiqueActuel = '';
    let audio = new Audio();
    let currentSongTime = 0;

    let listeBtnPlay = [];
    let listeBtnPause = [];
    let listeNumeroMusique = [];

    // volume
    let sliderVolume = document.getElementById("slider-volume");

    // Fonction pour ajuster le volume
    sliderVolume.oninput = function() {
        // Obtenir la valeur du sliderVolume
        var volume = this.value;

        // Mettre à jour le volume dans votre application ou lecteur audio
        updateVolume(volume);
    }

    // Fonction pour mettre à jour le volume (à adapter selon votre application)
    function updateVolume(volume) {
        audio.volume = volume / 100;
    }


    containers.forEach(function (container) {
        const numeroMusique = container.querySelector('.numero-album');
        listeNumeroMusique.push(numeroMusique);
        const play = container.querySelector('.lancer-music');
        listeBtnPlay.push(play);
        const pause = container.querySelector('.pause-music');
        listeBtnPause.push(pause);
        
        const infoMusique =  JSON.parse(container.querySelector('.info-musique').textContent);
        const infoAlbum =  JSON.parse(container.querySelector('.info-album').textContent);
        const infoArtiste =  JSON.parse(container.querySelector('.info-artiste').textContent);

        listeMusiques.push(infoMusique); 
        // console.log(infoMusique);

        // Ajout d'un écouteur d'événement pour le survol
        container.addEventListener('mouseover', function() {
            if (lienMusiqueActuel != infoMusique.Lien) {
                // Masquer l'élément lorsque survolé
                numeroMusique.style.display = 'none';
                play.style.display = 'block';
            }
        });

        // Ajout d'un écouteur d'événement pour le passage de la souris hors de l'élément survolé
        container.addEventListener('mouseout', function() {
            if (lienMusiqueActuel != infoMusique.Lien) {
                // Afficher l'élément lorsque la souris n'est plus dessus
                numeroMusique.style.display = 'block';
                play.style.display = 'none';
            }
        });

        play.addEventListener('click', function() {
            console.log(infoMusique);
            console.log(infoAlbum);
            console.log(infoArtiste);
  
            if (lienMusiqueActuel != infoMusique.Lien) {
                currentSongTime = 0;
                lienMusiqueActuel = infoMusique.Lien;
            }
            for (let i = 0; i < listeBtnPlay.length; i++) {
                listeBtnPlay[i].style.display = 'none';
                listeBtnPause[i].style.display = 'none';
                listeNumeroMusique[i].style.display = 'block';
            }   
            playSong();
            play.style.display = 'none';
            pause.style.display = 'block';
            numeroMusique.style.display = 'none';

            titreMusique.textContent = infoMusique.Titre;
            let titreAlbum = infoAlbum.Pochette.split(" ")[1];
            console.log("./images/ALBUMS/"+titreAlbum+".jpg");
            imageMusique.src = "./images/ALBUMS/"+titreAlbum;
        });

        pause.addEventListener('click', function() {
            pauseSong();
            pause.style.display = 'none';
            play.style.display = 'block';
        });
    });

    
    // Function to play the current song
    function playSong() {
        audio.src = lienMusiqueActuel;
        audio.currentTime = currentSongTime; 
        audio.play();
    }
    
    // Function to play the next song
    function playNext() {
        if (currentSongIndex < songs.length - 1) {
            currentSongIndex++;
            currentSongTime = 0;
            playSong();
        } else {
            // If it's the last song, loop back to the first song
            currentSongIndex = 0;
            currentSongTime = 0;
            playSong();
        }
    }

    // Function to play the previous song
    function playPrevious() {
        if (currentSongIndex > 0) {
            currentSongIndex--;
            currentSongTime = 0;
            playSong();
        } else {
            // If it's the first song, loop back to the last song
            currentSongIndex = songs.length - 1;
            currentSongTime = 0;
            playSong();
        }
    }

    // Function to pause the current song
    function pauseSong() {
        currentSongTime = audio.currentTime;
        audio.pause();
    }

});