document.addEventListener('DOMContentLoaded', function () {
    const containers = document.querySelectorAll('.container-album-unique-artiste');

    containers.forEach(function (container) {
        const elementAMasquer = container.querySelector('.numero-album');
        const elementAAfficher = container.querySelector('.lancer-music');

        // Ajout d'un écouteur d'événement pour le survol
        container.addEventListener('mouseover', function() {
            // Masquer l'élément lorsque survolé
            elementAMasquer.style.display = 'none';
            elementAAfficher.style.display = 'block';
        });

        // Ajout d'un écouteur d'événement pour le passage de la souris hors de l'élément survolé
        container.addEventListener('mouseout', function() {
            // Afficher l'élément lorsque la souris n'est plus dessus
            elementAMasquer.style.display = 'block';
            elementAAfficher.style.display = 'none';
        });

    });
});