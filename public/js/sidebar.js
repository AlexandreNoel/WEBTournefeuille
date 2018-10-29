$(document).ready(() => {
    var wrapper = $('#wrapper');

    wrapper.click(() => {
        $('#wrapper').removeClass('toggled');
    });

    $('[data-toggle="offcanvas"]').click(() => {
        $('#wrapper').toggleClass('toggled');
    });  
});

var k = [38, 38, 40, 40, 37, 39, 37, 39, 66, 65],
    n = 0;
$(document).keydown(function (e) {
    if (e.keyCode === k[n++]) {
        if (n === k.length) {
            $('#coucou').toggleClass('hidden');
            n = 0;
            return false;
        }
    } else if (e.keyCode === 38) {
        n = 1;
    } else {
        n = 0;
    }
});
