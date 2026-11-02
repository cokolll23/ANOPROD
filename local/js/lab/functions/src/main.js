BX.ready(function (e) {

    $('#humanresources-company-structure .humanresources-title-panel .humanresources-title-panel__title').text('Структура организации');

    //console.log($('.kt-competencies'));
    /* $('body').on('click', '.kt-competencies .kt-widget-title__text ', function (e) {
         e.preventDefault();
         alert('ok');
         $('.kt-competencies ').find('.kt-widget-title__text').html('Задачи в организации');
     });*/

    /*  <a href="/company/structure.php?set_filter_structure=Y&amp;structure_UF_DEPARTMENT=306"
    data-role="department_name" title="МУФ">МУФ</a>

    #js-structure-list #306
  */
    var fullUrl = $(location).attr('href');

    var blVisStructure = fullUrl.includes('vis_structure.php')
    var blHr = fullUrl.includes('hr')

    if (blHr == true) {// .humanresources-tree__node_children 166 159
        $('.humanresources-tree__node_children div ').each(function (i) {
            var aIdData = $(this).attr('data', 'id');
            console.log(aIdData);
            if (aIdData == 166 || aIdData == 159) {
                $(this).addClass('hidden');
                console.log($(this));
            }
        });
    }
    if (blVisStructure == true) {
        $('#js-structure-list ul li.child ').each(function (i) {
            var aId = $(this).find('a').attr('id')
            if (aId == 306 || aId == 299) {
                $(this).addClass('hidden');
                console.log($(this).find('a').attr('id'));
            }
        });
        //$('#js-structure-list #306')

        $('#bx_visual_structure td ').each(function (i) {

            var idSpan = $(this).find('span.structure-dept-block').attr('id');
            // structure-dept-block structure-dept-second structure-dept-editable id='bx_str_76'
            if (idSpan == 'bx_str_306' || idSpan == 'bx_str_299') {
                $(this).addClass('hidden');
            }
        });
    }


    $('body').on('click', 'ul.menu-items li#bx_left_menu_menu_office', function (e) {
        e.preventDefault();
        $('#top_menu_id_k-team #top_menu_id_k-team_menu_office').click();

    });

    /*document.addEventListener('click', function(event) {
        // Проверяем, что клик был по ссылке
        const link = event.target.closest('a');

        if (!link) return;

        // Проверяем, что href содержит /company/
        if (!link.href.includes('/company/')) return;

        // Проверяем, что ссылка находится внутри div с нужным background-image
        const parentDiv = link.closest('div[style*="background-image"]');

        if (!parentDiv) return;

        // Проверяем конкретный background-image
        const style = parentDiv.getAttribute('style');
        if (style && style.includes('url("/upload/iblock/c03/onin1dafr65cjp0a826m25k96zocime1/Frame 100.png")')) {
            console.log('Кнопка:', link);
        }
    });*/
    //q-btn q-btn-item non-selectable no-outline q-btn--unelevated q-btn--rectangle
    //
    // q-btn--rounded q-btn--actionable q-focusable q-hoverable q-btn--no-uppercase kt-btn q-btn--primary-theme

    $('body').on('click', '.kt-widget-wrapper__content a[href="https://corp-portal.welcome.moscow/company/"]', function (e) {

        e.preventDefault();
        if($(this).attr('href')=='https://corp-portal.welcome.moscow/company/'){
            console.log($(this));
            const arr=$('div.main-buttons-item.top-menu-menu_office').find('a').attr('href');
            window.location.href = arr;
        }

       // $('a[href*="corp-portal.welcome.moscow/company/"]').click();

    });

    /* $('ul.menu-items li').each(function (e) {
         if ($(this).attr('id') == 'bx_left_menu_2301492049') {
             $(this).addClass( 'menu-ano-life');
         }
     });*/

// кнопка для открытия определенного чата из колонки справа страницы
    $('body').on('click', '#layout-left-column .menu-items-body a', function (e) {// data-id="chat21130"

        var btnId = $(this).attr('href').split('//')[1];
        if (btnId == 'chat21130') {
            e.preventDefault();
            $('[data-id="' + btnId + '"]').click();
        }
    });
});
