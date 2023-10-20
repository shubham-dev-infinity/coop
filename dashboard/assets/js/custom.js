var show = 1;
$(document).on('click', '.close', function () {
    console.log('click close1');
    if (show == 1) {
        $('.logo-him').toggle();
        $('#layout-menu').animate({
            width: '1%'
        });
        $('#layout-content-him').animate({
            width: '99%'
        });
        show = 0;
    } else {
        $('.logo-him').toggle();
        $('#layout-menu').animate({
            width: '20%'
        });
        $('#layout-content-him').animate({
            width: '80%'
        });
        show = 1;
    }
    console.log('click close2');
});

function closeleftmenu() {
    $('.logo-him').toggle();
    $('#layout-menu').animate({
        width: '1%'
    });
    $('#layout-content-him').animate({
        width: '99%'
    });
    show = 0;
}