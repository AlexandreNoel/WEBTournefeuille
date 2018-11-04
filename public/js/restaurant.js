$(document).ready(() => {
    const restaurantId = window.location.pathname.match(/restaurants\/([0-9]+)/)[1];
    getRestaurant(restaurantId);
    getCategory(restaurantId);
    getBadges(restaurantId);
    getComments(restaurantId);
    getFavorites(restaurantId);

    $('#delete').click(() => {
        $('#rest-admin-buttons>*').toggleClass('hidden');
        $('#rest-del-cancel').click(() => {
            $('#rest-admin-buttons>*').toggleClass('hidden');
        });

        $('#rest-del-conf').click(() => {
            $.ajax({
                url: 'https://localhost:8080/api/restaurants/' + restaurantId,
                type: 'DELETE',
            }).done(function (res) {
                window.location = "/restaurants";
            }).fail(function (error) {
                alert("Erreur");
            });
        });
    });

    $('#newComment').click(()=>{
        $('#add-comment').removeClass('hidden');
        $('#newComment').addClass('hidden');
    });

    $('#cancel-comment').click( () => {
        $('#add-comment').addClass('hidden');
        $('#newComment').removeClass('hidden');
        tempCommentScore=0;
        $('#comment_resto').val('');
        updateCommentScore();
    });

    $('#validate-comment').click( ()=>{
        addComment(restaurantId);
    });

    $('#edit').click(() => {
        window.location = "/restaurants/update/"+restaurantId;
    });

    $('#rest-favorite').click(() => {
        changeFavorite(restaurantId);
    });
    $('#rest-unfavorite').click(() => {
        changeFavorite(restaurantId);
    });
    $('#rest-comment-score').mouseleave(() => { updateCommentScore(); });
    $('#rest-comment-score').click(() => { tempCommentScore = event.target.getAttribute('value'); });
    $('#rest-comment-score i').mouseenter((event) => { updateCommentScore(event.target.getAttribute('value')); });

    $('#rest-map-toggle span').click(() => {
        $('#rest-comments').toggleClass('hidden');
        $('#rest-map').toggleClass('hidden');
        $('#rest-map-toggle span').toggleClass('hidden');
    });
});

let restaurant = {};
let comments = {};

function getRestaurant(restaurantId) {

    $.ajax({
        url: 'https://localhost:8080/api/restaurants/' + restaurantId,
        type: 'GET',
    }).done(function (res) {
        restaurant = res;
        restaurant.favorite = false;
        updateFavorite();
        buildContent();
    }).fail(function (error) {

        alert("Erreur");
    });

}

function getComments(restaurantId) {
    $.ajax({
        url: 'https://localhost:8080/get-comments.php',
        type: 'GET',
        data :{
            id_resto : restaurantId
        }
    }).done(function (comment) {
        comment = JSON.parse(comment);
        comments = comment.comments;
        updateComment();

    }).fail(function (error) {
        alert("Erreur");
    });
}

function getCategory(restaurantId) {
    $.ajax({
        url: 'https://localhost:8080/get-category.php',
        type: 'GET',
        data: {
            id_resto: restaurantId
        }
    }).done(function (cat) {
        cat = JSON.parse(cat);
        updateCategorie(cat.category);

    }).fail(function (error) {
        alert("Erreur");
    });
}

function getBadges(restaurantId) {
    $.ajax({
        url: 'https://localhost:8080/get-badges.php',
        type: 'GET',
        data: {
            id_resto: restaurantId
        }
    }).done(function (badge) {
        badge = JSON.parse(badge);
        updateBadges(badge.badges);

    }).fail(function (error) {
        alert("Erreur");
    });
}

function getFavorites(restaurantId) {
    $.ajax({
        url: 'https://localhost:8080/get-favorites.php',
        type: 'GET',
        data :{
            id_resto : restaurantId
        }
    }).done(function (favorites) {
        favorites = JSON.parse(favorites);
        restaurant.favorite = favorites.isFavorite;
        updateFavorite();
    }).fail(function (error) {
        alert("Erreur");
    });
}

function addComment(restaurantId) {

    $.ajax({
        url: 'https://localhost:8080/api/comments/',
        type: 'POST',
        data: {
            id_resto: restaurantId,
            text_comment : $('#comment_resto').val(),
            note_resto : tempCommentScore
        }
    }).done(function (restaurant) {
        location.reload();
    }).fail(function (error) {
        alert("Erreur");
    });
}

function deleteComment(commentId){
    $.ajax({
        url: 'https://localhost:8080/api/comments/' + commentId,
        type: 'DELETE'
    }).done(function (res) {
        location.reload();
    }).fail(function (error) {
        alert("Erreur");
    });
}

function changeFavorite(restaurantId){
    $.ajax({
        url: 'https://localhost:8080/change-favorite-restaurant.php',
        type: 'POST',
        data :{
            id_resto : restaurantId
        }
    }).done(function (fav) {
        fav = JSON.parse(fav);
        restaurant.favorite = fav.isFavorite;
        updateFavorite();
    }).fail(function (error) {
        alert("Erreur");
    });
}

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

function updateCategorie(cat_name){
    $('#rest-category').text(cat_name);
}

function updateBadges(badges) {
    for (let i = 0; i < badges.length; i++) {
        $('#rest-badges').append("<img alt='" + badges[i].nom_badge +"' src='/assets/images/badges/"+badges[i].badge_link+"'></img>");
    }
}


let tempCommentScore = 0;
function updateRestaurantScore(){
    for (let i = 0; i < 5; i++) {
        let star = $(`#star-${i + 1}`);
        star.removeClass('fas');
        star.removeClass('far');
        if (i < restaurant.score)
            star.addClass('fas');
        else
            star.addClass('far');
    }
}

function updateCommentScore(num = tempCommentScore) {
    for (let i = 0; i < 5; i++) {
        let star = $(`#star-comment-${i + 1}`);
        star.removeClass('fas');
        star.removeClass('far');
        if (i < num)
            star.addClass('fas');
        else
            star.addClass('far');
    }
}

function updateComment(){
    const templateComm = $('#rest-comm-template');

    $('#rest-comments').append(comments.map((comment) => {
        let commDiv = templateComm.clone();
        commDiv.removeClass('hidden');

        const dateOptions = {year: 'numeric', month: 'numeric', day: 'numeric'};

        commDiv.find('#rest-comm-id').val(comment.id_comment);
        commDiv.find('#rest-comm-username').text(comment.prenom_user + ' ' + comment.nom_user);
        commDiv.find('#rest-comm-date').text(new Date(comment.date_comment).toLocaleDateString('fr-FR', dateOptions));
        commDiv.find('#rest-comm-text').text(comment.text_comment);
        commDiv.find('#rest-com-delete').click( ()=>{
            let idComment = commDiv.find('#rest-comm-id').val();
            deleteComment(idComment);
        });

        let stars = [];
        for (let i = 0; i < 5; i++) {
            if (i < comment.note_resto)
                stars.push('<i class="fas fa-star"></i>');
            else
                stars.push('<i class="far fa-star"></i>');
        }
        commDiv.find('#rest-score-comment').empty();
        commDiv.find('#rest-score-comment').append(stars);

        return commDiv;
    }));
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

    updateRestaurantScore();

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
