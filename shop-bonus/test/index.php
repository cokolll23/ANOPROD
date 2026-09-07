<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("testaaa");

?>

<?php


// Подключаем необходимые модули
if (!\Bitrix\Main\Loader::includeModule('iblock') || !\Bitrix\Main\Loader::includeModule('main')) {
    die('Ошибка: Не удалось загрузить модули инфоблоков или главного модуля');
}

// Входной массив: ID раздела => ID пользователя
$arData = array(
    268 => "30",
    283 => "79",
    147 => "86",
    97 => "89",
    98 => "91",
    285 => "101",
    96 => "109",
    121 => "123",
    293 => "128",
    74 => "145",
    75 => "147",
    126 => "151",
    280 => "159",
    81 => "160",
    239 => "166",
    78 => "171",
    84 => "195",
    1 => "196",
    107 => "208",
    292 => "214",
    76 => "224",
    236 => "226",
    284 => "230",
    80 => "249",
    101 => "251",
    163 => "258",
    109 => "268",
    127 => "272",
    112 => "281",
    300 => "283",
    106 => "291",
    277 => "294",
    141 => "300",
    117 => "305",
    156 => "312",
    143 => "322",
    150 => "323",
    125 => "324",
    123 => "327",
    110 => "339",
    79 => "347",
    77 => "348",
    108 => "349",
    287 => "356",
    122 => "357",
    238 => "374",
    237 => "375",
    116 => "503",
    120 => "402",
    119 => "406",
    282 => "410",
    296 => "424",
    154 => "427",
    281 => "432",
    235 => "447",
    83 => "484",
    148 => "491",
    149 => "492",
    115 => "493",
    303 => "501",
    298 => "521",
    184 => "606",
    288 => "667",
    294 => "768",
    276 => "893",
    207 => "902",
    161 => "1067",
    157 => "1069",
    167 => "1076"
);

foreach ($arData as $departmentId1 => $headId1) {
    /**
     * Если есть раздел и пользователь включает функцию назначенияпольз. руководителем отдела
     *
     *
     */
    $isUserByUserId = \Lab\Helpers\UsersHelpers::isUserByUserId($headId1);
    $isSectionById = \Lab\Helpers\IblockHelpers::isSectionById(3, $departmentId1);

    if ($isUserByUserId && $isSectionById) {

        $arR['r'][] = $departmentId1.'--'.$headId1;

    } else {
        $arR['b'][] = $departmentId1.'--'.$headId1;
       // $log = date('Y-m-d H:i:s') . ' Несостыковка  ' . print_r([$departmentId1, $headId1], true);
       // file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/log_nesostykovka.txt', $log . PHP_EOL, FILE_APPEND);
    }
}
pretty_print($arR);

/*$isUserByUserId = \Lab\Helpers\UsersHelpers::isUserByUserId(1076);
$isSectionById = \Lab\Helpers\IblockHelpers::isSectionById(3,167);*/

/*if ($isUserByUserId && $isSectionById) {
    echo 1;
} else {
    echo 0;
}*/

/* $log = date('Y-m-d H:i:s') . ' OnAfterUserAddHandler11 ' . print_r($arFields, true);
        file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/log.txt', $log . PHP_EOL, FILE_APPEND);
        Bitrix\Main\Diag\Debug::dumpToFile($log, 'OnAfterUserAddHandler11' . date('d-m-Y; H:i:s'));*/


// Массив для хранения результатов проверки
$arResults = [];

/**
 * 1. ПОЛУЧАЕМ СПИСОК СУЩЕСТВУЮЩИХ РАЗДЕЛОВ
 */
if (!empty($arData)) {
    $sectionIds = array_keys($arData);

    // Выбираем существующие разделы из инфоблоков
    // Для ускорения используем GetList с фильтром по ID и без проверки прав (CHECK_PERMISSIONS => N)
    $existingSections = [];
    $rsSections = CIBlockSection::GetList(
        [], // Сортировка не нужна
        ['ID' => $sectionIds,'ACTIVE'=>'Y', 'CHECK_PERMISSIONS' => 'N'], // Фильтр по нужным ID
        false, // Считаем ли подразделы
        ['ID'] // Выбираем только поле ID для экономии ресурсов
    );

    while ($arSection = $rsSections->Fetch()) {
        $existingSections[$arSection['ID']] = true; // Отмечаем ID как существующий
    }

    /**
     * 2. ПОЛУЧАЕМ СПИСОК СУЩЕСТВУЮЩИХ ПОЛЬЗОВАТЕЛЕЙ
     */
    $userIds = array_values($arData);
    // Убираем дубликаты и нулевые/пустые значения
    $userIds = array_unique(array_filter($userIds, function ($id) {
        return $id > 0;
    }));

    $existingUsers = [];
    if (!empty($userIds)) {
        $rsUsers = CUser::GetList(
            'id', 'asc',
            ['ID' => implode('|', $userIds)] // Фильтр по нескольким ID
        );

        while ($arUser = $rsUsers->Fetch()) {
            $existingUsers[$arUser['ID']] = true;
        }
    }

    /**
     * 3. ФОРМИРУЕМ РЕЗУЛЬТАТ
     */
    foreach ($arData as $sectionId => $userId) {
        $sectionExists = isset($existingSections[$sectionId]);
        $userExists = ($userId > 0 && isset($existingUsers[$userId]));

        $arResults[] = [
            'SECTION_ID' => $sectionId,
            'USER_ID' => $userId,
            'SECTION_EXISTS' => $sectionExists,
            'USER_EXISTS' => $userExists,
            'IS_VALID' => ($sectionExists && $userExists) // Флаг валидности всей пары
        ];

        // Выводим информацию для наглядности
        echo "Раздел ID {$sectionId}: " . ($sectionExists ? "НАЙДЕН" : "НЕ НАЙДЕН") . "<br>";
        echo "Пользователь ID {$userId}: " . ($userExists ? "НАЙДЕН" : "НЕ НАЙДЕН") . "<br>";
        echo "-----------------------------------<br>";
    }
} else {
    echo "Входной массив пуст";
}
pretty_print($arResults);

?>


<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>