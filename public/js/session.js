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