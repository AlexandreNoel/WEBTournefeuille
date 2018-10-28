$(document).ready(() => {
    getUsers();
    $('#users-list tbody tr').click(() => {
        window.location = event.target.parentElement.getAttribute('href');
    });
});
let users = [];

function getUsers() {
    users = [
        {
            id: 1,
            firstName: 'Axel',
            lastName: 'Morvan',
            email: 'axel.morvan@ensiie.fr',
            promo: 2020,
            admin: false,
        },
        {
            id: 2,
            firstName: 'Axel',
            lastName: 'Morvan',
            email: 'axel.morvan@ensiie.fr',
            promo: 2019,
            admin: false,
        },
        {
            id: 3,
            firstName: 'Axel',
            lastName: 'Morvan',
            email: 'axel.morvan@ensiie.fr',
            promo: 2020,
            admin: true,
        },
        {
            id: 4,
            firstName: 'Axel',
            lastName: 'Morvan',
            email: 'axel.morvan@ensiie.fr',
            promo: 2020,
            admin: false,
        },
        {
            id: 5,
            firstName: 'Axel',
            lastName: 'Morvan',
            email: 'axel.morvan@ensiie.fr',
            promo: 2020,
            admin: true,
        },
    ];

    buildContent();
}

function buildContent() {
    $('#users-list tbody').append(users.map((user) => {
        const adminCheck = '<td><i class="fas fa-check text-success"></i></td>';
        const adminUncheck = '<td><i class="fas fa-times text-danger"></i></td>';
        return `
            <tr href="/users/${user.id}">
            <td>${user.id}</th>
            <td>${user.firstName}</td>
            <td>${user.lastName}</td>
            <td>${user.email}</td>
            <td>${user.promo}</td>
            ${user.admin ? adminCheck : adminUncheck}
            </tr>
        `;
    }));
}
