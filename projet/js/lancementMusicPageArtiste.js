document.addEventListener('DOMContentLoaded', function () {
    const containers = document.querySelectorAll('.container-album-unique-artiste');

    // Array to store the list of songs
    let listeMusiques = [];
    let lienMusiqueActuel = '';
    let currentSongIndex = 0; // sert a rien
    let audio = new Audio();
    let currentSongTime = 0;

    containers.forEach(function (container) {
        let estCliquer = false;
        const elementAMasquer = container.querySelector('.numero-album');
        const play = container.querySelector('.lancer-music');
        const pause = container.querySelector('.pause-music');
        
        const infoMusique =  JSON.parse(container.querySelector('.info-musique').textContent);
        listeMusiques.push(infoMusique); 
        console.log(infoMusique);

        // Ajout d'un écouteur d'événement pour le survol
        container.addEventListener('mouseover', function() {
            if (!estCliquer) {
                // Masquer l'élément lorsque survolé
                elementAMasquer.style.display = 'none';
                play.style.display = 'block';
            }
        });

        // Ajout d'un écouteur d'événement pour le passage de la souris hors de l'élément survolé
        container.addEventListener('mouseout', function() {
            if (!estCliquer) {
                // Afficher l'élément lorsque la souris n'est plus dessus
                elementAMasquer.style.display = 'block';
                play.style.display = 'none';
            }
        });

        play.addEventListener('click', function() {
            if (lienMusiqueActuel != infoMusique.Lien) {
                currentSongTime = 0;
                lienMusiqueActuel = infoMusique.Lien;
            }
            playSong();
            estCliquer = true;
            play.style.display = 'none';
            pause.style.display = 'block';
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