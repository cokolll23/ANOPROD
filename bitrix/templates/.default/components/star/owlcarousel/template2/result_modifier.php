<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
    die();
}


foreach ($arResult["ITEMS"] as $arItem){
    $arResultModif[$arItem['ID']] = $arItem;
}
$arResult["IDS"] = $arResultModif;
