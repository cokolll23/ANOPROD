<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$this->addExternalCss("/bitrix/css/main/bootstrap.css");
$this->addExternalCss("/bitrix/css/main/font-awesome.css");
$this->addExternalCss($this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css');
//CUtil::InitJSCore(['fx', 'ui.fonts.opensans']);
global $USER;
$curUserID=$USER->GetID();

?>

<div class="benefit-detail bx-newsdetail">

    <div class="bx-newsdetail-block" id="<? echo $this->GetEditAreaId($arResult['ID']) ?>">
        <div class="detail-block-top container">

            <div class="detail-block-top-inner gradient  rel">

                <div class="detail-block-top-inner_img  abs flex"
                     style="height:inherit;bottom: <?= $arResult['PROPERTIES']['DETAIL_IMG_BOTTOM']['VALUE']; ?>;
                             left: <?= $arResult['PROPERTIES']['DETAIL_IMG_TOP']['VALUE']; ?>"
                >
                    <? if ($arParams["DISPLAY_PICTURE"] != "N"): ?>
                        <? if (is_array($arResult["DETAIL_PICTURE"])): ?>
                            <div class="bx-newsdetail-img1" >
                                <img style="height: inherit;"
                                        src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>"
                                        width="<?= $arResult['PROPERTIES']['DETAIL_IMG_WIDTH']['VALUE']; ?> "
                                        height="100px"
                                        alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                                        title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"
                                />
                            </div>
                        <? endif; ?>
                    <? endif ?>

                </div>
                <h1 class="bx-newsdetail-title">
                    <?= $arResult["NAME"] ?>
                </h1>
            </div>
        </div>

        <div class="bx-newsdetail-content">
            <? if ($arResult["NAV_RESULT"]): ?>
                <? if ($arParams["DISPLAY_TOP_PAGER"]): ?><?= $arResult["NAV_STRING"] ?><br/><? endif; ?>
                <? echo $arResult["NAV_TEXT"]; ?>
                <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?><br/><?= $arResult["NAV_STRING"] ?><? endif; ?>
            <? elseif ($arResult["DETAIL_TEXT"] <> ''): ?>
                <? echo $arResult["DETAIL_TEXT"]; ?>

            <? endif ?>
        </div>
        <? if ($arResult["PROPERTIES"]["SHOIW_IB"]["VALUE_XML_ID"]==='Y'): ?>
        <div class="container">

            <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "flat1",
                    [
                            "ADD_ELEMENT_CHAIN" => "N",
                            "ADD_SECTIONS_CHAIN" => "Y",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "BROWSER_TITLE" => "-",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CHECK_DATES" => "Y",
                            "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
                            "DETAIL_DISPLAY_TOP_PAGER" => "N",
                            "DETAIL_FIELD_CODE" => [
                                    0 => "",
                                    1 => "",
                            ],
                            "DETAIL_PAGER_SHOW_ALL" => "Y",
                            "DETAIL_PAGER_TEMPLATE" => "",
                            "DETAIL_PAGER_TITLE" => "Страница",
                            "DETAIL_PROPERTY_CODE" => [
                                    0 => "",
                                    1 => "",
                            ],
                            "DETAIL_SET_CANONICAL_URL" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "Y",
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "46",
                            "IBLOCK_TYPE" => "benefity",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                            "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "LIST_FIELD_CODE" => [
                                    0 => "",
                                    1 => "",
                            ],
                            "LIST_PROPERTY_CODE" => [
                                    0 => "IMG_TOP",
                                    1 => "IMG_BOTTOM",
                                    2 => "IMG_WIDTH",
                                    3 => "",
                            ],
                            "MESSAGE_404" => "",
                            "META_DESCRIPTION" => "-",
                            "META_KEYWORDS" => "-",
                            "NEWS_COUNT" => "20",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Новости",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "SEF_MODE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "Y",
                            "SHOW_404" => "N",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER1" => "DESC",
                            "SORT_ORDER2" => "ASC",
                            "STRICT_SECTION_CHECK" => "N",
                            "USE_CATEGORIES" => "N",
                            "USE_FILTER" => "N",
                            "USE_PERMISSIONS" => "N",
                            "USE_RATING" => "N",
                            "USE_REVIEW" => "N",
                            "USE_RSS" => "N",
                            "USE_SEARCH" => "N",
                            "USE_SHARE" => "N",
                            "COMPONENT_TEMPLATE" => "flat",
                            "TEMPLATE_THEME" => "red",
                            "MEDIA_PROPERTY" => "",
                            "SLIDER_PROPERTY" => "",
                            "LIST_USE_SHARE" => "",
                            "VARIABLE_ALIASES" => [
                                    "SECTION_ID" => "SECTION_ID",
                                    "ELEMENT_ID" => "ELEMENT_ID",
                            ]
                    ],
                    false
            ); ?>
            <?= $arResult['DISPLAY_PROPERTIES']['DOP_TEXT']['DISPLAY_VALUE']; ?>
        </div>
        <? endif; ?>
    </div>
</div>


<script>

    BX.ready(function () {
        $('body').on('click','.btn-insurance', function (e) {
            e.preventDefault();
            var curUserID = <?= $curUserID;?>;
            var curLKLiink = '/company/personal/user/'+curUserID+'/';
            window.location.href = curLKLiink;
        });
    });
</script>

