<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Bitrix\Main\Localization\Loc;?>
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


    .balun-content_wrapp{
        position: absolute;
        top: 10%;
        left: 60px;
    }
    .balun-content_top{
        font-family: "denistina", "Marck Script", cursive;
        color: #E30613;
        font-size: 170%;
        line-height: 15px;
    }
    .balun-content_b{
        font-size: 70%;
    }.balun-content_m{
        line-height: 15px;
    }
</style>

<? if(!empty($arResult['ERROR'])) {

    echo $arResult['ERROR'];

} else {

    if(!empty($arResult['ARPHONES'])) {

        $arPhones = $arResult['ARPHONES'];

        unset($arResult['ARPHONES']);

    }

    ?>

    <script src="https://api-maps.yandex.ru/2.1/?apikey=<?= $arParams['yandexApiKey'] ?>&lang=ru_RU"
            type="text/javascript"></script>

    <script type="text/javascript">

        ymaps.ready(function () {

            var myMap = new ymaps.Map('map',

                {

                    center: [<?=$arParams['mapCenter']?>],
                    zoom: <?=$arParams['mapZoom']?>

                }, {

                    searchControlProvider: 'yandex#search'

                }
            )<? if(count($arResult)>0) {echo ",";} else {echo "";}?>

            <? $counter_i = 1; ?>

            <?foreach ($arResult as $item) {

            if (!empty($item["PREVIEW_PICTURE"])) {

            $item["PREVIEW_PICTURE"] = CFile::GetFileArray($item["PREVIEW_PICTURE"]);

            $body = '';

            $item["DETAIL_PICTURE"] = CFile::GetFileArray($item["DETAIL_PICTURE"]);

            if(!empty($item["DETAIL_PICTURE"])) $body .= "<img src=\"".$item['DETAIL_PICTURE']['SRC']."\"> <br/>";

            if(!empty($item['PROPERTY_CODEPLACE_VALUE']['TEXT'])) {

                $body = str_replace(array("\r\n", "\r", "\n"), '', $item['~PROPERTY_CODEPLACE_VALUE']['TEXT']);

            } else {

                if(!empty($item['PROPERTY_ADRESS_VALUE'])) $body .= '<b>'.Loc::getMessage('WEBMAXIMA_PLACE_ADRESS').'</b>: '.$item['PROPERTY_ADRESS_VALUE'].'<br />';

                if(!empty($item['PROPERTY_PHONE_VALUE'])) {

                    foreach ($arPhones[$item['ID']] as $key => $arPhone) {

                        if($key == (count($arPhones[$item['ID']])-1)) {

                            $Phone_string .= $arPhone;

                        } else {

                            $Phone_string .= $arPhone.', ';

                        }

                    }

                    $body .= '<b>'.Loc::getMessage('WEBMAXIMA_PLACE_PHONE').'</b>: '.$Phone_string.'<br />';

                    unset($Phone_string);

                }

                if(!empty($item['PROPERTY_TIMEWORK_VALUE'])) $body .= '<b>'.Loc::getMessage('WEBMAXIMA_PLACE_TIMEWORK').'</b>: '.$item['PROPERTY_TIMEWORK_VALUE'].'<br />';

            }

            ?>

            placemark<?=$item['ID']?> = new ymaps.Placemark([<?=$item['PROPERTY_COORDS_VALUE']?>], {
                balloonContentHeader: '<?=$item['NAME']?>',
                <?if(!empty($body)) echo "balloonContentBody: '".$body."',"?>
                hintContent: '<?=$item['NAME']?>',
                balloonContent: '<?=$item['NAME']?>'
            }, {
                iconLayout: 'default#image',
                iconImageHref: '<?=$item['PREVIEW_PICTURE']['SRC']?>',
                iconImageSize: [<?if($item['PROPERTY_SIZE_ICO_VALUE']) echo $item['PROPERTY_SIZE_ICO_VALUE']; else echo '20, 20';?>],
                iconImageOffset: [-5, -38]
            })<? if($counter_i == count($arResult)) { echo ";"; } else { echo ","; $counter_i++;} ?>

            <?

            } else {

            if(!empty($item['PROPERTY_TEMPLIMGPLACE_VALUE'])) {

                $preset = $item['PROPERTY_TEMPLIMGPLACE_VALUE'];

            } else {

                $preset = 'islands#governmentCircleIcon';

            }

            if(!empty($item['PROPERTY_COLORIMGPLACE_VALUE'])) {

                $iconColor = $item['PROPERTY_COLORIMGPLACE_VALUE'];

            } else {

                $iconColor = '#3b5998';

            }

            $body = '';

            $item["DETAIL_PICTURE"] = CFile::GetFileArray($item["DETAIL_PICTURE"]);

            if(!empty($item["DETAIL_PICTURE"])) $body .= "<img src=\"".$item['DETAIL_PICTURE']['SRC']."\"> <br/>";

            if(!empty($item['PROPERTY_CODEPLACE_VALUE']['TEXT'])) {

                $body = str_replace(array("\r\n", "\r", "\n"), '', $item['~PROPERTY_CODEPLACE_VALUE']['TEXT']);

            } else {

                if(!empty($item['PROPERTY_ADRESS_VALUE'])) $body .= '<b>'.Loc::getMessage('WEBMAXIMA_PLACE_ADRESS').'</b>: '.$item['PROPERTY_ADRESS_VALUE'].'<br />';

                if(!empty($item['PROPERTY_PHONE_VALUE'])) {

                    foreach ($arPhones[$item['ID']] as $key => $arPhone) {

                        if($key == (count($arPhones[$item['ID']])-1)) {

                            $Phone_string .= $arPhone;

                        } else {

                            $Phone_string .= $arPhone.', ';

                        }

                    }

                    $body .= '<b>'.Loc::getMessage('WEBMAXIMA_PLACE_PHONE').'</b>: '.$Phone_string.'<br />';

                    unset($Phone_string);

                }

                if(!empty($item['PROPERTY_TIMEWORK_VALUE'])) $body .= '<b>'.Loc::getMessage('WEBMAXIMA_PLACE_TIMEWORK').'</b>: '.$item['PROPERTY_TIMEWORK_VALUE'].'<br />';

            }

            ?>

            placemark<?=$item['ID']?> = new ymaps.Placemark([<?=$item['PROPERTY_COORDS_VALUE']?>], {
                balloonContentHeader: '<?=$item['NAME']?>',
                <?if(!empty($body)) echo "balloonContentBody: '".$body."',"?>
                balloonContent: '<?=$item['NAME']?>'
            }, {
                preset: '<?=$preset?>',
                iconColor: '<?=$iconColor?>'
            })<? if($counter_i == count($arResult)) { echo ";"; } else { echo ","; $counter_i++;} ?>


            <? } //endif?>

            <? } //endforeach?>

            <?

            foreach ($arResult as $item) {

                echo "myMap.geoObjects.add(placemark".$item['ID'].");";

            }

            if ($arParams['useScroll'] == 'false') {

                echo "myMap.behaviors.disable('scrollZoom');";

            } ?>
            var FullCustomBalloon = ymaps.templateLayoutFactory.createClass(
                '<div class="custom-balloon-wrapper">' +
                '<div class="custom-balloon">' +
                '<img width="250px" src="imgs/balun1.svg">' +
                '<div class="balun-content_wrapp" id="ig">' +
                '<div class="balun-content_top" > Ректорский домик</div>' +
                '<div class="balun-content_m" ><b>Тверская, 5А</b></div>' +
                '<div class="balun-content_b" >АНО Проектный офис по развитию туризма и гостеприимства Москвы</div>' +
                '</div>'+
                '</div>'+
                '</div>'
            );

            var placemark = new ymaps.Placemark([55.7569,37.6110], {
                title: 'Квартира',
                description: '3 комнаты, 70 м²',
                price: '5 000 000'
            }, {
                balloonLayout: FullCustomBalloon,
                // Убираем стандартные обертки
                balloonShadow: false,
                balloonStrokeWidth: 0
            });
            myMap.geoObjects.add(placemark);
            placemark.balloon.open();





        });

    </script>
   

    <div id="map" style="width: <?= $arParams['mapWidht'] ?>; height: <?= $arParams['mapHeight'] ?>"></div>

    <?
}
?>

