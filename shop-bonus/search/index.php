<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");

?>
    <style>
        .search-page input[type="submit"] {
            border: 2px, solid, var(--kt-ui-link-primary);
            text-transform: lowercase;
            border-radius: 3px;
        }
    </style>
    <div class="container search-page">
        <? $APPLICATION->IncludeComponent("bitrix:search.page",
                "shop",
                array(
                "RESTART" => "N",
                "CHECK_DATES" => "N",
                "USE_TITLE_RANK" => "N",
                "DEFAULT_SORT" => "rank",
                "arrFILTER" => array(
                        0 => "iblock_catalog",
                        1 => "iblock_users",
                ),
                "arrFILTER_iblock_catalog" => array(
                        0 => "all",
                ),
                "arrFILTER_iblock_users" => array(
                        0 => "all",
                ),
                "SHOW_WHERE" => "N",
                "SHOW_WHEN" => "N",
                "PAGE_RESULT_COUNT" => "25",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_SHADOW" => "Y",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "Результаты поиска",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "arrows",
                "USE_SUGGEST" => "N",
                "SHOW_ITEM_TAGS" => "N",
                "SHOW_ITEM_DATE_CHANGE" => "N",
                "SHOW_ORDER_BY" => "N",
                "SHOW_TAGS_CLOUD" => "N",
                "AJAX_OPTION_ADDITIONAL" => ""
        ),
                false
        ); ?>
    </div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>