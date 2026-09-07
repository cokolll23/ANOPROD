<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>
<?
$APPLICATION->SetTitle("Словарь
корпоративных терминов
и аббревиатур");
Bitrix\Main\Page\Asset::getInstance()->addCss('/bitrix/js/lab/ui/fonts/ony/ui.font.ony.css');
?>
    <style>
        .add-search-wrapper {
            width: 100%;
            text-align: center;
            display: flex;
        }

        .add-search-wrapper_inn {
            width: 55%;
            text-align: center;
            display: flex;
        }

        #category-search {
            position: relative;
            width: inherit;
        }

        .category-search_inn1 {
            position: absolute;
            left: -29%;
            font-size: 40px;
            color: #ff0d00;
        }

        #category-search, .category-search_inn a {
            width: 100%;
            height: 60px;
            font-size: 40px;
            color: #333;
        }

        #title-search-input1 ::placeholder {
            color: #AFAFAF;
            font-size: 30px;
        }

        #title-search-input1 {
            text-align: center;
        }

        .card7771 {

            width: 100%;
            background: white;
            transition: box-shadow 0.2s ease;
        }

        /* Основной контейнер для текста — обрезаем и добавляем многоточие */
        .text-content {
            display: -webkit-box;
            -webkit-line-clamp: 1; /* количество строк до многоточия */
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        /* Когда класс .expanded добавлен — убираем ограничение */
        .text-wrapper.expanded .text-content {
            display: block; /* отключаем -webkit-line-clamp */
            -webkit-line-clamp: unset;
            overflow: visible;
        }


        /* Когда текст свёрнут — показываем "развернуть" */
        .text-wrapper:not(.expanded) .toggle-hint .collapse-label {
            display: none;
        }

        /* Адаптив */
        @media (max-width: 480px) {
            .card7771 {
                padding: 1.5rem 1rem;
            }

            .text-wrapper {
                padding: 1rem 1.25rem;
                font-size: 1rem;
            }
        }
    </style>

    <main class="page slovar">
        <div class="container">
            <section class="hero rel">
                <svg class="abs bashnya-svg" width="238" height="389" viewBox="0 0 238 389" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M54.2146 387.935C74.6502 361.607 92.5262 316.709 99.4703 268.943C103.531 241.015 101.831 204.81 96.9208 171.855C87.5629 109.053 75.72 73.5009 66.466 80.352C44.3755 96.7064 64.6231 132.536 71.22 153.001C76.6823 169.946 95.165 190.128 108.666 205.613C127.007 226.649 156.551 249.589 184.635 269.42C200.279 278.774 210.893 281.453 222.113 282.445C227.44 282.782 232.023 282.782 236.745 282.782"
                          stroke="#FF0D00" stroke-width="2" stroke-linecap="round"/>
                    <path d="M46.2785 38.7469C46.2785 31.5251 44.969 15.6529 40.991 8.65925C30.9109 -9.06287 60.8016 42.6952 66.4064 45.6712C69.191 47.1498 72.666 46.6831 70.7514 45.701C50.8786 35.5073 27.8667 39.4215 3.02674 37.7649C-8.32216 37.008 30.9618 22.2795 47.2209 14.6312C58.7846 9.1915 66.0988 0.415612 64.8191 1.03068C53.0638 13.4308 38.4018 32.6957 28.4917 49.8674C24.474 57.2182 22.5098 61.8014 20.4861 70.4914"
                          stroke="#FF0D00" stroke-width="2" stroke-linecap="round"/>
                </svg>
                <div class="top-titlle78">
                    <div class="top-titlle_top">
                        <div class="rel">
                            <div class="hero__word title">Словарь</div>
                            <svg class="abs svg" width="664" height="128" viewBox="0 0 664 128" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M513.912 36.768C509.991 35.4565 494.247 31.5021 452.377 25.8786C424.568 22.1436 382.078 22.2223 319.192 27.4484C256.305 32.6746 173.961 44.478 119.288 54.1652C38.9452 68.4006 10.9367 81.1204 4.50541 86.734C1.38663 89.4562 1.01502 93.0033 1.00016 96.3317C0.98531 99.6602 1.96558 102.939 12.7636 107.251C42.3723 119.075 88.8841 124.181 164.723 126.506C216.982 128.108 297.417 125.552 360.883 122.581C424.349 119.611 468.462 115.021 508.342 109.377C583.087 98.8 630.625 85.1741 651.404 75.9141C659.75 72.1947 662.381 69.2772 662.915 65.9587C663.45 62.6402 661.489 58.7057 656.068 55.0395C650.647 51.3732 641.824 48.0945 579.933 39.848C518.041 31.6015 403.348 18.4865 311.424 11.0746C219.5 3.66269 153.821 2.35122 86.1513 1"
                                      stroke="#FF0D00" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>

                        <h1 class="hero__title title">
                            корпоративных терминов<br>
                            и аббревиатур
                        </h1>
                    </div>
                    <div class="cursive-wrap rel">
                        <div class="hero__subtitle abs cursive">
                            как говорят у нас в <span class="hero__subtitle_inner">Мостуризме</span>
                        </div>
                    </div>
                    <div class="imgHeart">
                        <img src="Group 2.png">
                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>

                <div class="descr-text">
                    <p class="hero__text">
                        Дорогие коллеги, в этом словаре мы собрали наиболее часто использующиеся <br>
                        в нашей работе сокращения и аббревиатуры.
                    </p>

                    <p class="hero__text">
                        Этот словарь будет полезен нашим новым работникам и позволит им скорее начать<br>
                        разговаривать со всеми «на одном языке».
                    </p>

                    <p class="hero__text">
                        Мы признательны тем, кто принимал активное участие в составлении словаря,
                        и напоминаем,<br> что каждый может дополнить словарь новыми терминами
                        или сокращениями.
                    </p>
                </div>
                <div class="add-search-wrapper">
                    <div class="add-search-wrapper_inn">

                        <div class="slovar-search ">
                            <? $APPLICATION->IncludeComponent("bitrix:search.title", "catalog1", array(
                                            "SHOW_INPUT" => "Y",
                                            "INPUT_ID" => "title-search-input1",
                                            "CONTAINER_ID" => "title-search",
                                            "PRICE_CODE" => array("BASE", "RETAIL"),
                                            "PRICE_VAT_INCLUDE" => "Y",
                                            "PREVIEW_TRUNCATE_LEN" => "150",
                                            "SHOW_PREVIEW" => "Y",
                                            "PREVIEW_WIDTH" => "75",
                                            "PREVIEW_HEIGHT" => "75",
                                            "CONVERT_CURRENCY" => "Y",
                                            "CURRENCY_ID" => "RUB",
                                            "PAGE" => "#SITE_DIR#search/index.php",
                                            "NUM_CATEGORIES" => "10",
                                            "TOP_COUNT" => "10",
                                            "ORDER" => "date",
                                            "USE_LANGUAGE_GUESS" => "Y",
                                            "CHECK_DATES" => "Y",
                                            "SHOW_OTHERS" => "N",
                                            "CATEGORY_0_TITLE" => "Словарь",
                                            "CATEGORY_0" => array("iblock_slovar"),
                                            "CATEGORY_0_iblock_slovar" => array("iblock" => 47),
                                            "TEMPLATE_THEME" => "red",
                                            "arrFilter" => array("iblock" => 47),
                                            "IBLOCK_ID" => 47,
                                    )
                            ); ?>
                        </div>
                        <a target="_blank" href="/news/vote_new.php?VOTE_ID=7" class="hero__btn">дополнить словарь</a>
                        <br><br>
                        <br>


                        <div id="category-search">
                            <?php
                            // Подключаем необходимые модули и классы
                            use Bitrix\Main\Loader;
                            use Bitrix\Iblock\SectionTable;

                            // Убедимся, что модуль инфоблоков загружен
                            if (!Loader::includeModule('iblock')) {
                                echo 'Модуль инфоблоков не найден';
                                return;
                            }

                            // Получаем ID инфоблока по его символьному коду 'slovar'
                            $iblockId = 0;
                            $iblockRes = \CIBlock::GetList([], ['CODE' => 'slovar']);
                            if ($iblock = $iblockRes->Fetch()) {
                                $iblockId = (int)$iblock['ID'];
                            } else {
                                echo 'Инфоблок с кодом "slovar" не найден';
                                return;
                            }

                            // Выполняем запрос к таблице разделов с кешированием
                            $result = SectionTable::getList([
                                    'select' => ['ID', 'NAME'], // Запрашиваем только ID и название
                                    'filter' => [
                                            '=IBLOCK_ID' => $iblockId, // Фильтр по ID нашего инфоблока
                                            '=ACTIVE' => 'Y',// Только активные разделы (опционально)
                                        //'>ELEMENT_CNT' => 0
                                    ],
                                    'order' => ['NAME' => 'ASC'], // Сортируем по полю "Сортировка"
                                    'cache' => [
                                            'ttl' => 3600, // Время жизни кеша в секундах (1 час)
                                            'cache_joins' => true, // Учитывать объединения таблиц при формировании ключа кеша
                                    ]
                            ]);

                            // Выводим названия разделов
                            $sections = $result->fetchAll();
                            foreach ($sections as $section) {

                                // $arSections[$section['ID']] = preg_replace('/[^A-ZА-ЯЁ]/u', '', $section['NAME']);
                            }
                            //pretty_print($arSections);
                            ?>


                            <?php
                            // Подключаем пролог для использования API Битрикс
                            require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

                            // 1. Проверяем, что модуль инфоблоков установлен
                            if (!CModule::IncludeModule("iblock")) {
                                die("Модуль инфоблоков не установлен");
                            }

                            // 2. Находим ID инфоблока по его символьному коду 'slovar'
                            $iblockId = 0;
                            $iblockRes = CIBlock::GetList([], ['CODE' => 'slovar']);
                            if ($iblock = $iblockRes->Fetch()) {
                                $iblockId = (int)$iblock['ID'];
                            }

                            if ($iblockId <= 0) {
                                die("Инфоблок с кодом 'slovar' не найден");
                            }

                            // 3. Параметры кеширования
                            $cacheTtl = 3600; // Время жизни кеша в секундах (1 час)
                            $cacheId = 'sections_slovar_' . $iblockId; // Уникальный идентификатор кеша
                            $cachePath = '/sections_cache/'; // Путь для хранения кеша

                            // 4. Пытаемся получить данные из кеша
                            $obCache = new CPHPCache;
                            $sections = [];

                            if ($obCache->InitCache($cacheTtl, $cacheId, $cachePath)) {
                                // Данные найдены в кеше
                                $sections = $obCache->GetVars();
                            } else {
                                // Данных в кеше нет, выполняем запрос
                                // Третий параметр 'true' включает подсчет количества элементов в разделе [citation:1]
                                $rsSections = CIBlockSection::GetList(
                                        ['NAME' => 'ASC'], // Сортировка по названию раздела [citation:6]
                                        ['IBLOCK_ID' => $iblockId],
                                        true, // Подсчитывать количество элементов в разделе
                                        ['ID', 'NAME', 'CODE', 'SECTION_PAGE_URL'] // Выбираемые поля
                                );

                                while ($section = $rsSections->GetNext()) {
                                    $sections[] = $section;
                                }

                                // Сохраняем результат в кеш
                                if ($obCache->StartDataCache()) {
                                    $obCache->EndDataCache($sections);
                                }
                            }


                            foreach ($sections as $section) {
                                $arSects[$section['ID']] = $section;
                            }

                            foreach ($arSects as $section) {
                                if ($section['ELEMENT_CNT'] > 0) {
                                    $arSections[$section['ID']] = preg_replace('/[^A-ZА-ЯЁ]/u', '', $section['NAME']);
                                }
                            }
                            ?>

                            <a href="#s311" class="category-search_inn1"> Все слова</a>
                            <div class="card7771">
                                <div class="text-wrapper" id="expandableText" role="button" tabindex="0"
                                     aria-expanded="false">
                                    <div class="category-search_inn text-content">
                                        <? foreach ($arSections as $i => $section): ?>
                                            <a href="#s<?= $i; ?>"><?= $section ?></a>
                                        <? endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Marck+Script&display=swap"
                  rel="stylesheet">


            <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "template11",
                    [
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "ADD_SECTIONS_CHAIN" => "Y",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "DISPLAY_BOTTOM_PAGER" => "Y",
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "FIELD_CODE" => [
                                    0 => "",
                                    1 => "",
                            ],
                            "FILTER_NAME" => "",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "47",
                            "IBLOCK_TYPE" => "slovar",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "99999",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Новости",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => [
                                    0 => "",
                                    1 => "",
                            ],
                            "SET_BROWSER_TITLE" => "Y",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "Y",
                            "SET_META_KEYWORDS" => "Y",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "Y",
                            "SHOW_404" => "N",
                            "SORT_BY1" => "NAME",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER1" => "ASC",
                            "SORT_ORDER2" => "ASC",
                            "STRICT_SECTION_CHECK" => "N",
                            "COMPONENT_TEMPLATE" => "template1"
                    ],
                    false
            ); ?><br>


        </div>
    </main>

    <script>
        (function () {
            const textBlock = document.getElementById('expandableText');

            // Функция переключения состояния
            function toggleExpanded() {
                const isExpanded = textBlock.classList.toggle('expanded');
                // Обновляем aria-expanded для доступности
                textBlock.setAttribute('aria-expanded', isExpanded);
            }

            // Слушаем клик по всему блоку
            textBlock.addEventListener('click', function (e) {
                // Игнорируем, если клик был по ссылке или внутри неё (на всякий случай)
                // Но в данном примере ссылок нет, поэтому просто переключаем
                toggleExpanded();
            });

            // Для клавиатурной доступности (Enter / Space)
            textBlock.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();  // предотвращаем скролл при пробеле
                    toggleExpanded();
                }
            });
        })();
    </script>


<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>