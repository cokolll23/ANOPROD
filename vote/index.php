<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("ДР Vote");
?>
<?php
// 1. Подключаем необходимые модули
if (!\Bitrix\Main\Loader::includeModule('iblock')) {
    die('Модуль инфоблоков не подключен');
}
$elementId = 211295; // ID элемента в инфоблоке sotrudniki 211295
$iblockId = 42;// 42
$propertyCode = "COLUMN37";
$newValue = 5;

// 2. Получаем текущее значение свойства (без префикса "PROPERTY_")
$res = CIBlockElement::GetList(
        [],
        ["ID" => $elementId],
        false,
        false,
        ["ID", "PROPERTY_" . $propertyCode]
);
if ($arElement = $res->GetNext()) {
    $currentValue = $arElement["PROPERTY_" . $propertyCode . "_VALUE"]; // Текущее значение
}
// 3. Формируем новое значение, добавляя новую строку к старой
echo $newValueForSave = $currentValue + $newValue;

exit// 4. Сохраняем новое значение свойством SetPropertyValuesEx
/*$result = CIBlockElement::SetPropertyValuesEx(
        $elementId,
        $iblockId,
        [$propertyCode => $newValueForSave] // Код свойства без "PROPERTY_"
);*/
?>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>