$("#add").click(function () {
    addRestaurant();
});

function addRestaurant() {
    //get data from the form
    $.ajax({
        url: 'https://localhost:8080/add-restaurant.php',
        type: 'POST',
        data: {
            nom_resto: $('#nom_resto').val(),
            descr_resto: $('#descr_resto').val(),
            addr_resto: $('#addr_resto').val(),
            cp_resto: $('#cp_resto').val(),
            city_resto: $('#city').val(),
            tel_resto: $('#tel').val(),
            website_resto: $('#web').val(),
            thumbnail: $('#filebutton').val()
        }
    }).done(function (res) {
        window.location = '/restaurants';
    }).fail(function (error) {
        alert("Erreur");
    });
}
