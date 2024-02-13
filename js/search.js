document.addEventListener('DOMContentLoaded', function () {
    var inputSearch = document.querySelector('.input_search');
    var crossIcon = document.querySelector('.cross_icon');

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
            window.location.href = 'index.php?action=explorer&search=Tout';
        }
    });

    // pour chaque .search-result si dans le contenu de .search-result p 
// ou dans le texte des cellules de tableau il y a la valeur de inputSearch, alors on affiche le .search-result
// sinon on le cache
inputSearch.addEventListener('input', function() {
    var searchValue = inputSearch.value.toLowerCase();
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

        if (resultText.includes(searchValue)) {
            result.style.display = ''; // Affiche le .search-result
        } else {
            result.style.display = 'none'; // Cache le .search-result
        }
    });

    var nbResults = document.querySelectorAll('.search-result:not([style="display: none;"])').length;
    var nbResultsText = document.querySelector('.nb-results');
    if (nbResults > 0) {
        if (nbResults == 1){
            nbResultsText.textContent = nbResults + ' résultat trouvé';
        } else { nbResultsText.textContent = nbResults + ' résultats trouvés'; }
    } else {
        nbResultsText.textContent = 'Aucun résultat trouvé';
    }
});


});

