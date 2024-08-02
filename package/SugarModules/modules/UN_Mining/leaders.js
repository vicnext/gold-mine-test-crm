function report() {
    const month = $('#month').val();
    const url = 'index.php?module=UN_Mining&month=' + month;

    $.ajax({
        url: url + '&action=countries',
    }).done(function(response) {
        //console.log(response);
        $('#countries').html(response);
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.responseText);
    });

    $.ajax({
        url: url + '&action=companies',
    }).done(function(response) {
        //console.log(response);
        $('#companies').html(response);
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.responseText);
    });
}

function generate() {
    const url = 'index.php?module=UN_Mining';
    SUGAR.ajaxUI.showLoadingPanel();
    $.ajax({
        url: url + '&action=generate',
    }).done(function(response) {
        //console.log(response);
        window.location.replace(url);
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.responseText);
    });
}
