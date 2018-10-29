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
