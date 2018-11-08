$(document).ready(() => {
    if (getSession()['isadmin'] === 'false') {
        res = [];
        res.errorcode = '403';
        redirectErrorCode(res);
    }

    getUsers();

    $('#users-list tbody').click((event) => {
        if (event.target.parentElement.nodeName != 'TD'){
           window.location = event.target.parentElement.getAttribute('href');
        }else{
            const id = event.target.parentElement.parentElement.id;
            updateUserRight(id);
        }
    });
});

function updateUserRight(id){
    $.ajax({
        url: 'https://localhost:8080/user-updateRight.php',
        type: 'PUT',
        data: {id_user:id}
    }).done(function () {
        location.reload();
    }).fail(function (error) {
        alert("Erreur :"+ error);
    });
}
function getUsers() {

    $.ajax({
        url: 'https://localhost:8080/api/users',
        type: 'GET'
    }).done(function (users) {
        redirectErrorCode(users); 
        buildContent(users.data);
    }).fail(function (error) {
        alert("Erreur");
    });
}

function buildContent(users) {
    $('#users-list tbody').append(users.map((userData) => {
        const adminCheck = '<td class="admin"><i class="fas fa-check text-success"></i></td>';
        const adminUncheck = '<td class="admin"><i class="fas fa-times text-danger"></i></td>';

        return `
            <tr id="${userData.id_user}" href="/users/${userData.id_user}">
            <td>${userData.id_user}</th>
            <td>${userData.prenom_user}</td>
            <td>${userData.nom_user}</td>
            <td>${userData.mail_user}</td>
            <td>${userData.promo_user}</td>
            ${userData.isadmin == 'TRUE' ? adminCheck : adminUncheck}
            </tr>
        `;
    }));
}
