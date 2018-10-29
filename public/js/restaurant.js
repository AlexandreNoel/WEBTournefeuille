$(document).ready(() => {
    const restaurantId = window.location.pathname.match(/restaurants\/([0-9]+)/)[1];
    getRestaurant(restaurantId);

    $('#delete').click(() => {
        $('#rest-admin-buttons>*').toggleClass('hidden');
        $('#rest-del-cancel').click(() => {
            $('#rest-admin-buttons>*').toggleClass('hidden');
        });

        $('#rest-del-conf').click(() => {
            $.ajax({
                url: 'https://localhost:8080/api/restaurant/' + restaurantId,
                type: 'DELETE',
            }).done(function (res) {
                window.location = "/restaurants";
            }).fail(function (error) {
                alert("Erreur");
            });
        });
    });

    $('#edit').click(() => {
        window.location = "/restaurants/update/"+restaurantId;
    });

    $('#rest-favorite').click(() => {
        restaurant.favorite = !restaurant.favorite;
        updateFavorite();
    });
    $('#rest-unfavorite').click(() => {
        restaurant.favorite = !restaurant.favorite;
        updateFavorite();
    });
    $('#rest-score').mouseleave(() => { updateStars(); });
    $('#rest-score').click(() => { console.log(tempScore); });
    $('#rest-score i').mouseenter((event) => { updateStars(event.target.getAttribute('value')); });
    $('#rest-map-toggle span').click(() => {
        $('#rest-comments').toggleClass('hidden');
        $('#rest-map').toggleClass('hidden');
        $('#rest-map-toggle span').toggleClass('hidden');
    });
});

let restaurant = {};

function getRestaurant(restaurantId) {
    $.ajax({
        url: 'https://localhost:8080/description-restaurant.php',
        type: 'GET',
        data: { id_resto: restaurantId }
    }).done(function (res) {
        res= JSON.parse(res)
        restaurant = res.data; 
        buildContent();
    }).fail(function (error) {
        alert("Erreur");
    });

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
        let star = $(`#star-${i + 1}`);
        star.removeClass('fas');
        star.removeClass('far');
        if (i < (num || restaurant.score))
            star.addClass('fas');
        else
            star.addClass('far');
    }
}

function buildContent() {
    $('#rest-name').text(restaurant.nom_resto);
    $('#rest-category').text(restaurant.category);
    $('#rest-desc').text(restaurant.descr_resto);
    $('#rest-thumb').attr('src', restaurant.thumbnail);

    updateFavorite();

    if (restaurant.tel_resto) {
        $('#rest-phone').removeClass('hidden');
        $('#rest-phone a').text(restaurant.tel_resto);
        $('#rest-phone a').attr('href', 'tel:restaurant.phone');
    }

    if (restaurant.website_resto) {
        $('#rest-web').removeClass('hidden');
        $('#rest-web a').attr('href', restaurant.website_resto);
    }

    if (restaurant.addr_resto || restaurant.city_resto || restaurant.cp_resto) {
        $('#rest-add').removeClass('hidden');
        $('#rest-add-full').text(restaurant.addr_resto);
        $('#rest-add-code').text(restaurant.cp_resto);
        $('#rest-add-city').text(restaurant.city_resto);

        $('#mapRestaurant').attr('src', 'https://maps.google.com/maps?q=' + restaurant.nom_resto + ' ' + restaurant.addr_resto +'&output=embed');

    }

    updateStars();

    const templateComm = $('#rest-comm-template'); //TODO
    /* $('#rest-comments').append(restaurant.comments.map((comment) => {
         let commDiv = templateComm.clone();
         commDiv.removeClass('hidden');

         const dateOptions = { year: 'numeric', month: 'numeric', day: 'numeric' };

         commDiv.find('#rest-comm-username').text(comment.user.firstName + ' ' + comment.user.lastName);
         commDiv.find('#rest-comm-date').text(new Date(comment.date).toLocaleDateString('fr-FR', dateOptions));
         commDiv.find('#rest-comm-text').text(comment.text);

         return commDiv;
     }));*/

    /* let badges = restaurant.badges.map((badge) => {
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
     $('#rest-badges').append(badges);*/
}
