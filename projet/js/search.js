document.addEventListener('DOMContentLoaded', function () {
    var inputSearch = document.querySelector('.input_search');
    var crossIcon = document.querySelector('.cross_icon');
    var navBar = document.querySelector('.nav_bar'); // Remplacez '.nav_bar' par la classe réelle de votre barre de navigation

    // Restaurer la valeur précédente du champ de recherche depuis le localStorage
    var search = localStorage.getItem('searchValue') || '';
    localStorage.removeItem('searchValue');
    inputSearch.value = search || '';
    inputSearch.focus();
    inputSearch.setSelectionRange(search.length, search.length);

    inputSearch.addEventListener('input', function () {
        if (inputSearch.value.trim() !== '') {
            crossIcon.style.opacity = '1';
        } else {
            crossIcon.style.opacity = '0';
        }
    });

    crossIcon.addEventListener('click', function () {
        inputSearch.value = '';
        crossIcon.style.opacity = '0';
    });

    inputSearch.addEventListener('input', function () {
        var search = inputSearch.value;
        console.log(search.trim());
        if (search.trim() !== '' && !window.location.href.includes('explorer')) {
            // Sauvegarder la valeur du champ de recherche dans le localStorage
            localStorage.setItem('searchValue', search);
            window.location.href = 'index.php?action=explorer';
        } else if (search.trim() === '' && window.location.href.includes('explorer')) {
            window.location.href = 'index.php?action=accueil';
        }
    });

    

});

