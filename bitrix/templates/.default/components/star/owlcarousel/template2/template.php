<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if ($arResult["JQUERY"] == "Y") CJSCore::Init(array('jquery'));
?>

<div class="star_OWLCAROUSEL_outer owl-theme">
    <div id="star_OWLCAROUSEL" data-id="0" class="owl-carousel">
        <? foreach ($arResult["ITEMS"] as $item): ?>

            <div class="star_OWLCAROUSEL_item">
                <? if (isset($item["LINK"]) && !empty($item["LINK"]) && $arParams['LINK'] == 'Y'): ?><a
                        href="<?= $item["LINK"] ?>" <?= $arResult["NEW_WINDOW"] ?>><? endif; ?>
                    <img src="<?= $item["PICTURE"] ?>" title="<?= $item["NAME"] ?>"/>


                    <? if (isset($item["LINK"]) && !empty($item["LINK"]) && $arParams['LINK'] == 'Y'): ?>
                </a><? endif; ?>
            </div>

        <? endforeach; ?>
    </div>
</div>

<script>

    soc_id = 0;

    while (document.querySelector(".owl-carousel[data-id='" + soc_id + "']")) soc_id++;
    document.querySelector(".owl-carousel[data-id='0']").dataset.id = soc_id;
    document.querySelector(".owl-carousel[data-id='" + soc_id + "']").id = "star_OWLCAROUSEL_" + soc_id;

    var owl = $("#star_OWLCAROUSEL_" + soc_id);

    owl.on('changed.owl.carousel', function (event) {
        // Получаем индекс текущего активного слайда
        var currentIndex = event.item.index;
        // Получаем количество всех слайдов
        var itemsCount = event.item.count;
        // Вычисляем индекс следующего слайда (с учетом loop)
        var nextIndex = (currentIndex + 1) % itemsCount;
        // Получаем объект следующего слайда
        var nextSlide = $(event.target).find('.owl-item').eq(nextIndex).find('.item');
        // Получаем значение data-id
        var dataId = nextSlide.data('id');
        var obj = nextSlide.prevObject.prevObject;
        var nuzhSlideObj = nextSlide.prevObject.prevObject[currentIndex];
       var txt = $(nuzhSlideObj).find('img').attr('title');
       $('#addr').text(txt);
    })

    owl.owlCarousel({
        nav: <?=$arResult["CONTROLS"]?>,
        loop: <?=$arResult["LOOP"]?>,
        margin: <?=$arResult["MARGIN"]?>,
        autoplay: <?=$arResult["AUTO"]?>,
        autoplayTimeout: <?=$arResult["PAUSE"] * 1000?>,
        dots: false,
        responsive: {
            500: {
                items: <?=$arResult["COUNT_SLIDES"]?>
            },
            0: {
                items: 1
            },
        }
    });

    //owl-item active
    /*$.each($('.owl-item.active'), function (i,v)){

        });*/


</script>