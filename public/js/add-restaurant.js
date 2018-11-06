$(document).ready(() => {

    if (!getSession()['isadmin']) {
        res = [];
        res.errorcode = '403';
        redirectErrorCode(res);
    }

    getCategories();
    getBadges();
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
    $('[name="cp_resto"]').keyup((e) => {
        // console.log(e);    
        // if (e.which !== 0 && e.charCode !== 0 && !e.ctrlKey && !e.metaKey && !e.altKey){
            checkInputs();
            var typedZipCode = $('[name="cp_resto"]').val();
            $("#city").val("");
            $("#cityHint").text("");
            if (typedZipCode.length > 4){
                
                cityFromzipCodeLookup(typedZipCode);
            }
        // }
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
    if(type) {
        if (type.length >= 1) {
            $('[name="type_resto"]').parent().addClass('has-success');
            $('[name="type_resto"]').parent().removeClass('has-error');
        } else {
            $('[name="type_resto"]').parent().removeClass('has-success');
            $('[name="type_resto"]').parent().addClass('has-error');
            allOK = false;
        }
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
    if(badge){
        if (badge.length >= 1) {
            $('[name="badge_resto"]').parent().addClass('has-success');
        } else {
            $('[name="badge_resto"]').parent().removeClass('has-success');
        }
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
    if (city.length > 0) {
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

/**
 * 
 * @param {} zipCode 
 */
function cityFromzipCodeLookup(zipCode){
    $.ajax({
        url: 'https://public.opendatasoft.com/api/records/1.0/search/?dataset=code-insee-postaux-geoflar&q='+zipCode+'&lang=FR',
        type: 'GET',
    }).done(function (res) {
        $('#cityList > option').remove();
        var result=[];
        res.records.forEach( (data) =>{
            //console.log(data.fields.code_postal+' - '+data.fields.nom_comm);
            result.push(data.fields.nom_comm);
        })

        if (result.length === 1) {
            var hintText = result.length + " ville trouvée";
        }
        else if (result.length > 1){
            var hintText=result.length+" ville(s) trouvée(s). Double-cliquez sur le champ pour afficher la liste...";
        }
        else { var hintText = "Aucune ville trouvée"}
        
        result.sort();
        $("#cityHint").text(hintText);
        if (result.length === 1) { $("#city").val(result[0]);}
        result.forEach(function(commune){
            $("#cityList").append("<option value='" + commune + "'>" + commune + "</option>")
        });
        ;
    }).fail(function (error) {
        $("#cityList").after("<option selected value=''>Une erreur est survenue</option>")
    });
}

function addRestaurant() {
    $('#rest-add-spinner').removeClass('hidden');

    var badges = getCheckedBadges();
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
            thumbnail: $('#filebutton').val(),
            categorie: $('#type_resto option:selected').text(),
            badges: badges
        }
    }).done(function (res) {
        swal({
            type: 'success',
            title: 'Operation réussie',
            text: "Le nouveau restaurant a été sauvegardé.",
            footer: '<a href ="/restaurants">Je veux voir la liste des restaurants !</a>'
        }).then((result) => {
            if (result.value) {
                window.location = '/restaurants/';
            }});
    }).fail(function (error) {
        var errorData=error.responseJSON;
        console.log(errorData);
        swal({
            type: 'error',
            title: 'Oops...',
            text: "Une erreur est survenue lors de l'enregistrement du restaurant" + error.responseText,
            footer: "Contactez l'administrateur du site"
        })
    }).always(() => {
        $('#rest-add-spinner').addClass('hidden');
    });
}

function getCategories() {
    $.ajax({
        url: 'https://localhost:8080/api/categories',
        type: 'GET'
    }).done(function (res) {
        addAllCategories(res.data);
    }).fail(function (error) {
        alert("Erreur");
    });
}

function getBadges() {
    $.ajax({
        url: 'https://localhost:8080/api/badges',
        type: 'GET'
    }).done(function (res) { 
        addAllBadges(res.data);
    }).fail(function (error) {
        alert("Erreur");
    });
}

function addAllCategories(categories) {

    for (let i = 0; i < categories.length; i++) {
        $('<option />', { value: categories[i].nom_cat, text: categories[i].nom_cat }).appendTo($('#type_resto'));
    }
}

function addCheckbox(name,id) {
    var container = $('#badge_resto');

    $('<input />', { type: 'checkbox',id: id, name:'badges', value: name }).appendTo(container);
    $('<label />', { text: name }).appendTo(container);
    $('</br>').appendTo(container);
    
}

function addAllBadges(badges) {

    for (let i = 0; i < badges.length; i++) {
        addCheckbox(badges[i].nom_badge, badges[i].id_badge);
    }
}

function getCheckedBadges() {
    var selected = [];
    $('#badge_resto input:checked').each(function () {
        selected.push($(this).attr('id'));
    });
    return selected;
}
