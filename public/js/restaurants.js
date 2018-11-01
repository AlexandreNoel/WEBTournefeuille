var SESSION = "";
let filters = {
    score: -1,
    badge: '',
    category: '',
    favorite: false
};

$(document).ready(() => {

    getRestaurants();

    $('#score-filter').change(() => {
        filters.score = parseInt($('#score-filter').val());
        filterRestos();

    });
    $('#badge-filter').change(() => {
        filters.badge = $('#badge-filter').val();
        filterRestos();
    });
    $('#category-filter').change(() => {
        filters.category = $('#category-filter').val();
        filterRestos();

    });
    $('#favorites-filter').change(() => {
        filters.favorite = $('#favorites-filter').is(':checked');
        filterRestos();
    });
});

function getRestaurants() {

    $.ajax({
        url: 'https://localhost:8080/index_restaurant.php',
        type: 'GET'
    }).done(function (res) {
        res = JSON.parse(res);

        addAllCategories(res);
        buildContent(res);

    }).fail(function (error) {
        alert("Erreur");
    });
}


function addAllCategories(restaurants){
    let cats = restaurants.cats

    for (let i=0;i<cats.length;i++) {
        $('<option />', { value: cats[i], text: cats[i] }).appendTo($('#category-filter'));
    }
}

function filterRestos(){

    $.ajax({
        url: 'https://localhost:8080/filter-restaurant.php',
        type: 'GET',
        data:{
            score       : filters.score,
            badge       : filters.badge,
            categorie   : filters.category,
            favorite       : filters.favorite,
        }
    }).done(function (res) {
        res = JSON.parse(res);
        buildContent(res);
    }).fail(function (error) {
        alert("Erreur");
    });}

function buildContent(res) {
    const listRestos = $('#list-restaurants');
    const templateResto = $('#rest-template');

    listRestos.empty();
    listRestos.append(res.resto.map((restoData) => {
        let restoDiv = templateResto.clone();
        restoDiv.removeClass('hidden');


        restoDiv.find('#rest-link').attr('href', '/restaurants/' + restoData.id_resto);
        restoDiv.find('#rest-name').text(restoData.nom_resto);
        //restoDiv.find('#rest-cat').text(restoData.category);
        restoDiv.find('#rest-thumb').attr('src', restoData.thumbnail);
        if (restoData.favorite === true) {
            restoDiv.find('#rest-favorite').removeClass('hidden');
            restoDiv.find('#rest-unfavorite').addClass('hidden');
        } else if (restoData.favorite === false) {
            restoDiv.find('#rest-favorite').addClass('hidden');
            restoDiv.find('#rest-unfavorite').removeClass('hidden');
        } else {
            restoDiv.find('#rest-favorite').addClass('hidden');
            restoDiv.find('#rest-unfavorite').addClass('hidden');
        }

        let stars = [];
        for (let i = 0; i < 5; i++) {
            if (i < restoData.score)
                stars.push('<i class="fas fa-star"></i>');
            else
                stars.push('<i class="far fa-star"></i>');
        }
        restoDiv.find('#rest-score').empty();
        restoDiv.find('#rest-score').append(stars);

        /*let badges = restoData.badges.map((badge) => {
            let imageName = '';
            switch (badge) {
                case 'Bio':
                    imageName = 'icons8-salade-de-laitue-64.png';
                    break;
                case 'Vegan':
                    imageName = 'icons8-marque-végétarienne-48.png';
                    break;
                case 'Halal':
                    imageName = 'icons8-signe-halal-50.png';
                    break;
            }
            return `<img alt='${badge}'
            title='${badge}'
            src='/assets/images/icons_logo/${imageName}'/>`
        });*/
        restoDiv.find('#rest-badges').empty();
        //restoDiv.find('#rest-badges').append(badges);

        return restoDiv;
    }));
}