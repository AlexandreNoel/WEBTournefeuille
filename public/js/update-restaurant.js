$(document).ready(() => {
    const restaurantId = window.location.pathname.match(/update\/([0-9]+)/)[1];

    getCategories();
    getBadges();
    getRestaurant(restaurantId);

    getCategory(restaurantId);
    getBadge(restaurantId);

    $('#save-restaurant').click( () =>{
        updateRestaurant(restaurantId);
    })

});

function getRestaurant(restaurantId) {
    $.ajax({
        url: 'https://localhost:8080/api/restaurants/' + restaurantId,
        type: 'GET',
    }).done(function (res) {
        redirectErrorCode(res);
        buildContent(res.data);
    }).fail(function (error) {
        alert("Erreur");
    });

}

function buildContent(restaurant) {
    $('#nom_resto').val(restaurant.nom_resto);
    $('#descr_resto').val(restaurant.descr_resto);
    $('#addr_resto').val(restaurant.addr_resto);
    $('#cp_resto').val(restaurant.cp_resto);
    $('#city').val(restaurant.city_resto);
    $('#tel').val(restaurant.tel_resto);
    $('#web').val(restaurant.website_resto);
    $('#filebutton').val(restaurant.thumbnail);
}

function updateRestaurant(restaurantId){

    //get data from the form
    $.ajax({
        url: 'https://localhost:8080/api/restaurants/' +restaurantId,
        type: 'PUT',
        data: {
            id_resto:restaurantId,
            nom_resto: $('#nom_resto').val(),
            descr_resto: $('#descr_resto').val(),
            addr_resto: $('#addr_resto').val(),
            cp_resto: $('#cp_resto').val(),
            city_resto: $('#city').val(),
            tel_resto: $('#tel').val(),
            website_resto: $('#web').val(),
            thumbnail: $('#filebutton').val(),
            categorie: $('#type_resto option:selected').text(),
            badges : getCheckedBadges()
        }
    }).done(function () {
        window.location = '/restaurants';
    }).fail(function () {
    });
}


function getCategories() {
    $.ajax({
        url: 'https://localhost:8080/api/categories',
        type: 'GET'
    }).done(function (res) {
        addAllCategories(res.data);
    }).fail(function (error) {
        alert("Erreur");
    });
}

function getBadges() {
    $.ajax({
        url: 'https://localhost:8080/api/badges',
        type: 'GET'
    }).done(function (res) {
        addAllBadges(res.data);
    }).fail(function (error) {
        alert("Erreur");
    });
}

function addAllCategories(categories) {

    for (let i = 0; i < categories.length; i++) {
        $('<option />', { value: categories[i].nom_cat, text: categories[i].nom_cat }).appendTo($('#type_resto'));
    }
}

function addCheckbox(name,id) {
    var container = $('#badge_resto');

    $('<input />', { type: 'checkbox',id: id, name:'badges', value: name }).appendTo(container);
    $('<label />', { text: name }).appendTo(container);
    $('</br>').appendTo(container);

}

function addAllBadges(badges) {

    for (let i = 0; i < badges.length; i++) {
        addCheckbox(badges[i].nom_badge, badges[i].id_badge);
    }
}

function getCategory(restaurantId) {
    $.ajax({
        url: 'https://localhost:8080/get-category.php',
        type: 'GET',
        data: {
            id_resto: restaurantId
        }
    }).done(function (cat) {
        cat = JSON.parse(cat);
        updateCategorie(cat.category);

    }).fail(function (error) {
        alert("Erreur");
    });
}

function getBadge(restaurantId) {
    $.ajax({
        url: 'https://localhost:8080/get-badges.php',
        type: 'GET',
        data: {
            id_resto: restaurantId
        }
    }).done(function (badge) {
        badge = JSON.parse(badge);
        updateBadges(badge.badges);

    }).fail(function (error) {
        alert("Erreur");
    });
}

function updateCategorie(cat_name){
    $('#type_resto').val(cat_name);
}

function updateBadges(badges) {
    for (let i = 0; i < badges.length; i++) {
        $('#badge_resto').find('#' + badges[i][0]).prop('checked', true);
    }
}

function getCheckedBadges() {
    var selected = [];
    $('#badge_resto input:checked').each(function () {
        selected.push($(this).attr('id'));
    });
    return selected;
}
