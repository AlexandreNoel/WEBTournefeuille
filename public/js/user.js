$(document).ready(() => {
    getUser();
});

function getUser() {
    const userId = window.location.pathname.match(/users\/([0-9]+)/)[1];

    $.ajax({
        url: 'https://localhost:8080/account-user.php',
        type: 'GET',
        data: {
            id_user: userId,
        }

    }).done(function (user) {
        user = JSON.parse(user)
        buildContent(user);
    }).fail(function (error) {
        alert("Erreur");
    });
}

function buildContent(user) {
    $('#nom_user').val(user.nom_user);
    $('#prenom_user').val(user.prenom_user);
    $('#promo_user').val(user.promo_user);
    $('#mail_user').val(user.mail_user);
}

function updateUser() {
    const userId = window.location.pathname.match(/users\/([0-9]+)/)[1];

    //get data from the form
    $.ajax({
        url: 'https://localhost:8080/update-user.php',
        type: 'PUT',
        data: {
            id_user: userId,
            nom_user: $('#nom_user').val(),
            prenom_user: $('#prenom_user').val(),
            promo_user: $('#promo_user').val(),
            mail_user: $('#mail_user').val(),
            secret_user: $('#secret_user').val(),
            confirm_secret_user: $('#confirm_secret_user').val(),
        }
    }).done(function () {
        window.location = '/restaurants';
    }).fail(function () {
    });
}

function register() {
    $.ajax({
        url: 'https://localhost:8080/register.php',
        type: 'POST',
        data: {
            nom_user: $('#firstname_register').val(),
            prenom_user: $('#lastname_connect').val(),
            promo_user: $('#promo_register').val(),
            mail_user: $('#mail_register').val(),
            secret_user: $('#password_register').val(),
            confir_secret_user: $('#confirm_password').val()
        }
    }).done(function () {
        window.location = '/restaurants';
    }).fail(function () {
    });
}

function connect() {
    $.ajax({
        url: 'https://localhost:8080/connect.php',
        type: 'POST',
        data: {
            mail_user: $('#username_connect').val(),
            secret_user: $('#password_connect').val(),
        }
    }).done(function () {
        window.location = '/restaurants';
    }).fail(function () {
    });
}