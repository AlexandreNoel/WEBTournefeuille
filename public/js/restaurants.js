let filters = {
    score: -1,
    badge: '',
    category: '',
    favorite: false
};

$(document).ready(() => {

    getRestaurants();

    $('#score-filter').change(() => {
        filters.score = parseInt($('#score-filter').val());
        getRestaurants();
    });
    $('#badge-filter').change(() => {
        filters.badge = $('#badge-filter').val();
        getRestaurants();
    });
    $('#category-filter').change(() => {
        filters.category = $('#category-filter').val();
        getRestaurants();
    });
    $('#favorites-filter').change(() => {
        filters.favorite = $('#favorites-filter').is(':checked');
        getRestaurants();
    });
});

function getRestaurants() {

    $.ajax({
        url: 'https://localhost:8080/index_restaurant.php',
        type: 'GET'
    }).done(function (res) {
        res = JSON.parse(res)
        buildContent(res);
    }).fail(function (error) {
        alert("Erreur");
    });

    console.log(filters);
    restaurants = [
        {
            id: 1,
            score: 5,
            name: 'Burger King',
            description: 'Un bon gros phat bien connu',
            category: 'Fast food',
            address: '3 rue de la boustifaille',
            postalCode: 91000,
            city: 'Evry',
            phone: '+331 23 45 67 89',
            website: 'https://www.burgerking.fr/',
            thumbnail: 'http://www.stickpng.com/assets/images/5842996fa6515b1e0ad75add.png',
            favorite: false,
            badges: [],
        },
        {
            id: 2,
            score: 2,
            name: 'Mc Do',
            description: 'Un peu moins bon',
            category: 'Fast food',
            address: '3 rue de la boustifaille',
            postalCode: 91000,
            city: 'Evry',
            phone: '+331 23 45 67 89',
            website: 'https://www.burgerking.fr/',
            thumbnail: 'https://upload.wikimedia.org/wikipedia/fr/thumb/e/ea/Mcdonalds_France_2009_logo.svg/1138px-Mcdonalds_France_2009_logo.svg.png',
            favorite: true,
            badges: ['Bio', 'Vegan'],
        },
        {
            id: 3,
            score: 0,
            name: 'Waffle',
            description: 'Berk',
            category: 'Chelou',
            address: '3 rue de la boustifaille',
            postalCode: 91000,
            city: 'Evry',
            phone: '+331 23 45 67 89',
            website: 'https://www.burgerking.fr/',
            thumbnail: 'https://content3.jdmagicbox.com/comp/delhi/s1/011pxx11.xx11.171205141322.i4s1/catalogue/the-waffle-factory-delhi-ht6if.jpg',
            favorite: null,
            badges: ['Bio', 'Halal', 'Vegan'],
        }
    ];

    
}

function buildContent(restaurants) {
    const listRestos = $('#list-restaurants');
    const templateResto = $('#rest-template');

    var cats = restaurants.cats

    for (i=0;i<cats.length;i++) {
        $('<option />', { value: cats[i], text: cats[i] }).appendTo($('#category-filter'));
    }

    

    listRestos.empty();
    listRestos.append(restaurants.resto.map((restoData) => {
        let restoDiv = templateResto.clone();
        restoDiv.removeClass('hidden');


        restoDiv.find('#rest-link').attr('href', '/restaurants/' + restoData.id_resto);
        restoDiv.find('#rest-name').text(restoData.nom_resto);
        //restoDiv.find('#rest-cat').text(restoData.category);
        restoDiv.find('#rest-thumb').attr('src', restoData.thumbnail);
        if (restoData.favorite === true) {
            restoDiv.find('#rest-favorite').removeClass('hidden');
            restoDiv.find('#rest-unfavorite').addClass('hidden');
        } else if (restoData.favorite === false) {
            restoDiv.find('#rest-favorite').addClass('hidden');
            restoDiv.find('#rest-unfavorite').removeClass('hidden');
        } else {
            restoDiv.find('#rest-favorite').addClass('hidden');
            restoDiv.find('#rest-unfavorite').addClass('hidden');
        }

        let stars = [];
        for (let i = 0; i < 5; i++) {
            if (i < restoData.score)
                stars.push('<i class="fas fa-star"></i>');
            else
                stars.push('<i class="far fa-star"></i>');
        }
        restoDiv.find('#rest-score').empty();
        restoDiv.find('#rest-score').append(stars);

        /*let badges = restoData.badges.map((badge) => {
            let imageName = '';
            switch (badge) {
                case 'Bio':
                    imageName = 'icons8-salade-de-laitue-64.png';
                    break;
                case 'Vegan':
                    imageName = 'icons8-marque-végétarienne-48.png';
                    break;
                case 'Halal':
                    imageName = 'icons8-signe-halal-50.png';
                    break;
            }
            return `<img alt='${badge}'
            title='${badge}'
            src='/assets/images/icons_logo/${imageName}'/>`
        });*/
        restoDiv.find('#rest-badges').empty();
        //restoDiv.find('#rest-badges').append(badges);

        return restoDiv;
    }));
}
