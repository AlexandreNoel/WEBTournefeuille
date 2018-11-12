$(document).ready(() => {


    if (window.location.pathname != "/form"){
        getUser();
    }


    $('[name="nom_user"]').focus();

    $('[name="nom_user"]').keyup(() => {
        checkInputs('nom_user');
    });
    $('[name="prenom_user"]').keyup(() => {
        checkInputs('prenom_user');
    });
    $('[name="promo_user"]').keyup(() => {
        checkInputs('promo_user');
    });
    $('[name="mail_user"]').keyup(() => {
        checkInputs('mail_user');
    });
    $('[name="secret_user_old"]').keyup(() => {
        checkInputs('secret_user_old');
    });
    $('[name="secret_user_new"]').keyup(() => {
        checkInputs('secret_user_new');
    });
    $('[name="secret_user_new2"]').keyup(() => {
        checkInputs('secret_user_new2');
    });
    $('[name="cancel"]').click(() => {
        window.location = '/restaurants';
    });
    $('[name="validate"]').click(() => {
        if (checkInputs())
            updateUser();
    });
});

function getUser() {
    const userId = window.location.pathname.match(/users\/([0-9]+)/)[1];

    $.ajax({
        url: 'https://localhost:8080/api/users/' + userId,
        type: 'GET',

    }).done(function (user) {
        redirectErrorCode(user);
        buildContent(user.data);
    }).fail(function (error) {
        alert("Erreur");
    });
}

function buildContent(user) {
    $('#nom_user').val(user.nom_user);
    $('#prenom_user').val(user.prenom_user);
    $('#promo_user').val(user.promo_user);
    $('#mail_user').val(user.mail_user);
    checkInputs();
}

function checkInputs(name = null) {
    let allOK = true;

    if (!name || name === 'nom_user') {
        const lastName = $('[name="nom_user"]').val();

        if (lastName.length >= 1) {
            $('[name="nom_user"]').parent().addClass('has-success');
            $('[name="nom_user"]').parent().removeClass('has-error');
        } else {
            $('[name="nom_user"]').parent().removeClass('has-success');
            $('[name="nom_user"]').parent().addClass('has-error');
            allOK = false;
        }
    }
    if (!name || name === 'prenom_user') {
        const firstName = $('[name="prenom_user"]').val();

        if (firstName.length >= 1) {
            $('[name="prenom_user"]').parent().addClass('has-success');
            $('[name="prenom_user"]').parent().removeClass('has-error');
        } else {
            $('[name="prenom_user"]').parent().removeClass('has-success');
            $('[name="prenom_user"]').parent().addClass('has-error');
            allOK = false;
        }
    }
    if (!name || name === 'promo_user') {
        const promo = $('[name="promo_user"]').val();

        if (promo.length >= 4) {
            $('[name="promo_user"]').parent().addClass('has-success');
            $('[name="promo_user"]').parent().removeClass('has-error');
        } else {
            $('[name="promo_user"]').parent().removeClass('has-success');
            $('[name="promo_user"]').parent().addClass('has-error');
            allOK = false;
        }
    }
    if (!name || name === 'mail_user') {
        const email = $('[name="mail_user"]').val();

        if (email.match(/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@(([0-9a-zA-Z])+([-\w]*[0-9a-zA-Z])*\.)+[a-zA-Z]{2,9})$/)) {
            $('[name="mail_user"]').parent().addClass('has-success');
            $('[name="mail_user"]').parent().removeClass('has-error');
        } else {
            $('[name="mail_user"]').parent().removeClass('has-success');
            $('[name="mail_user"]').parent().addClass('has-error');
            allOK = false;
        }
    }
    if (!name || name === 'secret_user_old' || name === 'secret_user_new' || name === 'secret_user_new2') {
        const oldPassDiv = $('[name="secret_user_old"]');
        const newPassDiv = $('[name="secret_user_new"]');
        const new2PassDiv = $('[name="secret_user_new2"]');
        const oldPass = oldPassDiv.val();
        const newPass = newPassDiv.val();
        const new2Pass = new2PassDiv.val();
        oldPassDiv.parent().removeClass('has-error');
        oldPassDiv.parent().removeClass('has-success');
        newPassDiv.parent().removeClass('has-error');
        newPassDiv.parent().removeClass('has-success');
        new2PassDiv.parent().removeClass('has-error');
        new2PassDiv.parent().removeClass('has-success');

        if (!oldPass.length && (newPass.length || new2Pass.length)) {
            oldPassDiv.parent().addClass('has-error');
            allOK = false;
        } else if(oldPass.length) {
            oldPassDiv.parent().addClass('has-success');
        }
        if (oldPass.length && !newPass.length) {
            newPassDiv.parent().addClass('has-error');
            allOK = false;
        }
        if (oldPass.length && !new2Pass.length) {
            new2PassDiv.parent().addClass('has-error');
            allOK = false;
        }
        if (newPass.length && newPass.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/)) {
            newPassDiv.parent().addClass('has-success');
        } else if(newPass.length) {
            newPassDiv.parent().addClass('has-error');
            allOK = false;
        }
        if (newPass !== new2Pass) {
            new2PassDiv.parent().addClass('has-error');
            allOK = false;
        } else if(newPass.length) {
            new2PassDiv.parent().addClass('has-success');
        }
    }

    $('[name="validate"]').prop('disabled', !allOK);
    return allOK;
}

function updateUser() {
    const userId = window.location.pathname.match(/users\/([0-9]+)/)[1];
    $('#user-update-spinner').removeClass('hidden');

    //get data from the form
    $.ajax({
        url: 'https://localhost:8080/api/users/' + userId,
        type: 'PUT',
        data: {
            id_user: userId,
            nom_user: $('#nom_user').val(),
            prenom_user: $('#prenom_user').val(),
            promo_user: $('#promo_user').val(),
            mail_user: $('#mail_user').val(),
            secret_user_old: $('#secret_user_old').val(),
            secret_user_new: $('#secret_user_new').val(),
            secret_user_new2: $('#secret_user_new2').val(),
        }
    }).done(function (res) {
        window.location = '/restaurants';
    }).fail(function () {
    }).always(() => {
        $('#user-update-spinner').addClass('hidden');
    });
}

function register() {
    $.ajax({
        url: 'https://localhost:8080/api/users',
        type: 'POST',
        data: {
            nom_user: $('#firstname_register').val(),
            prenom_user: $('#lastname_connect').val(),
            promo_user: $('#promo_register').val(),
            mail_user: $('#mail_register').val(),
            secret_user: $('#password_register').val(),
            confir_secret_user: $('#confirm_password').val()
        }
    }).done(function (res) {
        SESSION = res.session;
        setSession(SESSION);
        window.location = '/restaurants';
    }).fail(function () {
    });
}

function connect() {
    $.ajax({
        url: 'https://localhost:8080/user-connect.php',
        type: 'POST',
        data: {
            mail_user: $('#username_connect').val(),
            secret_user: $('#password_connect').val(),
        }
    }).done(function (res) {
        res = JSON.parse(res)
        SESSION = res.session;
        setSession(SESSION);
        window.location = '/restaurants';
    }).fail(function () {
    });
}
