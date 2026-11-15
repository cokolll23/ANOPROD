<?php

use Bitrix\Main\Config\Configuration;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\UI\Extension;
use Korus\Buddy\Service\Telegram\LoginService;
use Bitrix\UI\Toolbar\Facade\Toolbar;
use Korus\Main\Helpers\Layout;

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\UserTable;
use Bitrix\Main\Application;
use Bitrix\Main\Web\Uri;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */
Extension::load(['sidepanel', 'ui.entity-selector', 'ui.avatar-editor', 'avatar_editor']);

Layout::setTransparentWorkarea();

$pageId = "user";
//var_dump($arResult);

if ($_REQUEST['old'] == 'Y' || $_REQUEST['IFRAME'] == 'Y') {
    $componentParams = [
            "PATH_TO_USER" => $arResult["PATH_TO_USER"],
            "PATH_TO_USER_EDIT" => $arResult["PATH_TO_USER_PROFILE_EDIT"],
            "PATH_TO_USER_FRIENDS" => $arResult["PATH_TO_USER_FRIENDS"],
            "PATH_TO_USER_GROUPS" => $arResult["PATH_TO_USER_GROUPS"],
            "PATH_TO_USER_FRIENDS_ADD" => $arResult["PATH_TO_USER_FRIENDS_ADD"],
            "PATH_TO_USER_FRIENDS_DELETE" => $arResult["PATH_TO_USER_FRIENDS_DELETE"],
            "PATH_TO_MESSAGE_FORM" => $arResult["PATH_TO_MESSAGE_FORM"],
            "PATH_TO_MESSAGES_CHAT" => $arResult["PATH_TO_MESSAGES_CHAT"],
            "PATH_TO_MESSAGES_USERS_MESSAGES" => $arResult["PATH_TO_MESSAGES_USERS_MESSAGES"],
            "PATH_TO_USER_SETTINGS_EDIT" => $arResult["PATH_TO_USER_SETTINGS_EDIT"],
            "PATH_TO_GROUP" => $arParams["PATH_TO_GROUP"],
            "PATH_TO_GROUP_CREATE" => $arResult["PATH_TO_GROUP_CREATE"],
            "PATH_TO_USER_FEATURES" => $arResult["PATH_TO_USER_FEATURES"],
            "PATH_TO_EXTMAIL" => $arResult["PATH_TO_MAIL"] ?? '',
            "PATH_TO_USER_REQUESTS" => $arResult["PATH_TO_USER_REQUESTS"],
            "PAGE_VAR" => $arResult["ALIASES"]["page"] ?? '',
            "USER_VAR" => $arResult["ALIASES"]["user_id"] ?? '',
            "PATH_TO_SEARCH" => $arResult["PATH_TO_SEARCH"],
            "PATH_TO_SEARCH_INNER" => $arResult["PATH_TO_SEARCH_INNER"],
            "SET_NAV_CHAIN" => $arResult["SET_NAV_CHAIN"],
            "SET_TITLE" => $arResult["SET_TITLE"],
            "USER_PROPERTY_MAIN" => $arResult["USER_PROPERTY_MAIN"],
            "USER_PROPERTY_CONTACT" => $arResult["USER_PROPERTY_CONTACT"],
            "USER_PROPERTY_PERSONAL" => $arResult["USER_PROPERTY_PERSONAL"],
            "USER_FIELDS_MAIN" => $arResult["USER_FIELDS_MAIN"],
            "USER_FIELDS_CONTACT" => $arResult["USER_FIELDS_CONTACT"],
            "USER_FIELDS_PERSONAL" => $arResult["USER_FIELDS_PERSONAL"],
            "EDITABLE_FIELDS" => $arParams["EDITABLE_FIELDS"],
            "DATE_TIME_FORMAT" => $arResult["DATE_TIME_FORMAT"],
            "SHORT_FORM" => "N",
            "ITEMS_COUNT" => $arParams["ITEM_MAIN_COUNT"],
            "ID" => $arResult["VARIABLES"]["user_id"],
            "PATH_TO_BLOG" => $arResult["PATH_TO_USER_BLOG"],
            "PATH_TO_POST" => $arResult["PATH_TO_USER_BLOG_POST"],
            "PATH_TO_POST_EDIT" => $arResult["PATH_TO_USER_BLOG_POST_EDIT"],
            "BLOG_GROUP_ID" => $arParams["BLOG_GROUP_ID"],
            "PATH_TO_GROUP_REQUEST_GROUP_SEARCH" => $arResult["PATH_TO_GROUP_REQUEST_GROUP_SEARCH"],
            "PATH_TO_CONPANY_DEPARTMENT" => $arParams["PATH_TO_CONPANY_DEPARTMENT"],
            "PATH_TO_USER_FORUM" => $arResult["PATH_TO_USER_FORUM"],
            "PATH_TO_USER_FORUM_TOPIC" => $arResult["~PATH_TO_USER_FORUM_TOPIC"],
            "FORUM_ID" => $arParams["FORUM_ID"],
            "USER_ID" => $arResult["VARIABLES"]["user_id"],
            "SHOW_YEAR" => $arParams["SHOW_YEAR"],
            "SONET_USER_FIELDS_SEARCHABLE" => $arResult["USER_FIELDS_SEARCHABLE"],
            "SONET_USER_PROPERTY_SEARCHABLE" => $arResult["USER_PROPERTY_SEARCHABLE"],
            "PATH_TO_USER_SUBSCRIBE" => $arResult["PATH_TO_USER_SUBSCRIBE"],
            "PATH_TO_LOG" => $arResult["PATH_TO_LOG"],
            "PATH_TO_ACTIVITY" => $arResult["PATH_TO_ACTIVITY"],
            "PATH_TO_SUBSCRIBE" => $arResult["PATH_TO_SUBSCRIBE"],
            "PATH_TO_GROUP_SEARCH" => $arParams["PATH_TO_GROUP_SEARCH"],
            "CALENDAR_USER_IBLOCK_ID" => $arParams['CALENDAR_USER_IBLOCK_ID'] ?? 0,
            "TASK_VAR" => $arResult["ALIASES"]["task_id"] ?? '',
            "TASK_ACTION_VAR" => $arResult["ALIASES"]["action"] ?? '',
            "PATH_TO_GROUP_TASKS" => $arParams["PATH_TO_GROUP_TASKS"],
            "PATH_TO_GROUP_TASKS_TASK" => $arParams["PATH_TO_GROUP_TASKS_TASK"],
            "PATH_TO_GROUP_TASKS_VIEW" => $arParams["PATH_TO_GROUP_TASKS_VIEW"],
            "PATH_TO_USER_TASKS" => $arResult["PATH_TO_USER_TASKS"],
            "PATH_TO_USER_TASKS_TASK" => $arResult["PATH_TO_USER_TASKS_TASK"],
            "PATH_TO_USER_TASKS_VIEW" => $arResult["PATH_TO_USER_TASKS_VIEW"],
            "TASK_FORUM_ID" => $arParams["TASK_FORUM_ID"],
            "PATH_TO_VIDEO_CALL" => $arResult["PATH_TO_VIDEO_CALL"],
            "PATH_TO_USER_CONTENT_SEARCH" => $arResult["PATH_TO_USER_CONTENT_SEARCH"],
            "THUMBNAIL_LIST_SIZE" => 30,
            "LOG_AVATAR_SIZE" => $arParams["LOG_THUMBNAIL_SIZE"] ?? null,
            "LOG_AVATAR_SIZE_COMMENT" => $arParams["LOG_COMMENT_THUMBNAIL_SIZE"] ?? null,
            "NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
            "SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
            "CAN_OWNER_EDIT_DESKTOP" => $arParams["CAN_OWNER_EDIT_DESKTOP"],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "USE_MAIN_MENU" => $arParams["USE_MAIN_MENU"],
            "SHOW_RATING" => $arParams["SHOW_RATING"],
            "RATING_ID" => $arParams["RATING_ID"],
            "RATING_TYPE" => $arParams["RATING_TYPE"],
            "BLOG_ALLOW_POST_CODE" => $arParams["BLOG_ALLOW_POST_CODE"],
            "PATH_TO_USER_SECURITY" => $arResult["PATH_TO_USER_SECURITY"],
            "PATH_TO_USER_COMMON_SECURITY" => $arResult["PATH_TO_USER_COMMON_SECURITY"],
            "PATH_TO_USER_PASSWORDS" => $arResult["PATH_TO_USER_PASSWORDS"],
            "PATH_TO_USER_SYNCHRONIZE" => !empty($arResult["PATH_TO_USER_SYNCHRONIZE"]) ? $arResult["PATH_TO_USER_SYNCHRONIZE"] : null,
            "PATH_TO_USER_CODES" => $arResult["PATH_TO_USER_CODES"],
            "ALLOWALL_USER_PROFILE_FIELDS" => $arParams["ALLOWALL_USER_PROFILE_FIELDS"] ?? '',
    ];

    if (\Bitrix\Main\ModuleManager::isModuleInstalled("intranet") && SITE_TEMPLATE_ID == "bitrix24") {
        if (
                \Bitrix\Main\Context::getCurrent()->getRequest()->get('IFRAME') === 'Y'
                || \Bitrix\Main\Context::getCurrent()->getRequest()->get('mode') === 'dev'
        ) {
            if (
                    \Bitrix\Main\Loader::includeModule('imbot')
                    && \Bitrix\ImBot\Bot\SupportBox::isEnabled()
                    && (\Bitrix\ImBot\Bot\SupportBox::getBotId() === (int)$arResult['VARIABLES']['user_id'])
                    && !\Bitrix\Intranet\CurrentUser::get()->isAdmin()
            ) {
                $APPLICATION->IncludeComponent(
                        'bitrix:ui.sidepanel.wrapper',
                        '',
                        [
                                'POPUP_COMPONENT_NAME' => 'bitrix:socialnetwork.entity.error',
                                'POPUP_COMPONENT_TEMPLATE_NAME' => '',
                                'POPUP_COMPONENT_PARAMS' => [
                                        'ENTITY' => 'SUPPORT_BOT',
                                ],
                                'POPUP_COMPONENT_USE_BITRIX24_THEME' => 'Y',
                                'USE_PADDING' => false,
                                'POPUP_COMPONENT_BITRIX24_THEME_FOR_USER_ID' => $arResult['VARIABLES']['user_id'],
                        ]
                );

                return;
            }

            include("util_menu.php");

            $APPLICATION->IncludeComponent(
                    "bitrix:ui.sidepanel.wrapper",
                    "",
                    [
                            'POPUP_COMPONENT_NAME' => "bitrix:intranet.user.profile",
                            "POPUP_COMPONENT_TEMPLATE_NAME" => "",
                            "POPUP_COMPONENT_PARAMS" => array_merge($componentParams, [
                                    "PATH_TO_POST_EDIT_PROFILE" => $arResult["PATH_TO_USER_BLOG_POST_EDIT_PROFILE"],
                                    "PATH_TO_POST_EDIT_GRAT" => $arResult["PATH_TO_USER_BLOG_POST_EDIT_GRAT"],
                                    "PATH_TO_USER_GRAT" => $arResult["PATH_TO_USER_GRAT"],
                                    "PATH_TO_USER_STRESSLEVEL" => $arResult["PATH_TO_USER_STRESSLEVEL"],
                            ]),
                            "POPUP_COMPONENT_USE_BITRIX24_THEME" => "Y",
                            'USE_PADDING' => false,
                            "POPUP_COMPONENT_BITRIX24_THEME_FOR_USER_ID" => $arResult["VARIABLES"]["user_id"],
                            "POPUP_COMPONENT_PARENT" => $this->getComponent(),
                    ]
            );
        } else {
            $intranetUserListComponentParams = [
                    "PATH_TO_DEPARTMENT" => $arParams["PATH_TO_CONPANY_DEPARTMENT"],
                    "SLIDER_PROFILE_USER_ID" => $arResult["VARIABLES"]["user_id"],
                    "LIST_URL" => SITE_DIR . 'company/',
            ];


            if (
                    \Bitrix\Main\Loader::includeModule('extranet')
                    && CExtranet::isExtranetSite()
            ) {
                $intranetSearchComponentParams["LIST_URL"] = SITE_DIR . 'contacts/';
            }

            $APPLICATION->includeComponent("bitrix:intranet.user.list", "", $intranetUserListComponentParams);
        }
    } else {
        include("util_menu.php");

        $APPLICATION->IncludeComponent(
                "bitrix:socialnetwork.user_profile",
                "",
                $componentParams,
                $this->getComponent()
        );
    }
} else {
    if ($arResult["VARIABLES"]["user_id"] == $USER->GetID()) {
        $title = 'Личный кабинет';
    } else {
        $asset = Asset::getInstance();
        $asset->addJs($this->GetFolder() . "/js/user.js");
        $asset->addString(
                <<<HTML
<script type="text/javascript">
    BX.ready(function () {
      new SocialNetworkUser(); 
    })
</script>
HTML
        );
        Toolbar::addAfterTitleHtml(
                sprintf(
                        '<span class="ui-toolbar-star %s" id="uiToolbarStarCustom"></span>',
                        $arResult['favourite'] ? 'ui-toolbar-star-active' : ''
                )
        );
        $title = 'Кабинет сотрудника';
    }
    Toolbar::deleteFavoriteStar();

    $APPLICATION->SetTitle($title);

    if (Loader::includeModule('korus.buddy') && Option::get('korus.buddy', 'tgActive') === 'Y') {
        ob_start();
        echo '<div class="ui-toolbar-after-title-tg-button">';
        LoginService::loginHandler();
        echo LoginService::getWidget();
        echo '</div>';
        $html = ob_get_clean();
        Toolbar::addRightCustomHtml($html);
        Asset::getInstance()->addCss($this->GetFolder() . '/user.css');
    } ?>


    <?php include("util_menu.php"); ?>
    <style>
        html {
            scroll-behavior: smooth;
        }

        .marathon-wrapp {
            width: 100%;
            height: 100px;
            background-color: #fff;
            border-radius: 15px;
            margin-bottom: 20px;
            margin-top: 10px;
        }

        .marathon-wrapp {
            /* Путь к вашему сохраненному изображению */
            background-image: url('/local/imgs/marathon/mar.png');

            /* Растягивает изображение по размеру блока с сохранением пропорций */
            background-size: cover;

            /* Выравнивание: по правому краю и центру по вертикали,
               чтобы главные элементы (звезды) всегда оставались на виду */
            background-position: center right;

            /* Запрет повторения фона */
            background-repeat: no-repeat;

            /* Резервный цвет фона, совпадающий со светлой частью картинки */
            background-color: #ffffff;

            /* Скругление углов блока (как на оригинальном баннере) */
            border-radius: 24px;

            /* Пример размеров и отступов (настройте под свой макет) */
            width: 100%;
            min-height: 250px;
            box-sizing: border-box;
            padding: 30px;
        }
    </style>
    <? $request = Application::getInstance()->getContext()->getRequest();
    $uriString = $request->getRequestUri();
    $currentUserId = \Bitrix\Main\Engine\CurrentUser::get()->getId();
    if (preg_match('/\/user\/(\d+)\//', $uriString, $matches)) {
        $urlUserId = $matches[1]; // Результат: 911
    }
    $blOwnerLk = $currentUserId == $urlUserId ? 1 : 0;
    ?>

    <? // Верхний блок марафон звезд
    if ($blOwnerLk) :?>

        <style>
            /* Контейнер баннера */
            .banner {

                width: 100%;
                min-height: 250px;
                border-radius: 24px;
                position: relative;
                overflow: hidden;
                display: flex;
                align-items: center;
                padding: 40px 48px;
                margin-bottom: 20px;
                font-family:"IBM Plex Sans", "Helvetica Neue", Helvetica, Arial, sans-serif ;
                /* Подложка: фоновый цвет + изображение со звёздами справа */
                background-color: #ffffff;
                background-image: url('/local/imgs/marathon/mar.png'); /* Путь к вашему фону/картинке со звёздами */
                background-repeat: no-repeat;
                background-position: right center;
                background-size: cover;

                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            }

            /* Контентная колонка */
            .banner__content {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                max-width: 580px;
                z-index: 1;
            }

            /* Заголовок */
            .banner__title {
                font-size: 44px;
                font-weight: 900;
                line-height: 1.1;
                letter-spacing: -0.02em;
                color: #3b3f46;
                text-transform: uppercase;
            }

            .banner__title--highlight {
                color: #e32626;
            }

            /* Подзаголовок */
            .banner__subtitle {
                margin-top: 12px;
                font-size: 20px;
                line-height: 1.3;
                color: #4a4f59;
                font-weight: 500;
            }

            /* Кнопка действия */
            .banner__btn {
                margin-top: 24px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 16px 42px;
                background: #e32626;
                color: #ffffff;
                font-size: 20px;
                font-weight: 700;
                text-decoration: none;
                border-radius: 9999px; /* Капсульная форма */
                box-shadow: 0 4px 14px rgba(227, 38, 38, 0.3);
                transition: background-color 0.2s ease, transform 0.1s ease;
            }

            .banner__btn:hover {
                background-color: #c91f1f;
            }

            .banner__btn:active {
                transform: scale(0.98);
            }

            /* Сроки проведения */
            .banner__dates {
                margin-top: 28px;
                font-size: 14px;
                color: #4a4f59;
                font-weight: 500;
            }

            /* Адаптивность для планшетов и мобильных устройств */
            @media (max-width: 768px) {
                .banner {
                    padding: 32px 24px;
                    background-position: calc(100% + 140px) center;
                }

                .banner__title {
                    font-size: 32px;
                }

                .banner__subtitle {
                    font-size: 16px;
                }

                .banner__btn {
                    padding: 14px 32px;
                    font-size: 17px;
                }
            }

            @media (max-width: 480px) {
                .banner {
                    background-image: none; /* На узких экранах скрываем фон со звездами, чтобы текст оставался читаемым */
                    background: #ffffff;
                }

                .banner__title {
                    font-size: 26px;
                }
            }
        </style>
        <div class="banner">
            <div class="banner__content">
                <h1 class="banner__title">
                    МАРАФОН ЗВЁЗД <span class="banner__title--highlight">2026</span>
                </h1>

                <p class="banner__subtitle">
                    Выразите признание и наградите коллег
                </p>

                <a href="#ms" class="banner__btn">
                    Подарите звезду
                </a>

                <div class="banner__dates">
                    Сроки проведения: 01.11–30.11.2026
                </div>
            </div>
        </div>

    <?php endif; ?>


    <? $APPLICATION->IncludeComponent(
            'korus:spa',
            '',
            [
                    'SPA_PATH' => getLocalPath('assets/spa/korus.office', KTEAM_REPOSITORY),
            ]
    );
    ?>
    <script>
        BX.ready(function () {
            BX.SidePanel.Instance.bindAnchors({
                rules:
                    [
                        {
                            condition: [
                                '<?=Configuration::getInstance('korus.officemap')->get('public')['url']?>',
                            ],
                            options: {
                                'cacheable': false,
                            }
                        },
                    ]
            });
        })
        window.BX.message({
            LK_USER_ID: <?=$arResult["VARIABLES"]["user_id"]?>
        })
    </script>

    <?
    // марафон звезд
    if ($blOwnerLk) :
        ?>
        <? // шапка
        ?>
        <style>
            /* Основной контейнер баннера */
            .promo-banner {
                width: 100%;
                max-height: 550px;
                border-radius: 70px;
                overflow: hidden;
                font-family:"IBM Plex Sans", "Helvetica Neue", Helvetica, Arial, sans-serif ;

                /* Настройка фона (вторая картинка) */
                background-image: url('/local/imgs/marathon/mar_header.png'); /* Укажите путь ко второму изображению */
                background-size: cover;
                background-position: center right;
                background-repeat: no-repeat;

                /* Внутренние отступы */
                padding: 60px;
                display: flex;
                align-items: center;
                position: relative;

                /* Легкая тень для объема */
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);

                margin-top: 20px;
            }

            /* Контейнер для текста */
            .promo-content {
                max-width: 650px;
                position: relative;
                z-index: 2;
            }

            /* Верхний заголовок */
            .promo-title-top {
                font-size: 16px;
                font-weight: 800;
                color: #cc0000;
                text-transform: uppercase;
                letter-spacing: 1px;
                margin-bottom: 10px;
            }

            /* Главный заголовок */
            .promo-title-main {
                font-size: 42px;
                font-weight: 800;
                color: #444444;
                line-height: 1.1;
                margin-bottom: 25px;
            }

            /* Блок правил */
            .promo-rules {
                margin-bottom: 25px;
            }

            .rules-title {
                font-weight: 700;
                font-size: 18px;
                color: #333;
                margin-bottom: 10px;
            }

            .rules-list {
                list-style-type: disc;
                padding-left: 20px;
            }

            .rules-list li {
                font-size: 16px;
                color: #333;
                line-height: 1.5;
                margin-bottom: 8px;
            }

            .rules-list li::marker {
                color: #888; /* Цвет маркеров списка */
            }

            /* Даты */
            .promo-dates {
                font-size: 18px;
                font-weight: 700;
                color: #333;
            }

            /* =========================================
               АДАПТИВНОСТЬ
               ========================================= */

            /* Планшеты */
            @media (max-width: 1024px) {
                .promo-banner {
                    padding: 30px 40px;
                    background-position: center right 20%; /* Сдвигаем фон, чтобы звезды не уходили */
                }

                .promo-title-main {
                    font-size: 34px;
                }
            }

            /* Мобильные устройства */
            @media (max-width: 768px) {
                body {
                    padding: 10px;
                }

                .promo-banner {
                    padding: 25px 20px;
                    border-radius: 20px;
                    /* На мобильных делаем позицию по центру, чтобы звезды были видны */
                    background-position: center;
                    align-items: flex-start;
                }

                /* Добавляем полупрозрачную подложку под текст для читаемости на мобильных */
                .promo-content {
                    background-color: rgba(255, 255, 255, 0.85);
                    padding: 20px;
                    border-radius: 15px;
                    backdrop-filter: blur(5px); /* Размытие фона за текстом (современные браузеры) */
                    max-width: 100%;
                }

                .promo-title-main {
                    font-size: 26px;
                    margin-bottom: 15px;
                }

                .rules-list li {
                    font-size: 14px;
                }

                .promo-dates {
                    font-size: 16px;
                }
            }

            .popup-window {
                bottom: 50% !important;
            }

            .popup-window-content {
                background-color: #fff !important;

            }
        </style>
        <section id="ms" class="promo-banner">
            <div class="promo-content">
                <h1 class="promo-title-top">МАРАФОН ЗВЕЗД 2026</h1>
                <h2 class="promo-title-main">Выразите признание и наградите коллег</h2>

                <div class="promo-rules">
                    <p class="rules-title">Правила:</p>
                    <ul class="rules-list">
                        <li>У каждого из вас есть 5 звёзд, которые можно подарить коллегам из других структурных
                            подразделений.
                        </li>
                        <li>Выберите коллегу и обязательно напишите, за что хотите выразить ему признание.</li>
                        <li>Полученные звёзды отображаются в личном кабинете вместе с комментариями. Комментарии видны
                            только получателю.
                        </li>
                    </ul>
                </div>

                <p class="promo-dates">Сроки проведения: 1–30 ноября 2026 года.</p>
            </div>
        </section>

        <div  class="col-xs-12 col-sm-7 col-lg-8 col-xxl-9 kt-page__right-column">
            <style>
                :root {
                    --primary-red: #ea213a;
                    --primary-red-hover: #d1182f;
                    --primary-red-active: #b51225;
                    --primary-red-light: #fef0f2;
                    --text-main: #181c24;
                    --text-secondary: #717684;
                    --border-color: #f0f2f5;
                    --card-bg: #ffffff;
                    --bg-body: #f4f5f8;
                    --radius-lg: 24px;
                    --radius-md: 16px;
                    --radius-sm: 10px;
                    --shadow-card: 0 16px 40px rgba(0, 0, 0, 0.06), 0 4px 12px rgba(0, 0, 0, 0.03);
                }


                .container {
                    display: flex;
                    gap: 32px;
                    /*
                                        max-width: 700px;*/
                    width: 100%;
                    align-items: flex-start;
                    justify-content: center;
                    margin: 20px auto;
                }

                .card {
                    background: var(--card-bg);
                    border-radius: var(--radius-lg);
                    padding: 32px;
                    box-shadow: var(--shadow-card);
                }

                /* Главная карточка */
                .main-card {
                    flex: 1;
                    /*
                                        max-width: 90%;*/
                    position: relative;
                }

                .header-banner {
                    position: relative;
                    margin-bottom: 24px;
                }

                .header-banner h1 {
                    font-size: 26px;
                    font-weight: 700;
                    letter-spacing: -0.02em;
                    margin-bottom: 6px;
                }

                .header-banner p {
                    color: var(--text-secondary);
                    font-size: 14px;
                }

                .star-illustration {
                    position: absolute;
                    right: 0;
                    top: -12px;
                    width: 72px;
                    height: 72px;
                    filter: drop-shadow(0 8px 16px rgba(234, 33, 58, 0.3));
                }

                .section-box {
                    border: 1px solid var(--border-color);
                    border-radius: var(--radius-md);
                    /*padding: 20px;*/
                    margin-bottom: 24px;
                }

                .section-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 16px;
                }

                .section-title {
                    font-size: 15px;
                    font-weight: 700;
                }

                .remain-badge {
                    font-size: 13px;
                    color: var(--text-secondary);
                }

                .remain-badge b {
                    color: var(--primary-red);
                    font-weight: 700;
                }

                .stars-action-row {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 18px;
                }

                .stars-list {
                    display: flex;
                    gap: 8px;
                }

                .star-icon {
                    width: 32px;
                    height: 32px;
                }

                .btn-send {
                    background: var(--primary-red);
                    color: #fff;
                    border: none;
                    border-radius: var(--radius-sm);
                    padding: 10px 18px;
                    font-size: 14px;
                    font-weight: 600;
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                    cursor: pointer;
                    transition: background 0.15s ease, transform 0.1s ease;
                }

                .btn-send:hover {
                    background: var(--primary-red-hover);
                }

                .btn-send:active {
                    transform: scale(0.98);
                    background: var(--primary-red-active);
                }

                .rules-bar {
                    background: #fafbfd;
                    border-radius: var(--radius-sm);
                    /*padding: 12px 14px;*/
                    display: flex;
                    align-items: center;
                    font-size: 12px;
                    color: #4b5162;
                    gap: 16px;
                }

                .rule-item {
                    display: flex;
                    gap: 8px;
                    flex: 1;
                    line-height: 1.35;
                }

                .rule-item1 {
                    justify-content: start;
                }

                .rule-item2 {
                    justify-content: end;
                }

                .rule-divider {
                    width: 1px;
                    height: 24px;
                    background: #e5e8ee;
                }

                .received-section {
                    margin-bottom: 24px;
                }

                .received-counter {
                    color: var(--primary-red);
                    font-size: 14px;
                    font-weight: 700;
                }

                .stars-grid {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 12px 16px;
                    margin-top: 12px;
                }

                .star-small {
                    width: 22px;
                    height: 22px;
                }

                .comments-header {
                    font-size: 16px;
                    font-weight: 700;
                    margin-bottom: 16px;
                }

                .comment-item {
                    display: flex;
                    align-items: flex-start;
                    gap: 12px;
                    padding: 14px 0;
                    border-bottom: 1px solid #f2f3f7;
                }

                .comment-item:last-child {
                    border-bottom: none;
                    padding-bottom: 0;
                }

                .avatar {
                    width: 42px;
                    height: 42px;
                    border-radius: 50%;
                    background: #e9ecf2;
                    flex-shrink: 0;
                    overflow: hidden;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 14px;
                    font-weight: 600;
                    color: #656d80;
                }

                .comment-content {
                    flex: 1;
                }

                .comment-top {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    margin-bottom: 4px;
                }

                .user-name-row {
                    display: flex;
                    align-items: center;
                    gap: 6px;
                }

                .user-name {
                    font-size: 14px;
                    font-weight: 700;
                }

                .comment-meta {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                }

                .comment-date {
                    font-size: 12px;
                    color: var(--text-secondary);
                }

                .dots-menu {
                    cursor: pointer;
                    color: #9aa0ae;
                    font-size: 16px;
                    line-height: 1;
                    padding: 0 4px;
                }

                .comment-text {
                    font-size: 13px;
                    color: #434958;
                    line-height: 1.4;
                }

                /* Карточка модалки / подарка */
                .modal-card {
                    width: 440px;
                    border-radius: var(--radius-lg);
                    padding: 28px;
                }

                .modal-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                .modal-title {
                    font-size: 18px;
                    font-weight: 700;
                }

                .close-btn {
                    background: none;
                    border: none;
                    cursor: pointer;
                    color: #8c93a3;
                    padding: 4px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 50%;
                    transition: background 0.15s;
                }

                .close-btn:hover {
                    background: #f0f2f5;
                }

                .form-group {
                    margin-bottom: 20px;
                }

                .form-label {
                    display: block;
                    font-size: 13px;
                    font-weight: 600;
                    margin-bottom: 8px;
                    color: #181c24;
                }

                .req {
                    color: var(--primary-red);
                }

                .search-input-wrapper {
                    position: relative;
                }

                .search-icon {
                    position: absolute;
                    left: 14px;
                    top: 50%;
                    transform: translateY(-50%);
                    color: #99a0af;
                    pointer-events: none;
                }

                .input-field {
                    width: 100%;
                    padding: 12px 14px 12px 40px;
                    border: 1px solid #dfe2e8;
                    border-radius: var(--radius-sm);
                    font-size: 13px;
                    outline: none;
                    transition: border-color 0.15s, box-shadow 0.15s;
                }

                .input-field:focus {
                    border-color: #b0b8c6;
                }

                .input-field::placeholder {
                    color: #9ea4b2;
                }

                .user-dropdown {
                    margin-top: 8px;
                    background: #ffffff;
                    border: 1px solid #edf0f5;
                    border-radius: var(--radius-sm);
                    overflow: hidden;
                }

                .user-option {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    padding: 10px 14px;
                    cursor: pointer;
                    transition: background 0.15s;
                }

                .user-option.selected {
                    background: var(--primary-red-light);
                }

                .user-option-avatar {
                    width: 36px;
                    height: 36px;
                    border-radius: 50%;
                    background: #e4e7ee;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-weight: 600;
                    font-size: 13px;
                    color: #555e70;
                    flex-shrink: 0;
                }

                .user-option-info {
                    flex: 1;
                }

                .user-option-name {
                    font-size: 13px;
                    font-weight: 600;
                    color: var(--text-main);
                }

                .user-option-dept {
                    font-size: 11px;
                    color: var(--text-secondary);
                    margin-top: 2px;
                }

                .textarea-wrapper {
                    position: relative;
                }

                .textarea-field {
                    width: 100%;
                    min-height: 110px;
                    padding: 12px 14px;
                    border: 1px solid #dfe2e8;
                    border-radius: var(--radius-sm);
                    font-size: 13px;
                    outline: none;
                    resize: vertical;
                    color: var(--text-main);
                    transition: border-color 0.15s;
                }

                .textarea-field:focus {
                    border-color: #b0b8c6;
                }

                .textarea-field::placeholder {
                    color: #9ea4b2;
                }

                .char-count {
                    text-align: right;
                    font-size: 11px;
                    color: #9ea4b2;
                    margin-top: 6px;
                }

                .alert-banner {
                    background: var(--primary-red-light);
                    border-radius: var(--radius-sm);
                    padding: 12px 14px;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    margin-bottom: 20px;
                    color: var(--primary-red);
                    font-size: 12px;
                    font-weight: 500;
                }

                .modal-actions {
                    display: flex;
                    gap: 12px;
                }

                .btn-cancel {
                    flex: 1;
                    background: #f1f3f7;
                    color: var(--text-main);
                    border: none;
                    border-radius: var(--radius-sm);
                    padding: 12px;
                    font-size: 13px;
                    font-weight: 600;
                    cursor: pointer;
                    transition: background 0.15s;
                }

                .btn-cancel:hover {
                    background: #e5e8ee;
                }

                .btn-submit {
                    flex: 2;
                    background: var(--primary-red);
                    color: #ffffff;
                    border: none;
                    border-radius: var(--radius-sm);
                    padding: 12px;
                    font-size: 13px;
                    font-weight: 600;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 8px;
                    cursor: pointer;
                    transition: background 0.15s;
                }

                .btn-submit:hover {
                    background: var(--primary-red-hover);
                }

                @media (max-width: 900px) {
                    .container {
                        flex-direction: column;
                        align-items: center;
                    }

                    .main-card, .modal-card {
                        width: 100%;
                        max-width: 580px;
                    }
                }

                /* Затемняющий фон */
                .modal-overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100vw;
                    height: 100vh;
                    background: rgba(0, 0, 0, 0.5);
                    backdrop-filter: blur(2px);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 1000;
                    padding: 20px;
                    box-sizing: border-box;

                    /* Плавное появление */
                    opacity: 0;
                    visibility: hidden;
                    transition: opacity 0.25s ease, visibility 0.25s ease;
                }

                /* Активное состояние */
                .modal-overlay.is-open {
                    opacity: 1;
                    visibility: visible;
                }

                /* Само модальное окно */
                .modal-overlay .modal-card {
                    background: #ffffff;
                    border-radius: 16px;
                    width: 100%;
                    max-width: 480px;
                    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
                    transform: translateY(20px) scale(0.96);
                    transition: transform 0.25s ease;
                }

                .modal-overlay.is-open .modal-card {
                    transform: translateY(0) scale(1);
                }


                .received-section {
                    padding: 24px;
                    background: #fff;
                    border-radius: 16px;
                }

                .received-section .section-title {
                    margin: 0 0 16px;
                    font-size: 20px;
                    font-weight: 600;
                    color: #202124;
                }

                .received-stars-row {
                    display: flex;
                    align-items: center;
                    gap: 16px;
                }

                .received-section .stars-grid {
                    display: flex;
                    flex: 1;
                    flex-wrap: wrap;
                    align-items: center;
                    gap: 8px;
                    min-width: 0;
                }

                .received-section .star-small {
                    display: block;
                    flex: 0 0 32px;
                    width: 32px;
                    height: 32px;
                    fill: #e53935;
                }

                .received-section .received-counter {
                    flex-shrink: 0;
                    font-size: 16px;
                    font-weight: 500;
                    color: #60646c;
                    white-space: nowrap;
                }

            </style>
            <!-- SVG спрайт иконок -->
            <svg style="position: absolute; width: 0; height: 0; overflow: hidden;" aria-hidden="true">
                <!-- Красная 3D-звезда -->
                <g id="icon-star-red">
                    <defs>
                        <radialGradient id="starGrad" cx="35%" cy="30%" r="70%">
                            <stop offset="0%" stop-color="#ff7b88"/>
                            <stop offset="45%" stop-color="#ea213a"/>
                            <stop offset="100%" stop-color="#b50c22"/>
                        </radialGradient>
                        <filter id="starShadow" x="-20%" y="-20%" width="140%" height="140%">
                            <feDropShadow dx="0" dy="2" stdDeviation="2" flood-color="#ea213a"
                                          flood-opacity="0.25"/>
                        </filter>
                    </defs>
                    <path filter="url(#starShadow)" fill="url(#starGrad)"
                          d="M16 2.5l4.17 8.45 9.33 1.36-6.75 6.58 1.59 9.29L16 23.79l-8.34 4.39 1.59-9.29-6.75-6.58 9.33-1.36z"/>
                </g>

                <!-- Серая звезда -->
                <g id="icon-star-gray">
                    <path fill="#e6e8ee"
                          d="M16 2.5l4.17 8.45 9.33 1.36-6.75 6.58 1.59 9.29L16 23.79l-8.34 4.39 1.59-9.29-6.75-6.58 9.33-1.36z"/>
                </g>

                <!-- Иконка бумажного самолётика -->
                <g id="icon-send">
                    <path fill="currentColor" d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                </g>
            </svg>

            <div class="container ">

                <!-- Левая колонка: Основной интерфейс -->
                <main class="card main-card">
                    <header class="header-banner">
                        <h1>Марафон звёзд</h1>
                        <p>Подарите 5 звёзд коллегам из других дирекций</p>
                    </header>

                    <!-- Блок: Мои звёзды для отправки -->

                    <?php
                    global $USER;

                    $starsCount = 0;
                    $maxStars = 5; // Всего звезд (как на картинке)

                    if ($USER->IsAuthorized()) {
                        $userId = (int)$USER->GetID();

                        // Получаем значение поля UF_MARATHON
                        $userData = \Bitrix\Main\UserTable::getRow([
                                'select' => ['ID', 'UF_MARATHON'],
                                'filter' => ['=ID' => $userId]
                        ]);

                        if (!empty($userData['UF_MARATHON'])) {
                            $starsCount = (int)$userData['UF_MARATHON'];
                        }
                        $user = UserTable::getList([
                                'select' => ['ID', 'UF_EXCLUDE'],
                                'filter' => ['=ID' => $userId]
                        ])->fetch();

                        if ($user && !empty($user['UF_EXCLUDE'])) {
                            // Значение также будет массивом
                            $user = UserTable::getList([
                                    'select' => ['ID', 'UF_EXCLUDE'],
                                    'filter' => ['=ID' => $userId]
                            ])->fetch();

                            if ($user && !empty($user['UF_EXCLUDE'])) {
                                // Значение также будет массивом
                                $arUsersExclude = $user['UF_EXCLUDE'];
                                // print_r($user['UF_EXCLUDE']);
                            }

                        }
                    }

                    // Ограничиваем диапазон от 0 до $maxStars
                    $starsCount = max(0, min($maxStars, $starsCount));
                    ?>

                    <!-- Блок: Мои звёзды для отправки -->
                    <?php
                    global $USER;

                    $starsCount = 0;
                    $maxStars = 5; // Всего звезд

                    if ($USER->IsAuthorized()) {
                        $userId = (int)$USER->GetID();

                        // Получаем значение поля UF_MARATHON
                        $userData = \Bitrix\Main\UserTable::getRow([
                                'select' => ['ID', 'UF_MARATHON'],
                                'filter' => ['=ID' => $userId]
                        ]);

                        if (!empty($userData['UF_MARATHON'])) {
                            $starsCount = (int)$userData['UF_MARATHON'];
                        }
                    }

                    // Ограничиваем диапазон от 0 до $maxStars
                    $starsCount = max(0, min($maxStars, $starsCount));
                    ?>
                    <!-- Блок: Мои звёзды для отправки -->
                    <section class="section-box">
                        <div class="user-stars-block">
                            <div class="user-stars-title">Мои звёзды для отправки</div>
                            <span class="remain-badge">Осталось: <b
                                        id="stars-left-text"><?= $starsCount ?> из 5</b></span>

                        </div>

                        <style>
                            .user-stars-block {
                                display: flex;
                                justify-content: space-between;
                                background: #ffffff;
                                border-radius: 8px;
                            }

                            .user-stars-title {
                                font-size: 14px;
                                font-weight: 700;
                                color: #333333;
                                margin-bottom: 12px;
                            }

                            .user-stars-list {
                                display: flex;
                                gap: 8px;
                                align-items: center;
                            }

                            .star-icon {
                                display: block;
                                width: 26px;
                                height: 26px;
                            }

                            .btn-send.disabled {
                                background-color: #6b6868;
                            }
                        </style>

                        <div class="stars-action-row">
                            <div class="user-stars-list">
                                <?php for ($i = 1; $i <= $maxStars; $i++): ?>
                                    <svg class="star-icon" viewBox="0 0 32 32">
                                        <use href="<?= ($i <= $starsCount) ? '#icon-star-red' : '#icon-star-gray' ?>"></use>
                                    </svg>
                                <?php endfor; ?>
                            </div>

                            <? $blButton = $starsCount == 0 ? 'disabled' : ''; ?>
                            <button <?= $blButton; ?> class="btn-send <?= $blButton; ?>" id="open-gift-btn">
                                <svg width="15" height="15" viewBox="0 0 24 24">
                                    <use href="#icon-send"></use>
                                </svg>
                                Подарить звезду
                            </button>
                        </div>

                        <div class="rules-bar">
                            <div class="rule-item rule-item1 ">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#717684"
                                     stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                    <line x1="9" y1="9" x2="15" y2="9"></line>
                                    <line x1="9" y1="13" x2="13" y2="13"></line>
                                </svg>
                                <span>Комментарий обязателен</span>
                            </div>
                            <div class="rule-divider"></div>
                            <div class="rule-item rule-item2">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#717684"
                                     stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <span>Нельзя подарить звезду сотруднику своей дирекции</span>
                            </div>
                        </div>
                    </section>

                    <!-- Блок: Получено -->

                    <?php


                    global $USER;

                    /*
                     * Настройки.
                     */
                    $iblockCode = 'stars_marathon';
                    $recipientPropertyCode = 'whome_send_user';

                    /*
                     * Если отправитель хранится в отдельном свойстве типа
                     * «Привязка к пользователю», укажите его код.
                     *
                     * Пустая строка — использовать CREATED_BY.
                     */
                    $senderPropertyCode = '';

                    /*
                     * Если комментарий хранится в отдельном свойстве,
                     * укажите его код.
                     *
                     * Пустая строка — использовать PREVIEW_TEXT / DETAIL_TEXT.
                     * Ожидается одиночное строковое свойство или свойство HTML/текст.
                     */
                    $commentPropertyCode = '';

                    if (!$USER->IsAuthorized()) {
                        echo '<p>Чтобы увидеть полученные звёзды, авторизуйтесь.</p>';
                        return;
                    }

                    if (!Loader::includeModule('iblock')) {
                        echo '<p>Не удалось подключить модуль инфоблоков.</p>';
                        return;
                    }

                    $currentUserId = (int)$USER->GetID();


                    /*
                     * Находим инфоблок по символьному коду.
                     */
                    $iblockResult = CIBlock::GetList(
                            [],
                            [
                                    'CODE' => $iblockCode,
                                    'ACTIVE' => 'Y',
                            ]
                    );

                    $iblock = $iblockResult->Fetch();

                    if (!$iblock) {
                        echo '<p>Инфоблок stars_marathon не найден.</p>';
                        return;
                    }

                    /*
                     * Получаем элементы, отправленные текущему пользователю.
                     *
                     * GetNextElement() + GetProperties() позволяет не размножать
                     * элементы в результате из-за множественных свойств.
                     */
                    $elementsResult = CIBlockElement::GetList(
                            [
                                    'DATE_CREATE' => 'DESC',
                                    'ID' => 'DESC',
                            ],
                            [
                                    'IBLOCK_ID' => (int)$iblock['ID'],
                                    'ACTIVE' => 'Y',
                                    '=PROPERTY_' . $recipientPropertyCode => $currentUserId,
                                    'CHECK_PERMISSIONS' => 'Y',
                                    'MIN_PERMISSION' => 'R',
                            ],
                            false,
                            false,
                            [
                                    'ID',
                                    'IBLOCK_ID',
                                    'CREATED_BY',
                                    'DATE_CREATE',
                                    'PREVIEW_TEXT',
                                    'DETAIL_TEXT',
                            ]
                    );

                    $comments = [];
                    $authorIds = [];

                    while ($elementObject = $elementsResult->GetNextElement()) {
                        // false — получаем исходные значения, экранируем при выводе.
                        $element = $elementObject->GetFields(false, false);

                        $properties = [];

                        if ($senderPropertyCode !== '' || $commentPropertyCode !== '') {
                            $properties = $elementObject->GetProperties();
                        }



                        $authorId = (int)$element['CREATED_BY'];

                        if ($senderPropertyCode !== '') {
                            $senderCode = strtoupper($senderPropertyCode);
                            $authorId = (int)($properties[$senderCode]['VALUE'] ?? 0);
                        }

                        if ($commentPropertyCode !== '') {
                            $commentCode = strtoupper($commentPropertyCode);
                            $commentValue = $properties[$commentCode]['VALUE'] ?? '';

                            // Поддержка свойства типа HTML/текст.
                            $text = is_array($commentValue)
                                    ? (string)($commentValue['TEXT'] ?? '')
                                    : (string)$commentValue;
                        } else {
                            $previewText = trim((string)$element['PREVIEW_TEXT']);

                            $text = $previewText !== ''
                                    ? $previewText
                                    : (string)$element['DETAIL_TEXT'];
                        }

                        $comments[] = [
                                'ID' => (int)$element['ID'],
                                'AUTHOR_ID' => $authorId,
                                'TEXT' => $text,
                                'DATE_CREATE' => (string)$element['DATE_CREATE'],
                        ];

                        if ($authorId > 0) {
                            $authorIds[$authorId] = $authorId;
                        }
                    }

                    /*
                     * Получаем всех авторов одним запросом.
                     */
                    $authors = [];

                    if ($authorIds) {
                        $by = 'id';
                        $order = 'asc';

                        $usersResult = CUser::GetList(
                                $by,
                                $order,
                                [
                                        'ID' => implode('|', array_values($authorIds)),
                                ],
                                [
                                        'FIELDS' => [
                                                'ID',
                                                'NAME',
                                                'LAST_NAME',
                                                'LOGIN',
                                        ],
                                ]
                        );

                        while ($author = $usersResult->Fetch()) {
                            $authors[(int)$author['ID']] = $author;
                        }
                    }

                    $starsCount = count($comments);

                    /*
                     * Склонение: 1 звезда, 2 звезды, 5 звёзд, 21 звезда.
                     */
                    $pluralizeStars = static function (int $number): string {
                        $lastTwo = $number % 100;
                        $lastOne = $number % 10;

                        if ($lastTwo >= 11 && $lastTwo <= 14) {
                            return 'звёзд';
                        }

                        if ($lastOne === 1) {
                            return 'звезда';
                        }

                        if ($lastOne >= 2 && $lastOne <= 4) {
                            return 'звезды';
                        }

                        return 'звёзд';
                    };

                    $escape = static function ($value): string {
                        return htmlspecialchars(
                                (string)$value,
                                ENT_QUOTES | ENT_SUBSTITUTE,
                                'UTF-8'
                        );
                    };

                    $getInitials = static function (array $author): string {
                        $initials = '';

                        foreach (['NAME', 'LAST_NAME'] as $field) {
                            $part = trim((string)($author[$field] ?? ''));

                            if ($part !== '') {
                                $initials .= mb_substr($part, 0, 1, 'UTF-8');
                            }
                        }

                        if ($initials === '') {
                            $initials = mb_substr(
                                    (string)($author['LOGIN'] ?? '?'),
                                    0,
                                    1,
                                    'UTF-8'
                            );
                        }

                        return mb_strtoupper($initials, 'UTF-8');
                    };

                    $formatCommentDate = static function (string $value): string {
                        $timestamp = MakeTimeStamp($value);

                        if (!$timestamp) {
                            return '';
                        }

                        $months = [
                                1 => 'января',
                                2 => 'февраля',
                                3 => 'марта',
                                4 => 'апреля',
                                5 => 'мая',
                                6 => 'июня',
                                7 => 'июля',
                                8 => 'августа',
                                9 => 'сентября',
                                10 => 'октября',
                                11 => 'ноября',
                                12 => 'декабря',
                        ];

                        return date('d', $timestamp)
                                . ' ' . $months[(int)date('n', $timestamp)]
                                . ' ' . date('Y', $timestamp);
                    };

                    /*
                     * Одинаковая SVG-звезда для счётчика и комментариев.
                     * Внешние изображения и SVG-спрайты не нужны.
                     */
                    $starSvg = '
    <svg
        class="sm-star"
        viewBox="0 0 32 32"
        aria-hidden="true"
        focusable="false"
    >
        <path d="
            M16 2
            L20.3 11.1
            L30.3 12.4
            L23 19.4
            L24.8 29.3
            L16 24.5
            L7.2 29.3
            L9 19.4
            L1.7 12.4
            L11.7 11.1
            Z
        " />
    </svg>
';

                    $starsLabel = $starsCount . ' ' . $pluralizeStars($starsCount);
                    ?>

                    <style>
                        .stars-marathon,
                        .stars-marathon * {
                            box-sizing: border-box;
                        }

                        .stars-marathon {
                            width: 100%;
                            /*
                                            padding: 36px 32px 20px;*/
                            background: #fff;
                            border-radius: 0 0 24px 24px;
                            color: #333;
                            font-family:"IBM Plex Sans", "Helvetica Neue", Helvetica, Arial, sans-serif ;
                        }

                        .stars-marathon .sm-received {
                            /*padding: 0 24px;*/
                        }

                        .stars-marathon .sm-title {
                            margin: 0 0 26px;
                            font-size: 20px;
                            font-weight: 600;
                            line-height: 1.3;
                        }

                        .stars-marathon .sm-stars-row {
                            display: flex;
                            align-items: center;
                            justify-content: space-between;
                            gap: 24px;
                        }

                        .stars-marathon .sm-stars {
                            display: flex;
                            flex: 1 1 auto;
                            flex-wrap: wrap;
                            align-items: center;
                            gap: 10px;
                            min-width: 0;
                        }

                        .stars-marathon .sm-star {
                            display: block;
                            flex-shrink: 0;
                            width: 30px;
                            height: 30px;
                            fill: #dc3541;
                        }

                        .stars-marathon .sm-stars-count {
                            flex: 0 0 auto;
                            color: #666;
                            font-size: 15px;
                            line-height: 1.4;
                            white-space: nowrap;
                        }

                        .stars-marathon .sm-comments {
                            margin-top: 48px;
                        }

                        .stars-marathon .sm-comments-title {
                            margin: 0 0 14px;
                            font-size: 16px;
                            font-weight: 600;
                            line-height: 1.4;
                        }

                        .stars-marathon .sm-comment {
                            display: flex;
                            align-items: flex-start;
                            gap: 14px;
                            padding: 16px 0 26px;
                        }

                        .stars-marathon .sm-comment + .sm-comment {
                            border-top: 1px solid #f0f0f0;
                        }

                        .stars-marathon .sm-avatar {
                            display: flex;
                            flex: 0 0 42px;
                            align-items: center;
                            justify-content: center;
                            width: 42px;
                            height: 42px;
                            border-radius: 50%;
                            background: #eeeff4;
                            color: #777c87;
                            font-size: 14px;
                            font-weight: 600;
                        }

                        .stars-marathon .sm-comment-content {
                            flex: 1 1 auto;
                            min-width: 0;
                        }

                        .stars-marathon .sm-comment-top {
                            display: flex;
                            align-items: center;
                            justify-content: space-between;
                            gap: 16px;
                            min-height: 20px;
                        }

                        .stars-marathon .sm-user-row {
                            display: flex;
                            align-items: center;
                            gap: 8px;
                            min-width: 0;
                        }

                        .stars-marathon .sm-user-name {
                            color: #707070;
                            font-size: 14px;
                            font-weight: 600;
                            overflow-wrap: anywhere;
                        }

                        .stars-marathon .sm-user-arrow {
                            flex-shrink: 0;
                            width: 0;
                            height: 0;
                            border-top: 4px solid #aaa;
                            border-right: 3px solid transparent;
                            border-left: 3px solid transparent;
                        }

                        .stars-marathon .sm-user-row .sm-star {
                            width: 14px;
                            height: 14px;
                        }

                        .stars-marathon .sm-comment-meta {
                            display: flex;
                            flex-shrink: 0;
                            align-items: center;
                            gap: 18px;
                            color: #888;
                        }

                        .stars-marathon .sm-comment-date {
                            font-size: 12px;
                            white-space: nowrap;
                        }

                        .stars-marathon .sm-dots {
                            color: #a2a2a2;
                            font-size: 16px;
                            letter-spacing: 1px;
                            line-height: 1;
                        }

                        .stars-marathon .sm-comment-text {
                            margin: 12px 0 0;
                            color: #555;
                            font-size: 13px;
                            line-height: 1.6;
                            overflow-wrap: anywhere;
                        }

                        .stars-marathon .sm-empty {
                            margin: 0;
                            padding: 12px 0 20px;
                            color: #888;
                            font-size: 14px;
                            line-height: 1.5;
                        }

                        @media (max-width: 600px) {
                            .stars-marathon {
                                padding: 24px 18px 12px;
                                border-radius: 16px;
                            }

                            .stars-marathon .sm-received {
                                padding: 0;
                            }

                            .stars-marathon .sm-stars-row {
                                gap: 14px;
                            }

                            .stars-marathon .sm-stars {
                                gap: 6px;
                            }

                            .stars-marathon .sm-stars > .sm-star {
                                width: 25px;
                                height: 25px;
                            }

                            .stars-marathon .sm-comments {
                                margin-top: 32px;
                            }

                            .stars-marathon .sm-comment {
                                gap: 10px;
                                padding-bottom: 20px;
                            }

                            .stars-marathon .sm-comment-top {
                                align-items: flex-start;
                                flex-direction: column;
                                gap: 7px;
                            }

                            .stars-marathon .sm-comment-meta {
                                justify-content: space-between;
                                width: 100%;
                            }

                            .stars-marathon .sm-comment-text {
                                margin-top: 9px;
                            }
                        }
                    </style>

                    <div class="stars-marathon">
                        <section class="sm-received" aria-label="Полученные звёзды">
                            <h2 class="sm-title">Получено</h2>

                            <div class="sm-stars-row">
                                <div class="sm-stars" aria-hidden="true">
                                    <?php for ($i = 0; $i < $starsCount; $i++): ?>
                                        <?= $starSvg ?>
                                    <?php endfor; ?>
                                </div>

                                <span class="sm-stars-count">
                <?= $escape($starsLabel) ?>
            </span>
                            </div>
                        </section>

                        <section class="sm-comments" aria-label="Комментарии">
                            <h2 class="sm-comments-title">Комментарии</h2>

                            <div class="sm-comments-list">
                                <?php

                                if (!$comments): ?>
                                    <p class="sm-empty">
                                        Пока никто не отправил вам звёзды.
                                    </p>
                                <?php else: ?>
                                    <?php foreach ($comments as $comment): ?>
                                        <?php
                                        $author = $authors[$comment['AUTHOR_ID']] ?? [];

                                        $authorName = trim(
                                                (string)($author['NAME'] ?? '')
                                                . ' '
                                                . (string)($author['LAST_NAME'] ?? '')
                                        );

                                        if ($authorName === '') {
                                            $authorName = (string)(
                                                    $author['LOGIN'] ?? 'Пользователь'
                                            );
                                        }

                                        $initials = $getInitials($author);
                                        $dateLabel = $formatCommentDate(
                                                $comment['DATE_CREATE']
                                        );
                                        ?>

                                        <article
                                                class="sm-comment"
                                                data-element-id="<?= (int)$comment['ID'] ?>"
                                        >
                                            <div class="sm-avatar" aria-hidden="true">
                                                <?= $escape($initials) ?>
                                            </div>

                                            <div class="sm-comment-content">
                                                <div class="sm-comment-top">
                                                    <div class="sm-user-row">
                                    <a  href="/company/personal/user/<?=$comment['AUTHOR_ID'] ?>/" class="sm-user-name" target="_blank">
                                        <?= $escape($authorName) ?>
                                    </a>

                                                        <span
                                                                class="sm-user-arrow"
                                                                aria-hidden="true"
                                                        ></span>

                                                        <?= $starSvg ?>
                                                    </div>

                                                    <div class="sm-comment-meta">
                                    <span class="sm-comment-date">
                                        <?= $escape($dateLabel) ?>
                                    </span>

                                                        <span
                                                                class="sm-dots"
                                                                aria-hidden="true"
                                                        >•••</span>
                                                    </div>
                                                </div>

                                                <?php if (trim($comment['TEXT']) !== ''): ?>
                                                    <p class="sm-comment-text">
                                                        <?//= nl2br($escape($comment['TEXT'])) ?>
                                                        <?= $comment['TEXT']?>
                                                    </p>
                                                <?php endif; ?>
                                            </div>
                                        </article>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </section>
                    </div>
                </main>

            </div>
            <!-- Оверлей модального окна (изначально скрыт) -->
            <div class="modal-overlay" id="gift-modal" aria-hidden="true">
                <aside class="card modal-card" role="dialog" aria-modal="true" aria-labelledby="modal-title">
                    <div class="modal-header">
                        <h2 class="modal-title" id="modal-title">Подарить звезду</h2>
                        <button class="close-btn" id="btn-close-modal" aria-label="Закрыть">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>

                    </div>
                    <div style="color: #FF1E2D; font-weight: bold; font-size: 14px; margin-bottom: 10px;"
                         id="error-message"
                         class="selected-employees_information"></div>

                    <div class="form-group">
                        <label class="form-label" for="user-search">Кому</label>

                        <style>
                            .selected-employees__row {
                                align-items: flex-start;
                            }

                            .selected-employees__info {
                                flex: 1;
                            }

                            .selected-employees__id {
                                margin-top: 3px;
                                font-size: 12px;
                                color: #888;
                            }

                            .selected-employees__comment {
                                margin-top: 12px;
                            }

                            .selected-employees__comment-label {
                                display: block;
                                margin-bottom: 5px;
                                font-size: 13px;
                                font-weight: 600;
                                color: #333;
                            }

                            .selected-employees__textarea {
                                display: block;
                                box-sizing: border-box;
                                width: 100%;
                                min-height: 80px;
                                padding: 8px 10px;
                                border: 1px solid #c9cfd6;
                                border-radius: 4px;
                                font: inherit;
                                resize: vertical;
                            }

                            .selected-employees__textarea:focus {
                                border-color: #2fc6f6;
                                outline: 2px solid rgba(47, 198, 246, 0.2);
                            }

                            .selected-employees {
                                display: flex;
                                flex-direction: column;
                                gap: 8px;
                                margin-top: 12px;
                            }

                            .selected-employees__row {
                                display: flex;
                                align-items: center;
                                justify-content: space-between;
                                gap: 16px;
                                padding: 10px 12px;
                                border: 1px solid #dfe3e6;
                                border-radius: 6px;
                                background: #fff;
                            }

                            .selected-employees__info {
                                min-width: 0;
                                overflow-wrap: anywhere;
                            }

                            .selected-employees__name {
                                font-weight: 600;
                                color: #333;
                            }

                            .selected-employees__department {
                                margin-top: 3px;
                                font-size: 13px;
                                color: #777;
                            }

                            .selected-employees__remove {
                                flex-shrink: 0;
                                padding: 5px 8px;
                                border: 0;
                                border-radius: 4px;
                                background: transparent;
                                color: #c0392b;
                                cursor: pointer;
                            }

                            .selected-employees__remove:hover {
                                background: #fff0ef;
                            }

                            .selected-employees__remove:focus-visible {
                                outline: 2px solid #c0392b;
                                outline-offset: 2px;
                            }

                            .selected-employees__empty {
                                font-size: 13px;
                                color: #888;
                            }
                        </style>
                        <?php
                        global $USER;

                        if ($USER->IsAuthorized()) {
                            $userId = $USER->GetID();

                            // Получаем пользователя
                            $rsUser = CUser::GetByID($userId);
                            $arUser = $rsUser->Fetch();

                            // UF_DEPARTMENT — массив ID подразделений

                            $arDepartments = $arUser['UF_DEPARTMENT'];

                            $blGenDir = $arDepartments == 1 ? 1 : 0;

                            if (!empty($arDepartments) && is_array($arDepartments)) {
                                foreach ($arDepartments as $departmentId) {
                                    // ID подразделения
                                    $departmentId = (int)$departmentId;

                                    // Получаем название подразделения
                                    $departmentName = '';

                                    // В Битрикс24 оргструктура обычно хранится в инфоблоке.
                                    // Если у вас известен ID инфоблока подразделений, укажите его:
                                    $iblockId = 3; // замените на реальный ID инфоблока подразделений


                                    Loader::includeModule('iblock');

                                    $iblockId = IblockTable::getList([
                                            'filter' => ['=CODE' => 'departments'],
                                            'select' => ['ID']
                                    ])->fetch()['ID'] ?? null;


                                    if (\Bitrix\Main\Loader::includeModule('iblock')) {
                                        $rsSection = \CIBlockSection::GetList(
                                                [],
                                                ['ID' => $departmentId, 'IBLOCK_ID' => $iblockId],
                                                false,
                                                ['ID', 'NAME']
                                        );

                                        if ($arSection = $rsSection->Fetch()) {
                                            //echo $departmentName = $arSection['NAME'];
                                            $departmentID = $arSection['ID'];
                                        }
                                    }

                                }
                            }
                        }
                        if (!$USER->IsAuthorized()) {
                            return;
                        }

                        if (
                                !Loader::includeModule('intranet')
                                || !Loader::includeModule('iblock')
                        ) {
                            throw new RuntimeException('Необходимы модули intranet и iblock');
                        }

                        Extension::load('ui.entity-selector');

                        //$userId = (int)$USER->GetID();

                        $arUser = CUser::GetByID($userId)->Fetch();
                        if (!$arUser) {
                            return;
                        }
                        $arDepartments = (array)($arUser['UF_DEPARTMENT'] ?? []);

                        $arDepartments = array_filter(array_map('intval', $arDepartments));
                        if (!$arDepartments) {
                            echo 'Пользователь не привязан к подразделениям';
                            return;
                        }

                        $iblockId = (int)(IblockTable::getList([
                                'filter' => ['=CODE' => 'departments'],
                                'select' => ['ID'],
                        ])->fetch()['ID'] ?? 0);

                        if (!$iblockId) {
                            echo 'Инфоблок подразделений не найден';
                            return;
                        }

                        function getSectionChain(int $sectionId, int $iblockId): array
                        {
                            $res = CIBlockSection::GetNavChain($iblockId, $sectionId, ['ID', 'NAME', 'DEPTH_LEVEL']);
                            $chain = [];
                            while ($row = $res->Fetch()) {
                                $chain[] = [
                                        'ID' => (int)$row['ID'],
                                        'NAME' => (string)$row['NAME'],
                                        'DEPTH_LEVEL' => (int)$row['DEPTH_LEVEL'],
                                ];
                            }
                            return $chain;
                        }

                        function findInChain(array $chain, array $keywords): ?array
                        {
                            foreach ($chain as $node) {
                                foreach ($keywords as $kw) {
                                    if (mb_stripos($node['NAME'], $kw) !== false) {
                                        return $node;
                                    }
                                }
                            }
                            return null;
                        }

                        /**
                         * Получить ID всех вложенных разделов (на всех уровнях) для указанного раздела
                         * @return int[]
                         */
                        function getNestedSectionIds(int $rootSectionId, int $iblockId): array
                        {
                            $ids = [];

                            $rs = CIBlockSection::GetList(
                                    ['LEFT_MARGIN' => 'ASC'],
                                    [
                                            'IBLOCK_ID' => $iblockId,
                                            'SECTION_ID' => $rootSectionId,
                                            'ACTIVE' => 'Y',
                                            'GLOBAL_ACTIVE' => 'Y',
                                    ],
                                    false,
                                    ['ID']
                            );
                            while ($row = $rs->Fetch()) {
                                $ids[] = (int)$row['ID'];
                            }

                            // Если структура может быть многоуровневой и GET_LIST с SECTION_ID
                            // возвращает только прямых потомков — обойдём рекурсивно.
                            // Проверим "глубину" через LEFT_MARGIN / RIGHT_MARGIN, чтобы взять всех.
                            $rootRes = CIBlockSection::GetList(
                                    [],
                                    ['IBLOCK_ID' => $iblockId, 'ID' => $rootSectionId],
                                    false,
                                    ['ID', 'LEFT_MARGIN', 'RIGHT_MARGIN']
                            )->Fetch();

                            if ($rootRes && $rootRes['LEFT_MARGIN'] !== null && $rootRes['RIGHT_MARGIN'] !== null) {
                                $ids = [];
                                $rs = CIBlockSection::GetList(
                                        ['LEFT_MARGIN' => 'ASC'],
                                        [
                                                'IBLOCK_ID' => $iblockId,
                                                '>LEFT_MARGIN' => (int)$rootRes['LEFT_MARGIN'],
                                                '<RIGHT_MARGIN' => (int)$rootRes['RIGHT_MARGIN'],
                                                'ACTIVE' => 'Y',
                                                'GLOBAL_ACTIVE' => 'Y',
                                        ],
                                        false,
                                        ['ID']
                                );
                                while ($row = $rs->Fetch()) {
                                    $ids[] = (int)$row['ID'];
                                }
                            }

                            return $ids;
                        }

                        $directorateKeywords = ['Сметно-договорное управление', 'Управление сопровождения контрактов', 'Правовое управление', 'Управление документационного обеспечения и контроля', 'Управление закупок', 'Административное управление', 'Генеральный директор', 'Дирекция', 'Комитет', 'Советник', 'Заместитель директора', 'Директор дивизиона', 'заместитель генерального директора'];
                        $managementKeywords = ['Управление', 'Группа'];
                        $foundDirectorate = null;
                        $foundManagement = null;
                        $foundGroup = null;

                        foreach ($arDepartments as $departmentId) {
                            $chain = getSectionChain($departmentId, $iblockId);
                            if (!$chain) {
                                continue;
                            }

                            for ($i = count($chain) - 1; $i >= 0; $i--) {
                                $node = $chain[$i];
                                $name = $node['NAME'];

                                if (!$foundGroup && mb_stripos($name, 'Группа') !== false) {
                                    $foundGroup = $node;
                                }
                                if (!$foundManagement && findInChain([$node], $managementKeywords)) {
                                    $foundManagement = $node;
                                }
                                if (!$foundDirectorate && findInChain([$node], $directorateKeywords)) {
                                    $foundDirectorate = $node;
                                }
                            }
                        }

                        // Определяем "главный" раздел: Дирекция > Управление > Группа
                        $rootSection = $foundDirectorate ?: $foundManagement ?: $foundGroup;

                        if (!$rootSection) {
                            echo 'Не удалось определить раздел пользователя';
                            return;
                        }

                        $rootSectionId = (int)$rootSection['ID'];

                        // Получаем ID всех вложенных разделов (включая сам корневой)
                        $nestedIds = getNestedSectionIds($rootSectionId, $iblockId);
                        $allSectionIds = array_merge([$rootSectionId], $nestedIds);

                        // Для удобства — уникализируем
                        $allSectionIds = array_values(array_unique($allSectionIds));

                        // Подключаем модуль инфоблоков
                        \Bitrix\Main\Loader::includeModule('iblock');

                        // 1. Получаем ID инфоблока по его символьному коду 'departments'
                        $iblockCode = 'departments';
                        $resIblock = CIBlock::GetList([], ['=CODE' => $iblockCode, 'CHECK_PERMISSIONS' => 'N']);
                        $arIblock = $resIblock->Fetch();

                        if (!$arIblock) {
                            die("Инфоблок с кодом '{$iblockCode}' не найден.");
                        }

                        $iblockId = $arIblock['ID'];

                        // 2. Получаем все ID разделов этого инфоблока
                        $allSectionIds1 = [];
                        $rsSections = CIBlockSection::GetList(
                                ['SORT' => 'ASC'],
                                ['IBLOCK_ID' => $iblockId],
                                false,
                                ['ID']
                        );

                        while ($arSection = $rsSections->Fetch()) {
                            $allSectionIds1[] = (int)$arSection['ID'];
                        }

                        // 3. Массив ID, которые нужно исключить (ваш определенный массив)
                        //$excludeIds = [5, 10, 15]; // Пример: замените на ваши реальные ID

                        // 4. Вычитаем один массив из другого
                        // array_diff вернет все значения из $allSectionIds1, которых нет в $excludeIds
                        $resultIds = array_diff($allSectionIds1, $allSectionIds);
                        // Вывод результата (для отладки)
                        // Теперь в $resultIds лежит массив с ID разделов, которые остались после исключения.
                        if ($arDepartments[0] == 1) {
                            $allowedDepartmentIds = array_diff($allSectionIds1, [$arDepartments[0]]);
                        } else {
                            $allowedDepartmentIds = $resultIds;
                        }

                        // На всякий случай гарантируем 299 в разрешённых
                        if (!in_array(299, $allowedDepartmentIds, true)) {
                            $allowedDepartmentIds[] = 299;
                        }

                        // Если нужен именно массив без корневого:
                        // $nestedOnly = array_values(array_diff($allSectionIds, [$rootSectionId]));


                        // Подразделения, сотрудников которых разрешено выбирать.
                        // Задавайте список на сервере, а не берите его без проверки из запроса.


                        $allowedDepartmentIds = array_values(array_unique(array_filter(
                                array_map('intval', $allowedDepartmentIds),
                                static function ($id) {
                                    return $id > 0;
                                }
                        )));

                        $users = [];
                        $departmentIds = [];

                        // При пустом списке подразделений никого не загружаем.
                        if ($allowedDepartmentIds) {
                            $by = 'last_name';
                            $order = 'asc';

                            $result = CUser::GetList(
                                    $by,
                                    $order,
                                    [
                                            'ACTIVE' => 'Y',
                                            'UF_DEPARTMENT' => $allowedDepartmentIds,
                                    ],
                                    [
                                            'FIELDS' => [
                                                    'ID',
                                                    'NAME',
                                                    'LAST_NAME',
                                                    'SECOND_NAME',
                                                    'LOGIN',
                                            ],
                                            'SELECT' => [
                                                    'UF_DEPARTMENT',
                                            ],
                                    ]
                            );

                            while ($user = $result->Fetch()) {
                                $user['UF_DEPARTMENT'] = array_values(array_filter(
                                        array_map('intval', (array)$user['UF_DEPARTMENT']),
                                        static function ($id) {
                                            return $id > 0;
                                        }
                                ));

                                foreach ($user['UF_DEPARTMENT'] as $departmentId) {
                                    $departmentIds[$departmentId] = $departmentId;
                                }

                                $users[(int)$user['ID']] = $user;
                            }
                        }

                        // Получаем названия подразделений одним запросом.
                        $departmentNames = [];

                        $structureIblockId = (int)Option::get(
                                'intranet',
                                'iblock_structure',
                                '0'
                        );

                        if ($structureIblockId > 0 && $departmentIds) {
                            $result = CIBlockSection::GetList(
                                    ['NAME' => 'ASC'],
                                    [
                                            'IBLOCK_ID' => $structureIblockId,
                                            'ID' => array_values($departmentIds),
                                    ],
                                    false,
                                    ['ID', 'NAME']
                            );

                            while ($department = $result->Fetch()) {
                                $departmentNames[(int)$department['ID']] = $department['NAME'];
                            }
                        }

                        // Формируем элементы селектора.
                        $items = [];

                        foreach ($users as $user) {
                            $fullName = trim(implode(' ', array_filter(
                                    [
                                            $user['LAST_NAME'],
                                            $user['NAME'],
                                            $user['SECOND_NAME'],
                                    ],
                                    static function ($value) {
                                        return trim((string)$value) !== '';
                                    }
                            )));

                            if ($fullName === '') {
                                $fullName = $user['LOGIN'];
                            }

                            $names = [];

                            foreach ($user['UF_DEPARTMENT'] as $departmentId) {
                                if (isset($departmentNames[$departmentId])) {
                                    $names[] = $departmentNames[$departmentId];
                                }
                            }

                            $items[] = [
                                    'id' => (int)$user['ID'],

                                // Своя сущность, без стандартного провайдера всех пользователей.
                                    'entityId' => 'department-employee',

                                    'title' => $fullName,
                                    'subtitle' => implode(', ', array_unique($names)),

                                    'tabs' => ['employees'],

                                    'customData' => [
                                            'departmentIds' => $user['UF_DEPARTMENT'],
                                    ],
                            ];
                        }

                        $itemsJson = json_encode(
                                $items,
                                JSON_UNESCAPED_UNICODE
                                | JSON_HEX_TAG
                                | JSON_HEX_AMP
                                | JSON_HEX_APOS
                                | JSON_HEX_QUOT
                                | JSON_THROW_ON_ERROR
                        );
                        ?>
                        <div id="employees-selector"></div>
                        <div
                                id="selected-employees"
                                class="selected-employees"
                                aria-live="polite"
                        >
                        </div>


                        <div class="search-input-wrapper" style="display: none">
                            <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            <input type="text" class="input-field" id="user-search"
                                   placeholder="Начните вводить имя, фамилию или дирекцию">
                        </div>

                        <div class="user-dropdown" id="user-list" style="display: none">
                            <div class="user-option selected" data-name="Елена Кузнецова"
                                 data-dept="Дирекция по продукту"
                                 data-initials="ЕК">
                                <div class="user-option-avatar">ЕК</div>
                                <div class="user-option-info">
                                    <div class="user-option-name">Елена Кузнецова</div>
                                    <div class="user-option-dept">Дирекция по продукту</div>
                                </div>
                            </div>
                            <div class="user-option" data-name="Алексей Воронов" data-dept="Дирекция по технологиям"
                                 data-initials="АВ">
                                <div class="user-option-avatar">АВ</div>
                                <div class="user-option-info">
                                    <div class="user-option-name">Алексей Воронов</div>
                                    <div class="user-option-dept">Дирекция по технологиям</div>
                                </div>
                            </div>
                            <div class="user-option" data-name="Ольга Фёдорова" data-dept="Дирекция по маркетингу"
                                 data-initials="ОФ">
                                <div class="user-option-avatar">ОФ</div>
                                <div class="user-option-info">
                                    <div class="user-option-name">Ольга Фёдорова</div>
                                    <div class="user-option-dept">Дирекция по маркетингу</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="display: none">
                        <label class="form-label" for="comment-text-input">Комментарий <span
                                    class="req">*</span></label>
                        <div class="textarea-wrapper">
                <textarea id="comment-text-input" class="textarea-field" maxlength="500"
                          placeholder="Напишите, за что вы благодарите коллегу..."></textarea>
                        </div>
                        <div class="char-count"><span id="current-chars">0</span> / 500</div>
                    </div>

                    <div class="alert-banner">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span>Доступны только коллеги из других дирекций</span>
                    </div>

                    <div class="modal-actions">
                        <button class="btn-cancel" id="btn-cancel">Отмена</button>
                        <button class="btn-submit" id="btn-submit">
                            <svg width="15" height="15" viewBox="0 0 24 24">
                                <use href="#icon-send"></use>
                            </svg>
                            Отправить звезду
                        </button>
                    </div>
                </aside>
            </div>
            <script>
                BX.ready(function () { // МАРАФОН ЗВЕЗД
                    const employeeItems = <?= $itemsJson ?>;
                    const selectedContainer = document.getElementById('selected-employees');

                    $('body').on('click', '.ui-selector-item-box', function (e) {

                        setTimeout(sel, 1000)

                    });

                    function sel() {
                        const _thisId = $('.selected-employees__row').data('user-id');
                        console.log(_thisId);
                    }

                    // Справочник: ID сотрудника → его данные.
                    const employeesById = new Map(
                        employeeItems.map(function (item) {
                            return [String(item.id), item];
                        })
                    );

                    var $arExcludedUsers = []; //Ids

                    //console.log(arrAr);
                    const selector = new BX.UI.EntitySelector.TagSelector({
                        id: 'employees-by-department',
                        multiple: false,

                        events: {
                            onAfterTagAdd: function () {
                                renderSelectedEmployees();
                            },
                            // Событие срабатывает перед добавлением тега (выбором из списка)
                            onBeforeTagAdd: function (event) {

                                const selector = event.getTarget();
                                const {tag} = event.getData();

                                const userId = Number(tag.getId());
                                const userName = tag.getTitle();

                                // Блокируем повторный запрос, пока идёт проверка
                                if (selector.isProcessing) {
                                    return false;
                                }
                                selector.isProcessing = true;

                                $.ajax({
                                    url: '/local/ajax/marathon/ajax.php', // ваш URL обработчика
                                    type: 'POST',
                                    data: {
                                        action: 'checkExclude',
                                        userId: userId
                                    },
                                    dataType: 'json',
                                    success: function (response) {
                                        selector.isProcessing = false;
                                        if (response.success && response.isExcluded) {
                                            alert(userName + ' — вы уже отправили этому сотруднику одну звезду, выберите другого');
                                            // Отменяем добавление тега
                                            event.preventDefault();
                                            setTimeout(function () {
                                                $('#selected-employees').find('button.selected-employees__remove').each(function () {
                                                    $(this).click();
                                                    $('.selected-employees_information').text(userName + ' вы уже отправили звезду, выберите другого');
                                                });
                                            }, 100);
                                            return false;
                                        }
                                        // Если всё ок — тег добавится штатно
                                    },
                                    error: function () {
                                        selector.isProcessing = false;
                                        alert('Ошибка проверки, попробуйте ещё раз');
                                        // Решать вам: разрешать ли добавлять тег при ошибке. Здесь — не отменяем
                                    }
                                });

                                /*$('.selected-employees_information').text('');

                                // Получаем сам виджет (селектор)
                                const selector = event.getTarget();

                                // Получаем данные выбранного элемента (тега)
                                const {tag} = event.getData();

                                // Теперь у вас есть доступ к информации о сотруднике
                                // Например, можно получить ID и имя:
                                const userId = tag.getId();       // ID пользователя
                                const userName = tag.getTitle();  // Имя / ФИО


                                const arrAr = <?//= json_encode($arUsersExclude) ?>;

                                    if (Array.isArray(arrAr) && arrAr.length > 0) {
                                        if (arrAr.some(x => Number(x) === userId)) {
                                            alert(userName + ' - вы уже отправили этому сотруднику одну звезду, выберите другого');

                                            setTimeout(function () {
                                                $('#selected-employees').find('button.selected-employees__remove').each(function () {
                                                    $(this).click();
                                                    $('.selected-employees_information').text(userName + ' вы уже отправили звезду, выберите другого');
                                                });
                                            }, 100);
                                        }
                                    }*/


                                // Здесь можно выполнить свои действия, например, отправить AJAX запрос
                                // или обновить другое поле на странице.
                            },

                            onAfterTagRemove: function () {
                                renderSelectedEmployees();
                            }
                        },

                        dialogOptions: {
                            recentTabOptions: {
                                visible: false
                            },

                            context: null,
                            direction: 'bottom',

                            enableSearch: true,
                            dynamicLoad: false,
                            dynamicSearch: false,

                            entities: [
                                {
                                    id: 'department-employee',
                                    dynamicLoad: false,
                                    dynamicSearch: false,
                                    options: {
                                        id: 'user',
                                        selectMode: 'usersAndDepartments'
                                    }

                                }
                            ],

                            tabs: [
                                {
                                    id: 'employees',
                                    title: 'Сотрудники'
                                }
                            ],

                            items: employeeItems
                        }
                    });

                    /* const dialog = selector.getDialog();

                     // Устанавливаем новые опции для сущности user
                     dialog.getEntity('user').setOptions({
                         excludeUsers: [590]
                     });

             // Сбрасываем кэш загруженных элементов и перезагружаем вкладки
                     dialog.clearCache();*/

                    // ID сотрудника → введённый комментарий.
// Сохраняет текст при перерисовке списка.
                    const employeeComments = new Map();

                    function renderSelectedEmployees() {
                        selectedContainer.textContent = '';

                        const tags = selector.getTags();

                        if (tags.length === 0) {
                            const empty = document.createElement('div');

                            empty.className = 'selected-employees__empty';
                            empty.textContent = 'Сотрудники не выбраны';

                            selectedContainer.appendChild(empty);
                            return;
                        }

                        const fragment = document.createDocumentFragment();


                        tags.forEach(function (tag) {
                            const userId = String(tag.getId());
                            const employee = employeesById.get(userId);

                            const name = employee
                                ? employee.title
                                : tag.getTitle();

                            const department = employee && employee.subtitle
                                ? employee.subtitle
                                : 'Подразделение не указано';

                            // Строка, привязанная к ID сотрудника.
                            const row = document.createElement('div');

                            row.className = 'selected-employees__row';
                            row.id = 'selected-employee-' + userId;
                            row.dataset.userId = userId;

                            const info = document.createElement('div');
                            info.className = 'selected-employees__info';

                            const nameElement = document.createElement('div');
                            nameElement.className = 'selected-employees__name';
                            nameElement.textContent = name;

                            const idElement = document.createElement('div');
                            idElement.className = 'selected-employees__id';
                            idElement.textContent = 'ID пользователя: ' + userId;

                            const departmentElement = document.createElement('div');
                            departmentElement.className = 'selected-employees__department';
                            departmentElement.textContent = department;

                            // ID сотрудника для отправки обычной HTML-формы.
                            const userIdInput = document.createElement('input');

                            userIdInput.type = 'hidden';
                            userIdInput.name = 'employees[' + userId + '][id]';
                            userIdInput.value = userId;

                            // Обязательный комментарий конкретного сотрудника.
                            const commentContainer = document.createElement('div');
                            commentContainer.className = 'selected-employees__comment';

                            const commentLabel = document.createElement('label');

                            commentLabel.className = 'selected-employees__comment-label';
                            commentLabel.htmlFor = 'employee-comment-' + userId;
                            commentLabel.textContent = 'Комментарий *';

                            const commentTextarea = document.createElement('textarea');

                            commentTextarea.id = 'employee-comment-' + userId;
                            commentTextarea.name = 'employees[' + userId + '][comment]';
                            commentTextarea.className = 'selected-employees__textarea';
                            commentTextarea.rows = 3;
                            commentTextarea.required = true;
                            commentTextarea.placeholder = 'Введите комментарий';
                            commentTextarea.value = employeeComments.get(userId) || '';

                            function updateComment() {
                                employeeComments.set(userId, commentTextarea.value);

                                // Не разрешаем комментарий, состоящий только из пробелов.
                                commentTextarea.setCustomValidity(
                                    commentTextarea.value.trim() === ''
                                        ? 'Заполните комментарий для сотрудника.'
                                        : ''
                                );
                            }

                            commentTextarea.addEventListener('input', updateComment);
                            updateComment();

                            commentContainer.appendChild(commentLabel);
                            commentContainer.appendChild(commentTextarea);

                            const removeButton = document.createElement('button');

                            removeButton.type = 'button';
                            removeButton.className = 'selected-employees__remove';
                            removeButton.textContent = 'Удалить';
                            removeButton.setAttribute(
                                'aria-label',
                                'Удалить сотрудника: ' + name
                            );

                            removeButton.addEventListener('click', function () {
                                selector.removeTag({
                                    id: tag.getId(),
                                    entityId: tag.getEntityId()
                                });
                            });

                            info.appendChild(nameElement);
                            info.appendChild(idElement);
                            info.appendChild(departmentElement);
                            info.appendChild(userIdInput);
                            info.appendChild(commentContainer);

                            row.appendChild(info);
                            row.appendChild(removeButton);

                            fragment.appendChild(row);
                        });

                        selectedContainer.appendChild(fragment);
                    }


                    selector.renderTo(
                        document.getElementById('employees-selector')
                    );

                    renderSelectedEmployees();

                    // ID выбранных сотрудников для отправки формы.
                    window.getSelectedEmployeeIds = function () {
                        return selector.getTags().map(function (tag) {
                            return Number(tag.getId());
                        });
                    };


                });
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    // Управление модальным окном
                    const openBtn = document.getElementById('open-gift-btn');
                    const modalOverlay = document.getElementById('gift-modal');
                    const closeBtn = document.getElementById('btn-close-modal');
                    const cancelBtn = document.getElementById('btn-cancel');

                    function openModal() {
                        modalOverlay.classList.add('is-open');
                        modalOverlay.setAttribute('aria-hidden', 'false');
                        document.body.style.overflow = 'hidden';
                        $('.selected-employees__remove').click();
                    }

                    function closeModal() {
                        modalOverlay.classList.remove('is-open');
                        modalOverlay.setAttribute('aria-hidden', 'true');
                        document.body.style.overflow = '';
                    }

                    openBtn?.addEventListener('click', openModal);
                    closeBtn?.addEventListener('click', closeModal);
                    cancelBtn?.addEventListener('click', closeModal);

                    modalOverlay?.addEventListener('click', (e) => {
                        if (e.target === modalOverlay) closeModal();
                    });

                    document.addEventListener('keydown', (e) => {
                        if (e.key === 'Escape' && modalOverlay.classList.contains('is-open')) {
                            closeModal();
                        }
                    });

                    // Обработка отправки формы
                    const btnSubmit = document.getElementById('btn-submit');

                    btnSubmit.addEventListener('click', function (e) {
                        e.preventDefault();

                        const selectedContainer = document.getElementById('selected-employees');
                        if (!selectedContainer) return;

                        // 1. Ищем выбранного сотрудника
                        const row = selectedContainer.querySelector('.selected-employees__row');
                        if (!row) {
                            alert('Пожалуйста, выберите сотрудника.');
                            return;
                        }

                        const targetUserId = row.getAttribute('data-user-id');
                        if (!targetUserId) {
                            alert('Не удалось определить ID сотрудника.');
                            return;
                        }

                        // 2. Ищем поле комментария внутри выбранного сотрудника
                        const commentBlock = row.querySelector('.selected-employees__comment');
                        const textarea = commentBlock ? commentBlock.querySelector('textarea') : null;
                        const commentValue = textarea ? textarea.value.trim() : '';

                        if (!commentValue) {
                            alert('Заполните обязательный комментарий для сотрудника.');
                            if (textarea) textarea.focus();
                            return;
                        }

                        // 3. Блокируем кнопку на время запроса
                        btnSubmit.disabled = true;
                        const originalBtnText = btnSubmit.innerHTML;
                        btnSubmit.innerHTML = 'Отправка...';

                        // 4. Формируем POST-параметры
                        const formData = new FormData();
                        formData.append('sessid', BX.bitrix_sessid()); // Токен безопасности Битрикса
                        formData.append('target_user_id', targetUserId);
                        formData.append('comment', commentValue);

                        // Путь к обработчику (укажите точный путь, если файл лежит в отдельной папке)
                        fetch('/local/ajax/marathon/ajax_marathon_handler.php', {
                            method: 'POST',
                            body: formData
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    alert('Звезда добавлена');

                                    // Очистка и закрытие


                                    // Звезду красную убрать При необходимости обновляем страницу для пересчета остатка
                                    //location.reload();UF_MARATHON  UF_EXCLUDE
                                    const btn = document.getElementById('open-gift-btn');
                                    const starsList = document.querySelector('.user-stars-list');


                                    // Находим все красные звёзды
                                    const redStars = starsList.querySelectorAll('.star-icon use[href="#icon-star-red"]');

                                    if (redStars.length === 0) return;

                                    // Берём последнюю красную звезду и меняем её на серую
                                    const lastRed = redStars[redStars.length - 1];
                                    lastRed.setAttribute('href', '#icon-star-gray');

                                    // Проверяем, остались ли ещё красные
                                    const remainingRed = starsList.querySelectorAll('.star-icon use[href="#icon-star-red"]');
                                    $('#stars-left-text').text(remainingRed.length + ' из 5');
                                    if (remainingRed.length === 0) {
                                        btn.disabled = true;
                                        btn.classList.add('disabled');
                                    }

                                    if (textarea) textarea.value = '';
                                    closeModal();
                                } else {
                                    alert(data.message || 'Произошла ошибка при отправке');
                                }
                            })
                            .catch(err => {
                                console.error(err);
                                alert('Произошла сетевая ошибка при отправке запроса.');
                            })
                            .finally(() => {
                                btnSubmit.disabled = false;
                                btnSubmit.innerHTML = originalBtnText;
                            });
                    });
                });
            </script>
        </div>

    <?php elseif (!$blOwnerLk): ?>
        <?php $uriString1 = $request->getRequestUri();
        $currentUserId = \Bitrix\Main\Engine\CurrentUser::get()->getId();
        if (preg_match('/\/user\/(\d+)\//', $uriString1, $matches)) {
            $urlUserId1 = $matches[1]; // Результат: 911
        } ?>
        <?php


        global $USER;

        /*
         * Настройки.
         */
        $iblockCode = 'stars_marathon';
        $recipientPropertyCode = 'whome_send_user';

        /*
         * Если отправитель хранится в отдельном свойстве типа
         * «Привязка к пользователю», укажите его код.
         *
         * Пустая строка — использовать CREATED_BY.
         */
        $senderPropertyCode = '';

        /*
         * Если комментарий хранится в отдельном свойстве,
         * укажите его код.
         *
         * Пустая строка — использовать PREVIEW_TEXT / DETAIL_TEXT.
         * Ожидается одиночное строковое свойство или свойство HTML/текст.
         */
        $commentPropertyCode = '';

        if (!$USER->IsAuthorized()) {
            echo '<p>Чтобы увидеть полученные звёзды, авторизуйтесь.</p>';
            return;
        }

        if (!Loader::includeModule('iblock')) {
            echo '<p>Не удалось подключить модуль инфоблоков.</p>';
            return;
        }

        $currentUserId1 = (int)$urlUserId1;


        /*
         * Находим инфоблок по символьному коду.
         */
        $iblockResult = CIBlock::GetList(
                [],
                [
                        'CODE' => $iblockCode,
                        'ACTIVE' => 'Y',
                ]
        );

        $iblock = $iblockResult->Fetch();

        if (!$iblock) {
            echo '<p>Инфоблок stars_marathon не найден.</p>';
            return;
        }

        /*
         * Получаем элементы, отправленные текущему пользователю.
         *
         * GetNextElement() + GetProperties() позволяет не размножать
         * элементы в результате из-за множественных свойств.
         */
        $elementsResult = CIBlockElement::GetList(
                [
                        'DATE_CREATE' => 'DESC',
                        'ID' => 'DESC',
                ],
                [
                        'IBLOCK_ID' => (int)$iblock['ID'],
                        'ACTIVE' => 'Y',
                        '=PROPERTY_' . $recipientPropertyCode => $urlUserId1,
                        'CHECK_PERMISSIONS' => 'Y',
                        'MIN_PERMISSION' => 'R',
                ],
                false,
                false,
                [
                        'ID',
                        'IBLOCK_ID',
                        'CREATED_BY',
                        'DATE_CREATE',
                        'PREVIEW_TEXT',
                        'DETAIL_TEXT',
                ]
        );

        $comments = [];
        $authorIds = [];

        while ($elementObject = $elementsResult->GetNextElement()) {
            // false — получаем исходные значения, экранируем при выводе.
            $element = $elementObject->GetFields(false, false);

            $properties = [];

            if ($senderPropertyCode !== '' || $commentPropertyCode !== '') {
                $properties = $elementObject->GetProperties();
            }

            $authorId = (int)$element['CREATED_BY'];

            if ($senderPropertyCode !== '') {
                $senderCode = strtoupper($senderPropertyCode);
                $authorId = (int)($properties[$senderCode]['VALUE'] ?? 0);
            }

            if ($commentPropertyCode !== '') {
                $commentCode = strtoupper($commentPropertyCode);
                $commentValue = $properties[$commentCode]['VALUE'] ?? '';

                // Поддержка свойства типа HTML/текст.
                $text = is_array($commentValue)
                        ? (string)($commentValue['TEXT'] ?? '')
                        : (string)$commentValue;
            } else {
                $previewText = trim((string)$element['PREVIEW_TEXT']);

                $text = $previewText !== ''
                        ? $previewText
                        : (string)$element['DETAIL_TEXT'];
            }

            $comments[] = [
                    'ID' => (int)$element['ID'],
                    'AUTHOR_ID' => $authorId,
                    'TEXT' => $text,
                    'DATE_CREATE' => (string)$element['DATE_CREATE'],
            ];

            if ($authorId > 0) {
                $authorIds[$authorId] = $authorId;
            }
        }

        /*
         * Получаем всех авторов одним запросом.
         */
        $authors = [];

        if ($authorIds) {
            $by = 'id';
            $order = 'asc';

            $usersResult = CUser::GetList(
                    $by,
                    $order,
                    [
                            'ID' => implode('|', array_values($authorIds)),
                    ],
                    [
                            'FIELDS' => [
                                    'ID',
                                    'NAME',
                                    'LAST_NAME',
                                    'LOGIN',
                            ],
                    ]
            );

            while ($author = $usersResult->Fetch()) {
                $authors[(int)$author['ID']] = $author;
            }
        }

        $starsCount = count($comments);

        /*
         * Склонение: 1 звезда, 2 звезды, 5 звёзд, 21 звезда.
         */
        $pluralizeStars = static function (int $number): string {
            $lastTwo = $number % 100;
            $lastOne = $number % 10;

            if ($lastTwo >= 11 && $lastTwo <= 14) {
                return 'звёзд';
            }

            if ($lastOne === 1) {
                return 'звезда';
            }

            if ($lastOne >= 2 && $lastOne <= 4) {
                return 'звезды';
            }

            return 'звёзд';
        };

        $escape = static function ($value): string {
            return htmlspecialchars(
                    (string)$value,
                    ENT_QUOTES | ENT_SUBSTITUTE,
                    'UTF-8'
            );
        };

        $getInitials = static function (array $author): string {
            $initials = '';

            foreach (['NAME', 'LAST_NAME'] as $field) {
                $part = trim((string)($author[$field] ?? ''));

                if ($part !== '') {
                    $initials .= mb_substr($part, 0, 1, 'UTF-8');
                }
            }

            if ($initials === '') {
                $initials = mb_substr(
                        (string)($author['LOGIN'] ?? '?'),
                        0,
                        1,
                        'UTF-8'
                );
            }

            return mb_strtoupper($initials, 'UTF-8');
        };

        $formatCommentDate = static function (string $value): string {
            $timestamp = MakeTimeStamp($value);

            if (!$timestamp) {
                return '';
            }

            $months = [
                    1 => 'января',
                    2 => 'февраля',
                    3 => 'марта',
                    4 => 'апреля',
                    5 => 'мая',
                    6 => 'июня',
                    7 => 'июля',
                    8 => 'августа',
                    9 => 'сентября',
                    10 => 'октября',
                    11 => 'ноября',
                    12 => 'декабря',
            ];

            return date('d', $timestamp)
                    . ' ' . $months[(int)date('n', $timestamp)]
                    . ' ' . date('Y', $timestamp);
        };

        /*
         * Одинаковая SVG-звезда для счётчика и комментариев.
         * Внешние изображения и SVG-спрайты не нужны.
         */
        $starSvg = '
    <svg
        class="sm-star"
        viewBox="0 0 32 32"
        aria-hidden="true"
        focusable="false"
    >
        <path d="
            M16 2
            L20.3 11.1
            L30.3 12.4
            L23 19.4
            L24.8 29.3
            L16 24.5
            L7.2 29.3
            L9 19.4
            L1.7 12.4
            L11.7 11.1
            Z
        " />
    </svg>
';

        $starsLabel = $starsCount . ' ' . $pluralizeStars($starsCount);
        ?>
        <style>
            .stars-marathon,
            .stars-marathon * {
                box-sizing: border-box;
            }

            .stars-marathon {
                width: 100%;
                background: #fff;
                border-radius: 0 0 24px 24px;
                color: #333;
                font-family:"IBM Plex Sans", "Helvetica Neue", Helvetica, Arial, sans-serif ;

            }

            .sm-received {
                padding: 30px;
                margin-top: 20px;
            }

            .stars-marathon .sm-title {
                margin: 0 0 26px;
                font-size: 20px;
                font-weight: 600;
                line-height: 1.3;
            }

            .stars-marathon .sm-stars-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 24px;
            }

            .stars-marathon .sm-stars {
                display: flex;
                flex: 1 1 auto;
                flex-wrap: wrap;
                align-items: center;
                gap: 10px;
                min-width: 0;
            }

            .stars-marathon .sm-star {
                display: block;
                flex-shrink: 0;
                width: 30px;
                height: 30px;
                fill: #dc3541;
            }

            .stars-marathon .sm-stars-count {
                flex: 0 0 auto;
                color: #666;
                font-size: 15px;
                line-height: 1.4;
                white-space: nowrap;
            }

            .stars-marathon .sm-comments {
                margin-top: 48px;
            }

            .stars-marathon .sm-comments-title {
                margin: 0 0 14px;
                font-size: 16px;
                font-weight: 600;
                line-height: 1.4;
            }

            .stars-marathon .sm-comment {
                display: flex;
                align-items: flex-start;
                gap: 14px;
                padding: 16px 0 26px;
            }

            .stars-marathon .sm-comment + .sm-comment {
                border-top: 1px solid #f0f0f0;
            }

            .stars-marathon .sm-avatar {
                display: flex;
                flex: 0 0 42px;
                align-items: center;
                justify-content: center;
                width: 42px;
                height: 42px;
                border-radius: 50%;
                background: #eeeff4;
                color: #777c87;
                font-size: 14px;
                font-weight: 600;
            }

            .stars-marathon .sm-comment-content {
                flex: 1 1 auto;
                min-width: 0;
            }

            .stars-marathon .sm-comment-top {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                min-height: 20px;
            }

            .stars-marathon .sm-user-row {
                display: flex;
                align-items: center;
                gap: 8px;
                min-width: 0;
            }

            .stars-marathon .sm-user-name {
                color: #707070;
                font-size: 14px;
                font-weight: 600;
                overflow-wrap: anywhere;
            }

            .stars-marathon .sm-user-arrow {
                flex-shrink: 0;
                width: 0;
                height: 0;
                border-top: 4px solid #aaa;
                border-right: 3px solid transparent;
                border-left: 3px solid transparent;
            }

            .stars-marathon .sm-user-row .sm-star {
                width: 14px;
                height: 14px;
            }

            .stars-marathon .sm-comment-meta {
                display: flex;
                flex-shrink: 0;
                align-items: center;
                gap: 18px;
                color: #888;
            }

            .stars-marathon .sm-comment-date {
                font-size: 12px;
                white-space: nowrap;
            }

            .stars-marathon .sm-dots {
                color: #a2a2a2;
                font-size: 16px;
                letter-spacing: 1px;
                line-height: 1;
            }

            .stars-marathon .sm-comment-text {
                margin: 12px 0 0;
                color: #555;
                font-size: 13px;
                line-height: 1.6;
                overflow-wrap: anywhere;
            }

            .stars-marathon .sm-empty {
                margin: 0;
                padding: 12px 0 20px;
                color: #888;
                font-size: 14px;
                line-height: 1.5;
            }

            @media (max-width: 600px) {
                .stars-marathon {
                    padding: 24px 18px 12px;
                    border-radius: 16px;
                }

                .stars-marathon .sm-received {
                    padding: 0;
                }

                .stars-marathon .sm-stars-row {
                    gap: 14px;
                }

                .stars-marathon .sm-stars {
                    gap: 6px;
                }

                .stars-marathon .sm-stars > .sm-star {
                    width: 25px;
                    height: 25px;
                }

                .stars-marathon .sm-comments {
                    margin-top: 32px;
                }

                .stars-marathon .sm-comment {
                    gap: 10px;
                    padding-bottom: 20px;
                }

                .stars-marathon .sm-comment-top {
                    align-items: flex-start;
                    flex-direction: column;
                    gap: 7px;
                }

                .stars-marathon .sm-comment-meta {
                    justify-content: space-between;
                    width: 100%;
                }

                .stars-marathon .sm-comment-text {
                    margin-top: 9px;
                }
            }
        </style>
        <div class="stars-marathon">
            <section class="forAll sm-received" aria-label="Полученные звёзды">
                <h2 class="sm-title">Получено</h2>
                <div class="sm-stars-row">
                    <div class="sm-stars" aria-hidden="true">
                        <?php for ($i = 0; $i < $starsCount; $i++): ?>
                            <?= $starSvg ?>
                        <?php endfor; ?>
                    </div>

                    <span class="sm-stars-count">
                <?= $escape($starsLabel) ?>
            </span>
                </div>
            </section>
        </div>
    <?php endif; ?>

    <?php
} ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/includes/listok/form.php"); ?>
