BX.ready(function (e) {

    $('body').on('click', 'ul.menu-items li#bx_left_menu_menu_office', function (e) {
        e.preventDefault();
        $('#top_menu_id_k-team #top_menu_id_k-team_menu_office').click();

    });

   /* $('ul.menu-items li').each(function (e) {
        if ($(this).attr('id') == 'bx_left_menu_2301492049') {
            $(this).addClass( 'menu-ano-life');
        }
    });*/

// кнопка для открытия определенного чата из колонки справа страницы
    $('body').on('click', '#layout-left-column .menu-items-body a', function (e) {// data-id="chat21130"

        var btnId = $(this).attr('href').split('//')[1] ;
        if (btnId== 'chat21130'){
            e.preventDefault();
            $('[data-id="' + btnId + '"]').click();
        }
    });
});