<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\IO\File;
use Bitrix\Main\Loader;
use Bitrix\Main\UI\Extension;
use Korus\Main\Helpers\Layout;
use Korus\Vult\Helpers\IBlock;

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @var CBitrixComponentTemplate $this */

Extension::load(['utils.glide-slider-controller', 'utils.bootstrap-grid']);
Loader::includeModule('korus.vult');

$this->addExternalCss($this->getFolder() . "/detail.css");
$this->addExternalJs($this->getFolder() . "/detail.js");

$branch = $arResult['BRANCH'];
$APPLICATION->SetTitle($branch['NAME']);
$APPLICATION->AddChainItem($branch['NAME']);
foreach (['phone', 'email', 'address', 'job_time'] as $key) {
    if (!empty($branch[$key])) {
        $existDataContact = true;
        break;
    }
}
?>

<div class="branch-detail-section-wrapper">
    <section class="row branch-detail-section">
        <div class="col col-sm-12 col-xl-<?=$existDataContact ? '7' : '12'?> col-xxl-<?=$existDataContact ? '8' : '12'?>">
            <div class="branch-detail-block h-100">
                <div class="branch-detail-block-content">
                    <? if (!empty($branch['head_user'])) { ?>
                        <div class="branch-detail-manager-card branch-detail-manager-card--boss">
                        <?php
                        $employee = $branch['head_user'];
                        $avatar = '';
                        if ($employee['PERSONAL_PHOTO']) {
                            $img = CFile::ResizeImageGet($employee['PERSONAL_PHOTO'], ['width' => 154, 'height' => 154], BX_RESIZE_IMAGE_EXACT);
                            if ($img && File::isFileExists($_SERVER['DOCUMENT_ROOT'] . $img['src'])) {
                                $avatar = 'style="background-image: url(\'' . $img['src'] . '\'); background-size: cover;"';
                            }
                        }
                        $detailPage = str_replace('#user_id#', $employee['ID'], $arParams['PERSONAL_URL']);
                        ?>
                        <a href="<?= $detailPage ?>" class="branch-detail-manager-card-avatar-wrapper">
                            <div class="ui-icon ui-icon-common-user ui-icon-xl">
                                <i <?= $avatar ?>></i>
                            </div>
                        </a>

                        <div class="branch-detail-manager-card-content">
                            <a href="<?= $detailPage ?>" class="branch-detail-manager-card-name ui-link ui-link-dark">
                                <?= CUser::FormatName(CSite::GetDefaultNameFormat(), $employee); ?>
                            </a>
                            <span class="branch-detail-manager-card-position"><?= GetMessage('EMPLOYEES_COMPANY_BRANCH_HEAD'); ?></span>
                        </div>
                    </div>
                    <? } ?>
                    <?php
                    if (!empty(trim($branch['DETAIL_TEXT']))): ?>
                        <? if (!empty($branch['head_user'])) { ?>
                            <hr class="branch-detail-manager-card-hr"/>
                        <? } ?>
                        <header class="branch-detail-block-header mainpage-block-header">
                            <h2 class="branch-detail-block-title mainpage-block-title"><?= GetMessage('EMPLOYEES_COMPANY_BRANCH_ABOUT'); ?></h2>
                        </header>

                        <div class="branch-detail-block-content">
                            <div class="branch-detail-block-content-inner <?= !$existDataContact ? 'branch-detail-block-content-inner-width' : '' ?>"><?= $branch['DETAIL_TEXT']; ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <? if ($existDataContact) { ?>
            <div class="col col-sm-12 col-xl-5 col-xxl-4">
            <div class="branch-detail-block h-100">
                <header class="branch-detail-block-header mainpage-block-header">
                    <h2 class="branch-detail-block-title mainpage-block-title"><?= GetMessage('EMPLOYEES_COMPANY_BRANCH_CONTACTS'); ?></h2>
                </header>

                <div class="branch-detail-block-content">
                    <div class="branch-detail-contacts">
                        <div class="branch-detail-contacts-block branch-detail-contacts-block--phone">
                            <span class="branch-detail-contacts-block-title"><?= GetMessage('EMPLOYEES_COMPANY_BRANCH_PHONE'); ?></span>
                            <span class="branch-detail-contacts-block-body">
                                <?php if ($branch['phone']): ?>
                                    <a href="tel:<?= $branch['phone']; ?>" class="branch-detail-contacts-block-link ui-link ui-link-primary">
                                        <?= $branch['phone']; ?>
                                    </a>
                                <?php else: ?>
                                    &mdash;
                                <?php endif; ?>
                            </span>
                        </div>

                        <div class="branch-detail-contacts-block branch-detail-contacts-block--mail">
                            <span class="branch-detail-contacts-block-title"><?= GetMessage('EMPLOYEES_COMPANY_BRANCH_EMAIL'); ?></span>
                            <span class="branch-detail-contacts-block-body">
                                <?php if ($branch['email']): ?>
                                    <a href="mailto:<?= $branch['email']; ?>" class="branch-detail-contacts-block-link ui-link ui-link-primary">
                                        <?= $branch['email']; ?>
                                    </a>
                                <?php else: ?>
                                    &mdash;
                                <?php endif; ?>
                            </span>
                        </div>

                        <div class="branch-detail-contacts-block branch-detail-contacts-block--address">
                            <span class="branch-detail-contacts-block-title"><?= GetMessage('EMPLOYEES_COMPANY_BRANCH_ADDRESS'); ?></span>
                            <span class="branch-detail-contacts-block-body">
                                <?php if ($branch['address']): ?>
                                    <?= $branch['address']; ?>
                                <?php else : ?>
                                    &mdash;
                                <?php endif; ?>
                            </span>
                        </div>

                        <div class="branch-detail-contacts-block branch-detail-contacts-block--worktime">
                            <span class="branch-detail-contacts-block-title"><?= GetMessage('EMPLOYEES_COMPANY_BRANCH_WORK_TIME'); ?></span>
                            <span class="branch-detail-contacts-block-body">
                                <span class="branch-detail-contacts-block-icon kt-mask-icon-wrapper">
                                    <span class="kt-ui-size-md kt-mask-icon"></span>
                                    <span><?= $branch['job_time']; ?></span>
                                </span>
                            </span>
                        </div>

                        <div class="branch-detail-contacts-block branch-detail-contacts-block--actions">
                            <span class="branch-detail-contacts-block-body">
                                <button type="button" class="ui-btn ui-btn-primary" onclick="location.href = '/company/?apply_filter=Y&DEPARTMENT=DR<?= $branch['branch']['ID'] ?>'"><?= GetMessage('EMPLOYEES_COMPANY_BRANCH_PHONE_LIST'); ?></button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <? } ?>
    </section>

    <?php if (!empty($branch['leaders'])): ?>
        <section class="branch-detail-section">
            <div class="branch-detail-block leaders-block">
                <header class="branch-detail-block-header mainpage-block-header">
                    <h2 class="branch-detail-block-title mainpage-block-title"><?= GetMessage('EMPLOYEES_COMPANY_BRANCH_LEADERS'); ?></h2>
                </header>

                <div class="branch-detail-block-content">
                    <div class="[ branch-detail-direction-leader-slider ] glide"
                         id="js-branch-detail-direction-leader-slider"
                         data-glide-slider-controller
                    >
                        <div class="glide__track" data-glide-el="track">
                            <ul class="glide__slides" data-glide-slider-list>
                                <?php
                                foreach ($branch['leaders'] as $direction) {
                                    $employee = $direction['USER'];
                                    ?>
                                    <li class="[ branch-detail-direction-leader-slider-item ] glide__slide"
                                        data-glide-slide
                                    >
                                        <div class="branch-detail-direction-leader-card">
                                            <header class="branch-detail-direction-leader-card-header">
                                                <?php
                                                if ($direction['IMAGE']) {
                                                    $img = CFile::ResizeImageGet($direction['IMAGE'], ['width' => 36, 'height' => 36]);
                                                    if ($img) {
                                                        ?>
                                                        <span class="branch-detail-direction-leader-card-icon">
                                                            <img src="<?= $img['src'] ?>" alt="<?= $direction['NAME'] ?>">
                                                        </span>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <span class="branch-detail-direction-leader-card-title"><?= $direction['NAME'] ?></span>
                                            </header>
                                            <div class="branch-detail-direction-leader-card-body">
                                                <?php
                                                $avatar = '';
                                                if ($employee['PERSONAL_PHOTO']) {
                                                    $img = CFile::ResizeImageGet($employee['PERSONAL_PHOTO'], ['width' => 95, 'height' => 95], BX_RESIZE_IMAGE_EXACT);
                                                    if ($img && File::isFileExists($_SERVER['DOCUMENT_ROOT'] . $img['src'])) {
                                                        $avatar = 'style="background-image: url(\'' . $img['src'] . '\'); background-size: cover;"';
                                                    }
                                                }
                                                $detailPage = str_replace('#user_id#', $employee['ID'], $arParams['PERSONAL_URL']);
                                                ?>
                                                <a href="<?= $detailPage ?>" class="branch-detail-direction-leader-card-avatar-wrapper">
                                                    <div class="branch-detail-direction-leader-card-avatar ui-icon ui-icon-common-user">
                                                        <i <?= $avatar ?>></i>
                                                    </div>
                                                </a>

                                                <div class="branch-detail-direction-leader-card-content">
                                                    <a href="<?= $detailPage ?>" class="branch-detail-direction-leader-card-name ui-link ui-link-dark">
                                                        <?= CUser::FormatName(CSite::GetDefaultNameFormat(), $employee); ?>
                                                    </a>
                                                    <?php if ($employee['WORK_POSITION']):?>
                                                        <span class="branch-detail-direction-leader-card-position"><?= $employee['WORK_POSITION'] ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>

                        <div data-glide-el="controls">
                            <button type="button"
                                    data-glide-btn-prev
                                    data-glide-dir="<"
                                    class="base-slider-button ui-btn kt-btn-icon kt-mask-icon"
                            >
                            </button>
                            <button type="button"
                                    data-glide-btn-next
                                    data-glide-dir=">"
                                    class="base-slider-button ui-btn kt-btn-icon kt-mask-icon"
                            >
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <script>
        let eventsData = [];
    </script>
    <?php
    if (!empty($branch['events'])) {

        $branchEvents = [];
        for ($i = 0; $i < count($branch['events']); $i++) {
            $event = $branch['events'][$i];
            $eventDate = strtotime($event['date']);

            $branchEvents[$i] = $event;
            $branchEvents[$i]['timeFrom'] = $event['time-from'];
            $branchEvents[$i]['timeTo'] = $event['time-to'];
            $branchEvents[$i]['day'] = FormatDate('d', $eventDate);
            $branchEvents[$i]['month'] = mb_strtolower(FormatDate('M', $eventDate));
        }

        ?>
        <script>
            eventsData = <?= json_encode($branchEvents); ?>;
        </script>
        <section class="branch-detail-section">
            <div class="branch-detail-block">
                <header class="branch-detail-block-header mainpage-block-header">
                    <h2 class="branch-detail-block-title mainpage-block-title"><?= GetMessage('EMPLOYEES_COMPANY_BRANCH_POSTER'); ?></h2>
                </header>

                <div class="branch-detail-block-content">
                    <div class="[ branch-detail-event-slider ] glide"
                         id="js-branch-detail-event-slider"
                         data-glide-slider-controller
                    >
                        <div class="[ branch-detail-event-slider-track ] glide__track" data-glide-el="track">
                            <ul class="[ branch-detail-event-slider-list ] glide__slides" data-glide-slider-list></ul>
                        </div>

                        <div data-glide-el="controls">
                            <button type="button"
                                    data-glide-btn-prev
                                    data-glide-dir="<"
                                    class="base-slider-button events-slider-button ui-btn kt-btn-icon kt-mask-icon"
                            >
                            </button>
                            <button type="button"
                                    data-glide-btn-next
                                    data-glide-dir=">"
                                    class="base-slider-button events-slider-button ui-btn kt-btn-icon kt-mask-icon"
                            >
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    if ($branch['branch']['ID']) {
        ob_start();
        $GLOBALS['arrFilter'] = ['PROPERTY_DEPARTMENT' => $branch['branch']['ID']];
        $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "",
            [
                "SHOW_TITLE" => "N",
                "IBLOCK_ID" => IBlock::getIblockIdByCode("KORUS_NEWS"),
                "IBLOCK_TYPE" => "news",
                "NEWS_COUNT" => 6,
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_BY2" => "ID",
                "SORT_ORDER1" => "DESC",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => 'arrFilter',
                "FIELD_CODE" => array_merge(['XML_ID'], [
                    0 => "DATE_ACTIVE_FROM",
                    1 => "DATE_CREATE",
                    2 => "TAGS",
                ]),
                "PROPERTY_CODE" => [
                    0 => "CATEGORY",
                    1 => "REGIONS",
                    2 => "",
                ],
                "CHECK_DATES" => 'Y',
                "IBLOCK_URL" => '/news/',
                "SECTION_URL" => '/news/',
                "DETAIL_URL" => '/news/#CODE#/',
                "SEARCH_PAGE" => '/news/',
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",

                "PREVIEW_TRUNCATE_LEN" => '',
                "ACTIVE_DATE_FORMAT" => '',
                "SET_TITLE" => 'N',
                "SET_BROWSER_TITLE" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_META_DESCRIPTION" => "N",
                "MESSAGE_404" => '',
                "SET_STATUS_404" => 'N',
                "SHOW_404" => 'N',
                "FILE_404" => null,
                "SET_LAST_MODIFIED" => 'N',
                "INCLUDE_IBLOCK_INTO_CHAIN" => 'N',
                "ADD_SECTIONS_CHAIN" => "N",
                "HIDE_LINK_WHEN_NO_DETAIL" => 'N',

                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "INCLUDE_SUBSECTIONS" => "Y",

                "DISPLAY_DATE" => 'Y',
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => 'Y',
                "DISPLAY_PREVIEW_TEXT" => 'Y',
                "MEDIA_PROPERTY" => '',
                "SLIDER_PROPERTY" => '',

                "PAGER_TEMPLATE" => '.default',
                "DISPLAY_TOP_PAGER" => 'N',
                "DISPLAY_BOTTOM_PAGER" => 'Y',
                "PAGER_TITLE" => 'Новости',
                "PAGER_SHOW_ALWAYS" => 'N',
                "PAGER_DESC_NUMBERING" => 'N',
                "PAGER_DESC_NUMBERING_CACHE_TIME" => 36000,
                "PAGER_SHOW_ALL" => 'N',
                "PAGER_BASE_LINK_ENABLE" => 'N',
                "PAGER_BASE_LINK" => null,
                "PAGER_PARAMS_NAME" => null,

                "USE_RATING" => 'N',
                "DISPLAY_AS_RATING" => 'rating',
                "MAX_VOTE" => 1,
                "VOTE_NAMES" => [1, 2, 3, 4, 5],

                "USE_SHARE" => null,
                "SHARE_HIDE" => null,
                "SHARE_TEMPLATE" => null,
                "SHARE_HANDLERS" => null,
                "SHARE_SHORTEN_URL_LOGIN" => null,
                "SHARE_SHORTEN_URL_KEY" => null,

                "TEMPLATE_THEME" => 'blue',
                "FORUM_ID" => 1,
                "INTRANET_TOOLBAR" => "N"
            ],
            null
        );
        $news = ob_get_clean();
        if (trim($news)) {
            ?>
            <section class="branch-detail-section">
                <div class="branch-detail-block">
                    <header class="branch-detail-block-header mainpage-block-header">
                        <h2 class="branch-detail-block-title mainpage-block-title"><?= GetMessage('EMPLOYEES_COMPANY_BRANCH_NEWS'); ?></h2>
                    </header>

                    <div class="branch-detail-block-content">
                        <div id="news-container"><?= $news ?></div>
                    </div>
                </div>
            </section>
            <?php
        }
    }

    if ($branch['business']['TEXT']): ?>
        <section class="branch-detail-section">
            <div class="branch-detail-block">
                <header class="branch-detail-block-header mainpage-block-header">
                    <h2 class="branch-detail-block-title mainpage-block-title"><?= GetMessage('EMPLOYEES_COMPANY_BRANCH_BUSINESS'); ?></h2>
                </header>

                <div class="branch-detail-block-content"><?= $branch['business']['TEXT'] ?></div>
            </div>
        </section>
    <?php endif; ?>

    <?php if ($branch['requisite']['TEXT']): ?>
        <section class="branch-detail-section">
            <div class="branch-detail-block">
                <header class="branch-detail-block-header mainpage-block-header">
                    <h2 class="branch-detail-block-title mainpage-block-title"><?= GetMessage('EMPLOYEES_COMPANY_BRANCH_REQUISITES'); ?></h2>
                </header>

                <div class="branch-detail-block-content"><?= $branch['requisite']['TEXT'] ?></div>
            </div>
        </section>
    <?php endif; ?>
</div>
