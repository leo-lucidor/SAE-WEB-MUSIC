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

    // pour chaque .search-result si dans le content de .search_result p 
    // il y a la valeur de inputSearch alors on affiche le .search_result
    // sinon on le cache
    inputSearch.addEventListener('input', function() {
        var searchValue = inputSearch.value.toLowerCase();
        var searchResults = document.querySelectorAll('.search-result');

        searchResults.forEach(function(result) {
            var resultText = result.querySelector('p').textContent.toLowerCase();
            if (resultText.includes(searchValue)) {
                result.style.display = '';
            } else {
                result.style.display = 'none';
            }
        });

        var nbResults = document.querySelectorAll('.search-result:not([style="display: none;"])').length;
        var nbResultsText = document.querySelector('.nb-results');
        if (nbResults > 0) {
            if (nbResults == 1){
                nbResultsText.textContent = nbResults + ' résultat trouvé';
            } else { nbResultsText.textContent = nbResults + ' résultats trouvés'; }
        } else {
            nbResultsText.textContent = 'Auncun résultat trouvé';
        }
    });

});

