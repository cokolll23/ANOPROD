<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc; ?>
<style>
    /* Для Способа А */
    .my-balloon {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px;
        border-radius: 15px;
        max-width: 300px;
        font-family: Arial;
    }

    .my-balloon__header {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .my-balloon__button {
        background: white;
        color: #764ba2;
        border: none;
        padding: 10px 20px;
        border-radius: 30px;
        cursor: pointer;
        margin-top: 10px;
    }

    /* Для Способа Б (полная замена) */
    .custom-balloon-wrapper {
        position: relative;
        margin-bottom: 15px; /* Место для хвостика */
    }

    .custom-balloon {
        position: relative;
        top: -95px;
        left: -250px;
    }


    .balun-content_wrapp {
        position: absolute;
        top: 14%;
        left: 60px;
        width: 160px;
    }

    #holod .balun-content_wrapp {
        left: 90px;
    }

    #belka .balun-content_wrapp {
        top: 19%;
    }

    .balun-content_top {
        font-family: "denistina", "Marck Script", cursive;
        color: #E30613;
        font-size: 170%;
        line-height: 15px;
    }

    .balun-content_b {
        font-size: 70%;
    }

    .balun-content_m {
        line-height: 15px;
    }
</style>

<?
//pretty_print($arResult);

if (!empty($arResult['ERROR'])) {

    echo $arResult['ERROR'];

} else {

    if (!empty($arResult['ARPHONES'])) {

        $arPhones = $arResult['ARPHONES'];

        unset($arResult['ARPHONES']);

    }

    ?>
    <style>
        #holod {
            /*top: 200px;*/
            left: 250px;
        }

        #holod .balun-content_wrapp {
            /*top: 200px;*/
            margin-left: 10px;
        }


    </style>

    <script src="https://api-maps.yandex.ru/2.1/?apikey=<?= $arParams['yandexApiKey'] ?>&lang=ru_RU"
            type="text/javascript"></script>

    <script type="text/javascript">


        var iconImageSize = [70, 35];
        ymaps.ready(init);


        function init() {

            var myMap = new ymaps.Map("map", {
                center: [55.7711, 37.5993],
                zoom: 14
            }, {
                searchControlProvider: 'yandex#search'
            });
            myMap.behaviors.disable('scrollZoom');


            // ===================Belka
            var FullCustomBalloonBelka = ymaps.templateLayoutFactory.createClass(
                '<div id="belka" class="custom-balloon-wrapper">' +
                '<div class="custom-balloon">' +
                '<div class="balun-content_wrapp" >' +
                '<div class="balun-content_top" > Белка</div>' +
                '<div class="balun-content_m" ><b>4-й Лесной переулок, 4</b></div>' +
                '<div class="balun-content_b" >АНО «Проектный офис по развитию туризма и гостеприимства Москвы» </div>' +
                '<button class="icon-btn  b3">Схема проезда</button>' +
                '</div>' +
                '</div>' +
                '</div>'
            );

            var placemark = new ymaps.Placemark(
                [55.779069, 37.586931],
                {
                    iconContent: '<button>777</button>'
                },
                {
                    iconLayout: 'default#imageWithContent',
                    iconImageHref: '/wcp/imgs/belka.svg',
                    iconImageSize: [300, 170],
                    iconImageOffset: [-290, 0],
                    iconContentOffset: [240, 120],
                    iconContentLayout: FullCustomBalloonBelka
                }
            );

            // Belka.
            /* var myPlacemarkBelka = new ymaps.Placemark(
                 [55.779069, 37.586931],
                 {
                     iconContent: 'PDF'
                 }, {
                 iconLayout: FullCustomBalloonBelka,
                 iconImageHref: "imgs/lesnoy.svg",
                 iconContent: 'Большая дмитровка 11 стр 7',
                 iconImageSize: iconImageSize,
                 //iconImageOffset: [1200, 350]
             });*/
            /* placemark.events.add('hover', function () {
             $('.icon-btn').addClass('btn');

             });
             placemark.events.add('mouseleave', function () {
             $('.icon-btn').removeClass('btn');

             });*/

            placemark.events.add('click', function () {
                window.open('/wcp/imgs/belka.pdf', '_blank');
            });
            myMap.geoObjects.add(placemark);


            // =================== Tver======================
            var FullCustomBalloonTver = ymaps.templateLayoutFactory.createClass(
                '<div id="tver" class="custom-balloon-wrapper">' +
                '<div class="custom-balloon">' +
                '<div class="balun-content_wrapp" >' +
                '<div class="balun-content_top" > Ректорский<br> домик</div>' +
                '<div class="balun-content_m" ><b>Тверская, 5А</b></div>' +
                '<div class="balun-content_b" >АНО «Проектный офис по развитию туризма и гостеприимства Москвы» </div>' +
                '<button class="icon-btn  b3">Схема проезда</button>' +
                '</div>' +
                '</div>' +
                '</div>'
            );

            var placemarkTver = new ymaps.Placemark(
                [55.756893, 37.611140],
                {
                    iconContent: '<button>777</button>'
                },
                {
                    iconLayout: 'default#imageWithContent',
                    iconImageHref: '/wcp/imgs/tver.svg',
                    iconImageSize: [300, 170],
                    iconImageOffset: [-290, -125],
                    iconContentOffset: [240, 100],
                    iconContentLayout:FullCustomBalloonTver
                }
            );

            // Belka.
            /* var myPlacemarkBelka = new ymaps.Placemark(
                 [55.779069, 37.586931],
                 {
                     iconContent: 'PDF'
                 }, {
                 iconLayout: FullCustomBalloonBelka,
                 iconImageHref: "imgs/lesnoy.svg",
                 iconContent: 'Большая дмитровка 11 стр 7',
                 iconImageSize: iconImageSize,
                 //iconImageOffset: [1200, 350]
             });*/
            /* placemark.events.add('hover', function () {
             $('.icon-btn').addClass('btn');

             });
             placemark.events.add('mouseleave', function () {
             $('.icon-btn').removeClass('btn');

             });*/

            placemarkTver.events.add('click', function () {
                window.open('/wcp/imgs/tver.pdf', '_blank');
            });
            myMap.geoObjects.add(placemarkTver);


            // =================== Holod======================
            var FullCustomBalloonHolod = ymaps.templateLayoutFactory.createClass(
                '<div style="margin-bottom: 19px!important;" id="holod" class="custom-balloon-wrapper">' +
                '<div class="custom-balloon">' +
                '<div class="balun-content_wrapp" >' +
                '<div class="balun-content_top" > Холодильник<</div>' +
                '<div style="margin-bottom: 5px;" class="balun-content_m" ><b>Большая дмитровка, 11, стр 7</b></div>' +
                '<div class="balun-content_b" ><div>Комитет по туризму</div><div>АНО «Проектный офис по развитию туризма и гостеприимства Москвы» </div></div>' +
                '<button class="icon-btn  b1">Схема проезда</button>' +
                '</div>' +
                '</div>' +
                '</div>'
            );

            var placemarkHolod = new ymaps.Placemark(
                [55.761644, 37.612991],
                {
                    iconContent: '<button>777</button>'
                },
                {
                    iconLayout: 'default#imageWithContent',
                    iconImageHref: '/wcp/imgs/holod.svg',
                    iconImageSize: [340, 190],
                    iconImageOffset: [0, -125],
                    iconContentOffset: [0, 100],
                    iconContentLayout:FullCustomBalloonHolod
                }
            );

            // Belka.
            /* var myPlacemarkBelka = new ymaps.Placemark(
                 [55.779069, 37.586931],
                 {
                     iconContent: 'PDF'
                 }, {
                 iconLayout: FullCustomBalloonBelka,
                 iconImageHref: "imgs/lesnoy.svg",
                 iconContent: 'Большая дмитровка 11 стр 7',
                 iconImageSize: iconImageSize,
                 //iconImageOffset: [1200, 350]
             });*/
            /* placemark.events.add('hover', function () {
             $('.icon-btn').addClass('btn');

             });
             placemark.events.add('mouseleave', function () {
             $('.icon-btn').removeClass('btn');

             });*/

            placemarkHolod.events.add('click', function () {
                window.open('/wcp/imgs/holod.pdf', '_blank');
            });
            myMap.geoObjects.add(placemarkHolod);


        }


    </script>


    <div id="map" style="width: <?= $arParams['mapWidht'] ?>; height: 800px"></div>

    <?
}
?>

