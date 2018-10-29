function setSession(session){
    $.each(session, function (key, value) {
        localStorage.setItem(key,value);
    });
}
function getSession() {
    //console.log(localStorage);
    return localStorage;
}