$(document).ready(() => {
    getRestaurant();
});

function getRestaurant() {
    const restaurantId = window.location.pathname.match(/update\/([0-9]+)/)[1];

    $.ajax({
        url: 'https://localhost:8080/description-restaurant.php',
        type: 'GET',
        data: { id_resto: restaurantId }
    }).done(function (res) {
        console.log(res);
        res = JSON.parse(res);
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

function updateRestaurant(){

    const restaurantId = window.location.pathname.match(/update\/([0-9]+)/)[1];

    //get data from the form
    $.ajax({
        url: 'https://localhost:8080/update-restaurant.php',
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
            thumbnail: $('#filebutton').val()
        }
    }).done(function () {
        window.location = '/restaurants';
    }).fail(function () {
    });
}