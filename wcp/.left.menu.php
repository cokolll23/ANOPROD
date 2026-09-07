<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

//IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public/company/.left.menu.php");

$aMenuLinks = [
    [
        'Об организации ',
        "/wcp/#about",
        [],
        [],
        ""
    ],
    [
        'Наши проекты',
        "/wcp/#projects",
        [],
        [],
        ""
    ],
    [
        'Руководители',
        "/wcp/#leaders",
        [],
        [],
        ""
    ],
    [
        'Адреса офисов',
        '/wcp/#adresses',
        [],
        [],
        ""
    ],
    [
        'Наши правила',
        '/wcp/#orders',
        [],
        [],
        ""
    ],[
        'Полезные ссылки',
        '/wcp/#links',
        [],
        [],
        ""
    ],
];
