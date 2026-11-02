<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_before.php');
CModule::IncludeModule('iblock');

$IBLOCK_CODE = 'stars_marathon';
\Bitrix\Main\Loader::includeModule('iblock');

$iblockId = \Bitrix\Iblock\IblockTable::getList([
    'filter' => ['=CODE' => 'stars_marathon'],
    'select' => ['ID']
])->fetch()['ID'] ?? null;

if ($iblockId) {
    // ID успешно получен
    $iblockId;
} else {
    // Инфоблок с таким кодом не найден
}

// Проверка прав на запись в инфоблок
if (CIBlock::GetPermission($iblockId) < 'W') {
    die('Недостаточно прав для удаления элементов.');
}

$arFilter = ['IBLOCK_ID' => $iblockId];
$rsItems = CIBlockElement::GetList([], $arFilter, false, false, ['ID']);

$count = 0;
while ($arItem = $rsItems->Fetch()) {
    if (CIBlockElement::Delete($arItem['ID'])) {
        echo "Удален элемент ID: {$arItem['ID']}<br>";
        $count++;
    } else {
        echo "Ошибка удаления элемента ID: {$arItem['ID']}<br>";
    }
}

echo "Готово. Удалено элементов: {$count}";

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_admin_after.php');
?>