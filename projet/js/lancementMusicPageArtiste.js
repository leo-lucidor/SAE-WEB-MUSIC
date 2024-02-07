document.addEventListener('DOMContentLoaded', function () {
    const containers = document.querySelectorAll('.container-album-unique-artiste');

    // Array to store the list of songs
    let songs = ['./MUSIQUES/Folklore/Flutter.mp3', 'Song2.mp3', 'Song3.mp3'];
    let currentSongIndex = 0;
    let audio = new Audio(songs[currentSongIndex]);

    containers.forEach(function (container) {
        let estCliquer = false;
        const elementAMasquer = container.querySelector('.numero-album');
        const elementAAfficher = container.querySelector('.lancer-music');
        const pause = container.querySelector('.pause-music');

        // Ajout d'un écouteur d'événement pour le survol
        container.addEventListener('mouseover', function() {
            if (!estCliquer) {
                // Masquer l'élément lorsque survolé
                elementAMasquer.style.display = 'none';
                elementAAfficher.style.display = 'block';
            }
        });

        // Ajout d'un écouteur d'événement pour le passage de la souris hors de l'élément survolé
        container.addEventListener('mouseout', function() {
            if (!estCliquer) {
                // Afficher l'élément lorsque la souris n'est plus dessus
                elementAMasquer.style.display = 'block';
                elementAAfficher.style.display = 'none';
            }
        });

        elementAAfficher.addEventListener('click', function() {
            playSong();
            pause.style.display = 'block';
            elementAAfficher.style.display = 'none';
        });

        pause.addEventListener('click', function() {
            pauseSong();
            pause.style.display = 'none';
            elementAAfficher.style.display = 'block';
        });
    });

    
    // Function to play the current song
    function playSong() {
        audio.src = songs[currentSongIndex];
        audio.play();
    }
    
    // Function to play the next song
    function playNext() {
        if (currentSongIndex < songs.length - 1) {
            currentSongIndex++;
            playSong();
        } else {
            // If it's the last song, loop back to the first song
            currentSongIndex = 0;
            playSong();
        }
    }

    // Function to play the previous song
    function playPrevious() {
        if (currentSongIndex > 0) {
            currentSongIndex--;
            playSong();
        } else {
            // If it's the first song, loop back to the last song
            currentSongIndex = songs.length - 1;
            playSong();
        }
    }

    // Function to pause the current song
    function pauseSong() {
        audio.pause();
    }

});