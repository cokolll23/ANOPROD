<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

foreach ($arResult["ITEMS"] as $arItem){
    $sectionId = $arItem['IBLOCK_SECTION_ID'];
    $res = \CIBlockSection::GetByID($sectionId);
    if ($arSection = $res->GetNext()) {
        $sectionName = $arSection['NAME'];
    } else {
        echo "Раздел с ID " . $sectionId . " не найден или неактивен.";
    }
    if (empty($sectionName)) {
        $sectionId = 0;
    }

    $groupedElements[$sectionName][] = $arItem;
}

$arResult["GROUPPED_ITEMS"] = $groupedElements;