var SESSION = "";
let filters = {
    score: -1,
    badge: '',
    category: '',
    favorite: false
};

let allRestaurants;
let favoriteRestaurants = null;
let categoryRestaurants = null;
let badgeRestaurants = null;
let scoreRestaurant = null;

$(document).ready(() => {

    getRestaurants();

    $('#score-filter').change(() => {
        filters.score = parseInt($('#score-filter').val());
        buildContent();
    });
    $('#badge-filter').change(() => {
        filters.badge = $('#badge-filter').val();
        buildContent();
    });
    $('#category-filter').change(() => {
        filters.category = $('#category-filter').val();
        buildContent();
    });
    $('#favorites-filter').change(() => {
        filters.favorite = $('#favorites-filter').is(':checked');
        favoriteRestaurants = filters.favorite ? getFavorites() :  null;
        buildContent();
    });
});

function getRestaurants() {
    let restaurants = null;

    $.ajax({
        url: 'https://localhost:8080/index_restaurant.php',
        type: 'GET'
    }).done(function (res) {
        res = JSON.parse(res);
        allRestaurants = res.resto;
        addAllCategories(res);
        buildContent(res);
    }).fail(function (error) {
        alert("Erreur");
    });
}

function getFavorites() {

    $.ajax({
        url: 'https://localhost:8080/favorites-user.php',
        type: 'GET'
    }).done(function (res) {
        res = JSON.parse(res);

        favoriteRestaurants = res.resto;
        buildContent();
    }).fail(function (error) {
        alert("Erreur");
    });
}

function getCommonRestos(array1, array2){
    var arrayResult = [];

    array1.forEach((element1) =>{
        array2.forEach((element2) =>{
            if(element1.id_resto == element2.id_resto){
                arrayResult.push(element1);
                return false;
            }
        })
    });

    return arrayResult;
}

function filterRestos(){
    var listRestos = allRestaurants;

    listRestos = favoriteRestaurants    != null?  getCommonRestos(favoriteRestaurants, listRestos)  : listRestos;
    listRestos = badgeRestaurants       != null?  getCommonRestos(badgeRestaurants, listRestos)     : listRestos;
    listRestos = categoryRestaurants    != null?  getCommonRestos(categoryRestaurants, listRestos)  : listRestos;
    listRestos = scoreRestaurant        != null?  getCommonRestos(scoreRestaurant, listRestos)      : listRestos;

    return listRestos;
}

function buildContent() {
    const restoToDisplay = filterRestos();

    const listRestos = $('#list-restaurants');
    const templateResto = $('#rest-template');

    listRestos.empty();
    listRestos.append(restoToDisplay.map((restoData) => {
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

function addAllCategories(restaurants){
    let cats = restaurants.cats

    for (let i=0;i<cats.length;i++) {
        $('<option />', { value: cats[i], text: cats[i] }).appendTo($('#category-filter'));
    }
}
