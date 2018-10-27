$("#add").click(function () {
    addRestaurant();
});

function addRestaurant() {
    //get data from the form
    $.ajax({
        url: 'https://localhost:8080/add-restaurant.php',
        type: 'POST',
        data: { nom_resto: $('#product_id').val(),
                descr_resto: $('#product_description').val(),
                addr_resto: $('#product_name').val(),
                cp_resto: $('#product_name_fr').val(),
                city_resto: $('#city').val(),
                tel_resto: $('#tel').val(),
                website_resto: $('#web').val(),
                thumbnail: $('#filebutton').val() }
    }).done(function (res) {
        window.location = '/restaurants';
        }).fail(function (error) {
            alert("Erreur");
        });
}