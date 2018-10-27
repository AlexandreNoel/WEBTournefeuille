let restaurants = [];
let error = null;

getRestaurants((err, restaurants) => {
    if (err) {
        error = 'An error occured';
    } else {
        $(document).ready(() => {
            const listRestos = $('#list-restaurants');
            const templateResto = $('#rest-template');

            listRestos.append(restaurants.map((restoData) => {
                let restoDiv = templateResto.clone();
                restoDiv.removeClass('hidden');


                //restoDiv.find('#rest-link').attr('href', '/restaurants/' + restoData.id);
                restoDiv.find('#rest-name').text(restoData.name);
                restoDiv.find('#rest-cat').text(restoData.category);
                restoDiv.find('#rest-thumb').attr('src', restoData.thumbnail);
                if (restoData.favorite === true)
                    restoDiv.find('#rest-favorite').removeClass('hidden');
                else if (restoData.favorite === false)
                    restoDiv.find('#rest-unfavorite').removeClass('hidden');

                let stars = [];
                for (let i = 0; i < 5; i++) {
                    if (i < restoData.score)
                        stars.push('<i class="fas fa-star"></i>');
                    else
                        stars.push('<i class="far fa-star"></i>');
                }
                restoDiv.find('#rest-score').replaceWith(stars);

                let badges = restoData.badges.map((badge) => {
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
                });
                restoDiv.find('#rest-badges').append(badges);
                
                return restoDiv;
            }));
        });
    }
});

function getRestaurants(callback) {
    restaurants = new Array(5).fill({
        name: 'Burger King',
        description: 'Un bon gros phat bien connu',
        category: 'Fast food',
        address: '3 rue de la boustifaille',
        postalCode: 91000,
        city: 'Evry',
        phone: '+331 23 45 67 89',
        website: 'https://www.burgerking.fr/',
        thumbnail: 'http://www.stickpng.com/assets/images/5842996fa6515b1e0ad75add.png',
        favorite: true,
        badges: ['Bio', 'Halal', 'Vegan'],
    });

    restaurants = restaurants.map((resto, index) => {
        resto = JSON.parse(JSON.stringify(resto));
        resto.id = index + 1;
        resto.score = index + 1;
        if (resto.id === 2 || resto.id === 5) {
            resto.favorite = false;
        } else if (resto.id ===3) {
            resto.favorite = null;
        }
        return resto;
    });

    callback(null, restaurants);
}
