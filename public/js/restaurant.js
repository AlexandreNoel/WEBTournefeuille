$(document).ready(() => {
    getRestaurant();

    $('#rest-favorite').click(() => {
        restaurant.favorite = !restaurant.favorite;
        updateFavorite();
    });
    $('#rest-unfavorite').click(() => {
        restaurant.favorite = !restaurant.favorite;
        updateFavorite();
    });
    $('#rest-score').mouseleave(() => {updateStars();});
    $('#rest-score').click(() => {console.log(tempScore);});
    $('#rest-score i').mouseenter(() => {updateStars(event.target.getAttribute('value'));});
});

let restaurant = {};

function getRestaurant() {
    const restaurantId = window.location.pathname.match(/restaurants\/([0-9]+)/)[1];
    console.log(restaurantId);

    restaurant = {
        id: 1,
        score: 4,
        name: 'Burger King',
        description: 'Bacon ipsum dolor amet andouille pig sirloin, shankle short loin burgdoggen beef ribs venison bacon strip steak tongue cupim pork loin. Pancetta kielbasa ball tip, doner sausage ribeye cupim jerky drumstick flank chuck. Ham hock tenderloin leberkas beef, pork chop sausage filet mignon swine jerky sirloin landjaeger. Chicken salami shank, flank filet mignon ham tongue turducken ground round kevin boudin landjaeger meatball jowl burgdoggen.\nBacon ipsum dolor amet andouille pig sirloin, shankle short loin burgdoggen beef ribs venison bacon strip steak tongue cupim pork loin. Pancetta kielbasa ball tip, doner sausage ribeye cupim jerky drumstick flank chuck. Ham hock tenderloin leberkas beef, pork chop sausage filet mignon swine jerky sirloin landjaeger. Chicken salami shank, flank filet mignon ham tongue turducken ground round kevin boudin landjaeger meatball jowl burgdoggen.',
        category: 'Fast food',
        address: '3 rue de la boustifaille',
        postalCode: 91000,
        city: 'Evry',
        phone: '+33 1 23 45 67 89',
        website: 'https://www.burgerking.fr/',
        thumbnail: 'http://www.stickpng.com/assets/images/5842996fa6515b1e0ad75add.png',
        favorite: false,
        badges: ['Vegan', 'Bio', 'Halal','Vegan', 'Bio','Vegan', 'Bio', 'Halal', 'Halal'],
        comments: [
            {
                text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus rhoncus pulvinar lacus eu imperdiet. Nullam at elit eleifend, lacinia orci rhoncus, vehicula ex. Morbi eu urna et nisl maximus feugiat. Fusce mollis placerat sem at malesuada. Aliquam egestas posuere interdum. Fusce id tortor magna.',
                date: '2018-06-29',
                user: {
                    firstName: 'Axel',
                    lastName: 'Morvan'
                }
            },
            {
                text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus rhoncus pulvinar lacus eu imperdiet. Nullam at elit eleifend, lacinia orci rhoncus, vehicula ex. Morbi eu urna et nisl maximus feugiat. Fusce mollis placerat sem at malesuada. Aliquam egestas posuere interdum. Fusce id tortor magna.',
                date: '2018-06-29',
                user: {
                    firstName: 'Axel',
                    lastName: 'Morvan'
                }
            },
            {
                text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus rhoncus pulvinar lacus eu imperdiet. Nullam at elit eleifend, lacinia orci rhoncus, vehicula ex. Morbi eu urna et nisl maximus feugiat. Fusce mollis placerat sem at malesuada. Aliquam egestas posuere interdum. Fusce id tortor magna.',
                date: '2018-06-29',
                user: {
                    firstName: 'Axel',
                    lastName: 'Morvan'
                }
            },
            {
                text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus rhoncus pulvinar lacus eu imperdiet. Nullam at elit eleifend, lacinia orci rhoncus, vehicula ex. Morbi eu urna et nisl maximus feugiat. Fusce mollis placerat sem at malesuada. Aliquam egestas posuere interdum. Fusce id tortor magna.',
                date: '2018-06-29',
                user: {
                    firstName: 'Axel',
                    lastName: 'Morvan'
                }
            },
            {
                text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus rhoncus pulvinar lacus eu imperdiet. Nullam at elit eleifend, lacinia orci rhoncus, vehicula ex. Morbi eu urna et nisl maximus feugiat. Fusce mollis placerat sem at malesuada. Aliquam egestas posuere interdum. Fusce id tortor magna.',
                date: '2018-06-29',
                user: {
                    firstName: 'Axel',
                    lastName: 'Morvan'
                }
            },
            {
                text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus rhoncus pulvinar lacus eu imperdiet. Nullam at elit eleifend, lacinia orci rhoncus, vehicula ex. Morbi eu urna et nisl maximus feugiat. Fusce mollis placerat sem at malesuada. Aliquam egestas posuere interdum. Fusce id tortor magna.',
                date: '2018-06-29',
                user: {
                    firstName: 'Axel',
                    lastName: 'Morvan'
                }
            },
        ],
    };

    buildContent();
}

let tempScore = null;
function updateFavorite() {
    if (restaurant.favorite === true) {
        $('#rest-favorite').removeClass('hidden');
        $('#rest-unfavorite').addClass('hidden');
    } else if (restaurant.favorite === false) {
        $('#rest-favorite').addClass('hidden');
        $('#rest-unfavorite').removeClass('hidden');
    } else {
        $('#rest-favorite').addClass('hidden');
        $('#rest-unfavorite').addClass('hidden');
    }
}

function updateStars(num = null) {
    tempScore = num;
    for (let i = 0; i < 5; i++) {
        let star = $(`#star-${i+1}`);
        star.removeClass('fas');
        star.removeClass('far');
        if (i < (num || restaurant.score))
            star.addClass('fas');
        else
            star.addClass('far');
    }
}

function buildContent() {
    $('#rest-name').text(restaurant.name);
    $('#rest-category').text(restaurant.category);
    $('#rest-desc').text(restaurant.description);
    $('#rest-thumb').attr('src', restaurant.thumbnail);

    updateFavorite();

    if (restaurant.phone) {
        $('#rest-phone').removeClass('hidden');
        $('#rest-phone a').text(restaurant.phone);
        $('#rest-phone a').attr('href', 'tel:restaurant.phone');
    }

    if (restaurant.website) {
        $('#rest-web').removeClass('hidden');
        $('#rest-web a').attr('href', restaurant.website);
    }

    if (restaurant.address || restaurant.city || restaurant.postalCode) {
        $('#rest-add').removeClass('hidden');
        $('#rest-add-full').text(restaurant.address);
        $('#rest-add-code').text(restaurant.postalCode);
        $('#rest-add-city').text(restaurant.city);
    }

    updateStars();

    const templateComm = $('#rest-comm-template');
    $('#rest-comments').append(restaurant.comments.map((comment) => {
        let commDiv = templateComm.clone();
        commDiv.removeClass('hidden');

        const dateOptions = {year: 'numeric', month: 'numeric', day: 'numeric' };

        commDiv.find('#rest-comm-username').text(comment.user.firstName + ' ' + comment.user.lastName);
        commDiv.find('#rest-comm-date').text(new Date(comment.date).toLocaleDateString('fr-FR', dateOptions));
        commDiv.find('#rest-comm-text').text(comment.text);

        return commDiv;
    }));

    let badges = restaurant.badges.map((badge) => {
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
    $('#rest-badges').empty();
    $('#rest-badges').append(badges);
}
