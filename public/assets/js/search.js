function productsShopHandler(divCategories,divProductsByCategories){
    divCategories.addEventListener()
}


/**
 *Initialise l'autocompletion
 * inp = Element input à focus
 * arr = Array contenant les élements à autocompléter
 * submit = Element de type submit
 */
function autocomplete(inp, arr,submit) {
    var currentFocus;

    // Déclencheur sur saise dans inp
    inp.addEventListener("input", function (e) {
        var a, b, i, val = this.value;

        // Fermeture préventif des anciennes saisies
        closeAllLists();
        if (!val) {
            return false;
        }
        currentFocus = -1;

        // Créationd d'un div contenant les users
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");

        // Ajout au parent du div
        this.parentNode.appendChild(a);

        // Pour chaque élément de l'arr
        for (i = 0; i < arr.length; i++) {
            // Vérification si la valeur de l'arr contient la valeur saisie en début de chaine
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                // Création d'un div pour ajout de la valeur à la liste
                b = document.createElement("DIV");
                // Lettres qui matchent en gras
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                // Insertion de la valeur
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";

                // Création de la fonction sur appui du bouton
                b.addEventListener("click", function (e) {
                    /*insert the value for the autocomplete text field:*/
                    inp.value = this.getElementsByTagName("input")[0].value;
                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });

    // Gestion des événements sur input
    inp.addEventListener("keydown", function (e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            // Incrémentation du focus et activation du bouton
            currentFocus++;
            addActive(x);
        } else if (e.keyCode == 38) { //up
            // Décrémentation du focus et activation du bouton
            currentFocus--;
            addActive(x);
        } else if (e.keyCode == 13) {
            // Prevent du form submit par défaut avec 'Entrée'
            e.preventDefault();
            if (currentFocus > -1) {
                // Simulation du click sur le bouton focus
                if (x) x[currentFocus].click();
                currentFocus=-1;
            }
            else{
                submit.click();
            }
        }
    });

    function addActive(x) {
        if (!x) return false;
        // Restauration
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);

        // Ajout de la classe active
        if(x[currentFocus] != undefined)
            x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
        // Suppression de la classe active
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }

    function closeAllLists(elmnt) {
        // Fermeture des listes possiblement affichées
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }

    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}
