<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Оргструктура");

use Lab\Helpers\UsersHelpers as UH;

?>
<style>
    .horizontal-scroll {
        overflow-x: auto;    /* Включаем горизонтальный скролл */
        cursor: grab;        /* Визуально показываем, что элемент можно "схватить" */
        white-space: nowrap; /* Запрещаем перенос строк (для inline-блоков) */
    }

    /* Для Webkit-браузеров (Chrome, Safari, Edge) можно спрятать полосу прокрутки,
       чтобы сохранить эстетику, но не ломать функционал */
    .horizontal-scroll::-webkit-scrollbar {
        height: 8px;
        background-color: #f1f1f1;
    }
</style>
<div class="horizontal-scroll">
    <img src="departments.jpg">
</div>
    <script>
        // Активируем функцию после полной загрузки DOM
        BX.ready(function () {
            // Находим наш контейнер. Замените класс на свой.
            const scrollContainer = document.querySelector('.horizontal-scroll');

            if (!scrollContainer) return;

            let isDragging = false;   // Флаг, указывающий, что "захват" активен
            let startX;               // Начальная позиция курсора по X
            let scrollLeft;          // Начальная позиция скролла контейнера

            // 1. Зажимаем кнопку мыши на контейнере
            scrollContainer.addEventListener('mousedown', (e) => {
                isDragging = true;
                startX = e.pageX - scrollContainer.offsetLeft; // Запоминаем позицию мыши
                scrollLeft = scrollContainer.scrollLeft;       // Запоминаем позицию скролла
                scrollContainer.style.cursor = 'grabbing';     // Меняем курсор на "схвачено"
                scrollContainer.style.userSelect = 'none';     // Отключаем выделение текста
            });

            // 2. Двигаем мышь (событие на всем окне, чтобы не "вылететь" за пределы контейнера)
            window.addEventListener('mousemove', (e) => {
                if (!isDragging) return; // Если не в режиме перетаскивания — ничего не делаем
                e.preventDefault();      // Отключаем стандартное выделение

                // Вычисляем новое положение скролла: старое + (текущая позиция мыши - начальная)
                const x = e.pageX - scrollContainer.offsetLeft;
                const walk = (x - startX); // Дистанция, на которую сместился курсор
                scrollContainer.scrollLeft = scrollLeft - walk;
            });

            // 3. Отпускаем кнопку мыши
            window.addEventListener('mouseup', () => {
                if (!isDragging) return;
                isDragging = false;
                scrollContainer.style.cursor = 'grab';      // Возвращаем курсор
                scrollContainer.style.userSelect = '';      // Включаем выделение обратно
            });
        });
    </script>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>