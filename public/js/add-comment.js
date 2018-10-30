$(document).ready(() => {

    $('#rest-add-comment').click( () =>{
        $('#rest-text-comment').removeClass('hidden');
    });

    $('#rest-button-comment').click( () =>{
        addComment();
    });
});

function addComment() {
    const addCommentButton = $('#rest-input-comment');
    const restoId = window.location.pathname.match(/restaurants\/([0-9]+)/)[1];

    if($.trim(addCommentButton.val())){
        $.ajax({
            url: 'https://localhost:8080/add-comment.php',
            type: 'POST',
            data: {
                id_user: getSession()['id'],
                id_resto: restoId,
                text_comment : (addCommentButton.val()),
            }

        }).done(function (restaurant) {
           // location.reload();
        }).fail(function (error) {
            alert("Erreur");
        });
    }
}