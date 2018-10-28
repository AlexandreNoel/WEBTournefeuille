$(document).ready(() => {
    getUsers();

    $('#users-list tbody').click(() => {
        window.location = event.target.parentElement.getAttribute('href');
    });
});

function getUsers() {

    $.ajax({
        url: 'https://localhost:8080/index_user.php',
        type: 'GET'
    }).done(function (users) {
        users = JSON.parse(users)
        buildContent(users);
    }).fail(function (error) {
        alert("Erreur");
    });
}

function buildContent(users) {
    $('#users-list tbody').append(users.map((userData) => {
        const adminCheck = '<td><i class="fas fa-check text-success"></i></td>';
        const adminUncheck = '<td><i class="fas fa-times text-danger"></i></td>';

        return `
            <tr href="/users/${userData.id_user}">
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
