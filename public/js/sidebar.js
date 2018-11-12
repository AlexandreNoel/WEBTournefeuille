const admin_li = ['menu_add_restaurant', 'menu_users'];
const co_li = ['menu_home', 'menu_user', 'menu_disconnect'];
const deco_li = ['menu_form'];


$(document).ready(() => {
    postSession();
    reloadSideBar();
    loadUserSideBar();

    $('.navbar li').removeClass('selected');
    const path = window.location.pathname;
    if (path === '/')
        $('#menu_home').addClass('selected');
    else if (path.match(/\/restaurants\/[0-9]+/))
        $('#menu_home').addClass('selected');
    else if (path === '/restaurants/add')
        $('#menu_add_restaurant').addClass('selected');
    else if (path.match(/\/users\/[0-9]+/))
        $('#menu_user').addClass('selected');
    else if (path === '/users')
        $('#menu_users').addClass('selected');
});

var k = [38, 38, 40, 40, 37, 39, 37, 39, 66, 65],
    n = 0;
$(document).keydown(function (e) {
    if (e.keyCode === k[n++]) {
        if (n === k.length) {
            $('#coucou').toggleClass('hidden');
            n = 0;
            return false;
        }
    } else if (e.keyCode === 38) {
        n = 1;
    } else {
        n = 0;
    }
});

function loadUserSideBar(){
    idUser = getSession()['id'];
    $("#user_acc").attr("href", "/users/"+idUser); // Set herf value
}
function loadUserInfo(){
    userInfo = getSession()['name'] + " ["+getSession()['id']+"]";
    $("#user_info").text(userInfo);
}
function hideIfNotAdmin() {

    $('#menu_list li').each(function () {
        if (admin_li.includes(this.id)) {
            $($(this)[0]).hide();
        };
    });
}

function showDeconnected() {
    $('#menu_list li').each(function () {
        if (co_li.includes(this.id)) {
            $($(this)[0]).hide();
        };
    });
}

function showConnected() {
    $('#menu_list li').each(function () {
        if (deco_li.includes(this.id)) {
            $($(this)[0]).hide();
        };
    });
}

function reloadSideBar() {
    $('#menu_list li').each(function () {
            $($(this)[0]).show();
    });

    if (getSession()['uniqid']) {
        showConnected();
        if (getSession()['isadmin'] === "false") {
            hideIfNotAdmin();
        }

    } else {
        hideIfNotAdmin();
        showDeconnected();
    }
}
