document.addEventListener('DOMContentLoaded', function () {
    var inputSearch = document.querySelector('.input_search');
    var crossIcon = document.querySelector('.cross_icon');
    var navLinks = document.querySelectorAll('.navbar-item a');

    // stocker la valeur de la barre de recherche lorsqu'un élément du nav est cliqué
    navLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            localStorage.setItem('searchValue', inputSearch.value);
        });
    });

    // restaurer la valeur précédente du champ de recherche depuis le localStorage
    var search = localStorage.getItem('searchValue') || '';
    localStorage.removeItem('searchValue');
    inputSearch.value = search || '';
    inputSearch.focus();
    inputSearch.setSelectionRange(search.length, search.length);

    // fonction pour gérer les changements de la barre de recherche
    function handleSearchChange() {
        if (inputSearch.value.trim() !== '') {
            crossIcon.style.opacity = '1';
        } else {
            crossIcon.style.opacity = '0';
        }

        var search = inputSearch.value.toLowerCase();
        var searchResults = document.querySelectorAll('.search-result');

        searchResults.forEach(function(result) {
            var resultText = '';
            var paragraph = result.querySelector('p');
            var tableCells = result.querySelectorAll('td');

            if (paragraph) {
                resultText = paragraph.textContent.toLowerCase();
            } else {
                tableCells.forEach(function(cell) {
                    resultText += cell.textContent.toLowerCase() + ' ';
                });
            }

            if (resultText.includes(search)) {
                result.style.display = '';
            } else {
                result.style.display = 'none';
            }
        });

        var nbResultsText = document.querySelector('.nb-results');
        if (nbResultsText) {
            var nbResults = document.querySelectorAll('.search-result:not([style="display: none;"])').length;
            if (nbResults > 0) {
                if (nbResults == 1){
                    nbResultsText.textContent = nbResults + ' résultat trouvé';
                } else { nbResultsText.textContent = nbResults + ' résultats trouvés'; }
            } else {
                nbResultsText.textContent = 'Aucun résultat trouvé';
            }
        }

        var containersList = document.querySelectorAll('div[class^="container-results-"]:not(.container-results-all)');
        containersList.forEach(function(container) {
            var h2 = container.querySelector('h2');
            var table = container.querySelector('table');
            var results = container.querySelectorAll('.search-result:not([style="display: none;"])');
            if (results.length > 0) {
                h2.style.display = '';
                if (table) {
                    table.style.display = '';
                }
            } else {
                h2.style.display = 'none';
                if (table) {
                    table.style.display = 'none';
                }
            }
        });

        // afficher "Aucun résultat trouvé" si aucun resultat n'est trouvé
        var allResults = document.querySelectorAll('.search-result');
        var allResultsFound = true;
        allResults.forEach(function(result) {
            if (result.style.display !== 'none') {
                allResultsFound = false;
            }
        });
        var noResult = document.querySelector('.no-result');
        if (noResult) {
            if (allResultsFound) {
                noResult.style.display = '';
            } else {
                noResult.style.display = 'none';
            }
        }
    }

    handleSearchChange();

    // barre de recherche
    inputSearch.addEventListener('input', handleSearchChange);
    crossIcon.addEventListener('click', function () {
        inputSearch.value = '';
        crossIcon.style.opacity = '0';
        handleSearchChange();
    });

    inputSearch.addEventListener('input', function () {
        var search = inputSearch.value;
        console.log(search.trim());
        if (search.trim() !== '' && !window.location.href.includes('explorer')) {
            localStorage.setItem('searchValue', search);
            window.location.href = 'index.php?action=explorer&search=Tout';
        }
    });
});