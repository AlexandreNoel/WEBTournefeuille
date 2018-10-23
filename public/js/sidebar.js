$(document).ready(() => {
    var wrapper = $('#wrapper');

    wrapper.click(() => {
        $('#wrapper').removeClass('toggled');
    });

    $('[data-toggle="offcanvas"]').click(() => {
        $('#wrapper').toggleClass('toggled');
    });  
});
