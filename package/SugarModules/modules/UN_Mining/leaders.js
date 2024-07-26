function report() {
    const month = $('#month').val();
    const url = 'index.php?module=UN_Mining&month=' + month;
//SUGAR.ajaxUI.showLoadingPanel();
    $.ajax({
        url: url + '&action=countries',
    }).done(function(response) {
        console.log(response);
        $('#countries').html(response);
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.responseText);
    });

    $.ajax({
        url: url + '&action=companies',
    }).done(function(response) {
        console.log(response);
        $('#companies').html(response);
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.responseText);
    });
}

function generate() {
    
    window.location.replace('index.php?module=UN_Mining&action=generate');
}
