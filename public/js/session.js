function setSession(session){
    $.each(session, function (key, value) {
        localStorage.setItem(key,value);
    });
    reloadSideBar();
}
function getSession() {
    return localStorage;
}

function clearSession() {
    getSession().clear();
    reloadSideBar();
}

function postSession() {
    if (!getSession()['id']) {
        return;
    }
    $.ajax({
        url: 'https://localhost:8080/synchro-session.php',
        type: 'POST',
        data: {
            session: JSON.stringify(getSession())
        }
    }).done(function (res) {
    }).fail(function (error) {
        alert("Erreur");
    });
}
function checkIfAdmin(id_admin) {
    if (!getSession()['isadmin']) {
        console.log("is not admin");
        $(id_admin).hide();
    }
}

function redirectErrorCode(res) {
    if (res.errorcode) {
        error_code = res.errorcode;
    } else {
        error_code = JSON.parse(res)['errorcode'];
    }

    if (error_code == '401') {
        swal({
            type: 'error',
            title: 'Attention',
            text: "Redirection... Non connecté"
        }).then(() => {

        });
        window.location = '/forms';

    } else if (error_code == '403') {
        swal({
            type: 'error',
            title: 'Attention',
            text: "Redirection... Non autorisé"
        })
        window.location = '/403';

    } else if (error_code == '200') {
    }
}