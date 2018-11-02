$(document).ready(() => {
    checkInputs();
    $('[name="nom_resto"]').focus();

    $('[name="nom_resto"]').keyup(() => {
        checkInputs();
    });
    $('[name="type_resto"]').change(() => {
        checkInputs();
    });
    $('[name="descr_resto"]').keyup(() => {
        checkInputs();
    });
    $('[name="badge_resto"]').keyup(() => {
        checkInputs();
    });
    $('[name="addr_resto"]').keyup(() => {
        checkInputs();
    });
    $('[name="cp_resto"]').keyup(() => {
        checkInputs();
    });
    $('[name="city_resto"]').keyup(() => {
        checkInputs();
    });
    $('[name="tel_resto"]').keyup(() => {
        checkInputs();
    });
    $('[name="website_resto"]').keyup(() => {
        checkInputs();
    });
    $('[name="thumbnail"]').keyup(() => {
        checkInputs();
    });
    $('[name="cancel"]').click(() => {
        window.location = '/restaurants';
    });
    $('[name="validate"]').click(() => {
        if (checkInputs())
           addRestaurant();
    });
});

function checkInputs() {
    let allOK = true;

    const restName = $('[name="nom_resto"]').val();
    if (restName.length >= 1) {
        $('[name="nom_resto"]').parent().addClass('has-success');
        $('[name="nom_resto"]').parent().removeClass('has-error');
    } else {
        $('[name="nom_resto"]').parent().removeClass('has-success');
        $('[name="nom_resto"]').parent().addClass('has-error');
        allOK = false;
    }

    const type = $('[name="type_resto"]').val();
    if (type.length >= 1) {
        $('[name="type_resto"]').parent().addClass('has-success');
        $('[name="type_resto"]').parent().removeClass('has-error');
    } else {
        $('[name="type_resto"]').parent().removeClass('has-success');
        $('[name="type_resto"]').parent().addClass('has-error');
        allOK = false;
    }

    const description = $('[name="descr_resto"]').val();
    if (description.length >= 1) {
        $('[name="descr_resto"]').parent().addClass('has-success');
        $('[name="descr_resto"]').parent().removeClass('has-error');
    } else {
        $('[name="descr_resto"]').parent().removeClass('has-success');
        $('[name="descr_resto"]').parent().addClass('has-error');
        allOK = false;
    }

    const badge = $('[name="badge_resto"]').val();
    if (badge.length >= 1) {
        $('[name="badge_resto"]').parent().addClass('has-success');
    } else {
        $('[name="badge_resto"]').parent().removeClass('has-success');
    }

    const address = $('[name="addr_resto"]').val();
    if (address.length >= 1) {
        $('[name="addr_resto"]').parent().addClass('has-success');
        $('[name="addr_resto"]').parent().removeClass('has-error');
    } else {
        $('[name="addr_resto"]').parent().removeClass('has-success');
        $('[name="addr_resto"]').parent().addClass('has-error');
        allOK = false;
    }

    const postalCode = $('[name="cp_resto"]').val();
    if (postalCode.match(/^[0-9]{5}$/)) {
        $('[name="cp_resto"]').parent().addClass('has-success');
        $('[name="cp_resto"]').parent().removeClass('has-error');
    } else {
        $('[name="cp_resto"]').parent().removeClass('has-success');
        $('[name="cp_resto"]').parent().addClass('has-error');
        allOK = false;
    }

    const city = $('[name="city_resto"]').val();
    if (city.length >= 1) {
        $('[name="city_resto"]').parent().addClass('has-success');
        $('[name="city_resto"]').parent().removeClass('has-error');
    } else {
        $('[name="city_resto"]').parent().removeClass('has-success');
        $('[name="city_resto"]').parent().addClass('has-error');
        allOK = false;
    }

    const tel = $('[name="tel_resto"]').val();
    if (tel.length && tel.match(/^\+?[0-9]+$/)) {
        $('[name="tel_resto"]').parent().addClass('has-success');
        $('[name="tel_resto"]').parent().removeClass('has-error');
    } else if (tel.length) {
        $('[name="tel_resto"]').parent().removeClass('has-success');
        $('[name="tel_resto"]').parent().addClass('has-error');
        allOK = false;
    } else {
        $('[name="tel_resto"]').parent().removeClass('has-success');
        $('[name="tel_resto"]').parent().removeClass('has-error');
    }

    const website = $('[name="website_resto"]').val();
    if (website.length && website.match(/(http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?/)) {
        $('[name="website_resto"]').parent().addClass('has-success');
        $('[name="website_resto"]').parent().removeClass('has-error');
    } else if (website.length) {
        $('[name="website_resto"]').parent().removeClass('has-success');
        $('[name="website_resto"]').parent().addClass('has-error');
        allOK = false;
    } else {
        $('[name="website_resto"]').parent().removeClass('has-success');
        $('[name="website_resto"]').parent().removeClass('has-success');
    }

    const thumb = $('[name="thumbnail"]').val();
    if (thumb.length && thumb.match(/(http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?/)) {
        $('[name="thumbnail"]').parent().addClass('has-success');
        $('[name="thumbnail"]').parent().removeClass('has-error');
    } else if (thumb.length) {
        $('[name="thumbnail"]').parent().removeClass('has-success');
        $('[name="thumbnail"]').parent().addClass('has-error');
        allOK = false;
    } else {
        $('[name="thumbnail"]').parent().removeClass('has-success');
        $('[name="thumbnail"]').parent().removeClass('has-success');
    }

    $('[name="validate"]').prop('disabled', !allOK);
    return allOK;
}

function addRestaurant() {
    $('#rest-add-spinner').removeClass('hidden');

    //get data from the form
    $.ajax({
        url: 'https://localhost:8080/api/restaurants',
        type: 'POST',
        data: {
            nom_resto: $('#nom_resto').val(),
            descr_resto: $('#descr_resto').val(),
            addr_resto: $('#addr_resto').val(),
            cp_resto: $('#cp_resto').val(),
            city_resto: $('#city').val(),
            tel_resto: $('#tel').val(),
            website_resto: $('#web').val(),
            thumbnail: $('#filebutton').val()
        }
    }).done(function (res) {
        console.log('in');
        window.location = '/restaurants';
    }).fail(function (error) {console.log('ou');
    }).always(() => {
        console.log('inout');
        $('#rest-add-spinner').addClass('hidden');
    });
}
