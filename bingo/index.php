<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Бинго");
?>
    <style>
        img {
            display: block;
            margin: 0 auto;
        }
    </style>

    <img src="summer-bingo.jpg"
         usemap="#summer-bingo"
         alt="Летнее бинго" width="820"
         height="1024"">

    <map name="summer-bingo">
        <!-- 1 ряд -->
        <area shape="rect" coords="25,203,160,339" href="#" alt="Сделать лимонад/коктейль">
        <area shape="rect" coords="167,203,303,339" href="#" alt="Устроить пикник/пожарить шашлыки">
        <area shape="rect" coords="309,203,445,339" href="#" alt="Встретить рассвет">
        <area shape="rect" coords="452,203,588,339" href="#" alt="Сходить с коллегами на ланч">
        <area shape="rect" coords="594,203,729,339" href="#" alt="Сходить на выставку/концерт/в музей">

        <!-- 2 ряд -->
        <area shape="rect" coords="25,345,160,481" href="#" alt="Покататься на сапе/каяке">
        <area shape="rect" coords="167,345,303,481" href="#" alt="Начать читать новую книгу">
        <area shape="rect" coords="309,345,445,481" href="#" alt="Пересмотреть любимый фильм">
        <area shape="rect" coords="452,345,588,481" href="#" alt="Отдохнуть у воды">
        <area shape="rect" coords="594,345,729,481" href="#" alt="Попробовать сезонные фрукты">

        <!-- 3 ряд -->
        <area shape="rect" coords="25,487,160,622" href="#" alt="Сделать фото в красивом месте">
        <area shape="rect" coords="167,487,303,622" href="#" alt="Посетить мероприятие Московского чаепития">
        <area shape="rect" coords="309,487,445,622" href="#" alt="Поделиться лучшим событием лета">
        <area shape="rect" coords="452,487,588,622" href="#" alt="Посетить мероприятие фестиваля Усадьбы Москвы">
        <area shape="rect" coords="594,487,729,622" href="#" alt="Позавтракать на веранде/террасе">

        <!-- 4 ряд -->
        <area shape="rect" coords="25,629,160,764" href="#" alt="Проводить закат">
        <area shape="rect" coords="167,629,303,764" href="#" alt="Посетить экскурсию">
        <area shape="rect" coords="309,629,445,764" href="#" alt="Попробовать новое кафе или кофейню">
        <area shape="rect" coords="452,629,588,764" href="#" alt="Попробовать что-то новое">
        <area shape="rect" coords="594,629,729,764" href="#" alt="Стать свидетелем грозы">

        <!-- 5 ряд -->
        <area shape="rect" coords="25,771,160,906" href="#" alt="Погулять в обеденный перерыв">
        <area shape="rect" coords="167,771,303,906" href="#" alt="Съесть любимое мороженое">
        <area shape="rect" coords="309,771,445,906" href="#" alt="Погулять в лесу/парке">
        <area shape="rect" coords="452,771,588,906" href="#" alt="Заняться спортом на улице">
        <area shape="rect" coords="594,771,729,906" href="#" alt="Побывать в новом месте">

        <!-- Кнопка снизу -->
        <area shape="rect" coords="200,937,554,989" href="https://corp-portal.welcome.moscow/news/predlagaemsobratkollektsiyuyarkikhletnikhvpechatleniychtobyneupustitizapomnitleto2026/" alt="Правила и условия участия">
    </map>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>