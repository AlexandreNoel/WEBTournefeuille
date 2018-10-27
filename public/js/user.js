function updateUser() {
    //get data from the form
    $.ajax({
        url: 'https://localhost:8080/update-user.php',
        type: 'POST',
        data: {
            id_user:1,
            nom_user: $('#nom_user').val(),
            prenom_user: $('#prenom_user').val(),
            promo_user: $('#promo_user').val(),
            mail_user: $('#mail_user').val(),
            secret_user: $('#secret_user').val(),
        }
    }).done(function () {
        window.location = '/restaurants';
    }).fail(function () {
    });
}