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
//$elemID = 279369;
\Bitrix\Main\UI\Extension::load('ui.fonts.opensans');
$this->addExternalCss("/bitrix/css/main/bootstrap.css");
$this->addExternalCss("/bitrix/css/main/font-awesome.css");
$this->addExternalCss($this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css');
/*pretty_print($arResult);*/
?>
<div class="bx-newslist">
    <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
        <?= $arResult["NAV_STRING"] ?><br/>
    <? endif; ?>
    <div class="row row-flex flex">
        <?
        foreach ($arResult["ITEMS"] as $arItem): ?>
            <? if ($arItem["ID"] == 279369) {
                $DETAIL_PAGE_URL='/benefity/dfp.php';
            }else{
                $DETAIL_PAGE_URL=$arItem["DETAIL_PAGE_URL"] . '&clear_cache=Y';
            } ?>

            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="bx-newslist-container col-sm-6 col-md-4" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="newslist-container_inner">
                    <div class="bx-newslist-topblock ">

                        <? if (is_array($arItem["PREVIEW_PICTURE"])): ?>
                            <div class="bx-newslist-img abs"
                                 style="width: <?= $arItem['PROPERTIES']['IMG_WIDTH']['VALUE']; ?>;
                                         bottom: <?= $arItem['PROPERTIES']['IMG_BOTTOM']['VALUE']; ?>;
                                         left: <?= $arItem['PROPERTIES']['IMG_TOP']['VALUE']; ?>;">
                                <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                                    <a href="<?= $DETAIL_PAGE_URL ?>"><img
                                                src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                                width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                                                height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                                                alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                                title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                                        /></a>
                                <? else: ?>
                                    <img
                                            src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                            width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                                            height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                                            alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                            title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                                    />
                                <? endif; ?>
                            </div>
                        <? endif; ?>

                        <div class="main-img-block ">
                            <a href="<?= $DETAIL_PAGE_URL ?>"><img
                                        src="/local/imgs/main.png"
                                        width="100%"
                                        height=""
                                        alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                        title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                                /></a>
                        </div>


                    </div>
                    <div class="bx-newslist-block">
                        <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
                            <h3 class="bx-newslist-title">
                                <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                                    <a href="<? echo $DETAIL_PAGE_URL ?>"><? echo $arItem["NAME"] ?></a>
                                <? else: ?>
                                    <? echo $arItem["NAME"] ?>
                                <? endif; ?>
                            </h3>
                        <? endif; ?>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <br/><?= $arResult["NAV_STRING"] ?>
    <? endif; ?>

</div>
