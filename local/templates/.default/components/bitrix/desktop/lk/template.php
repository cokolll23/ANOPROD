<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

\Bitrix\Main\UI\Extension::load(['ui.design-tokens']);
$APPLICATION->SetAdditionalCSS('/bitrix/themes/.default/pubstyles.css');
pretty_print($arResult);

$id = isset($_GET['user_id']) ? $_GET['user_id'] : null;

$user_id = intval($_GET['user_id']);

$arUserFields = array(
        "ID",
        "LOGIN",
        "EMAIL",
        "NAME",
        "LAST_NAME",
        "SECOND_NAME",
        "PERSONAL_PHONE",
        "PERSONAL_CITY",
        "PERSONAL_BIRTHDAY",
        "WORK_POSITION",
        "UF_*" // Все пользовательские поля
);

$rsUser = CUser::GetList(
        $by = "ID",
        $order = "ASC",
        array("ID" => $user_id),
        array("SELECT" => $arUserFields)
);
$arUser = $rsUser->Fetch();

$arUser['FIO'] = $arUser['LAST_NAME'] . ' ' . $arUser['NAME'] . ' ' . $arUser['SECOND_NAME'];
$departmentId = $arUser['UF_DEPARTMENT'][0];
pretty_print($arUser, '$rsUser');

$dept = CIBlockSection::GetByID($departmentId)->Fetch();
$deptName = $dept['NAME'];

if (CUser::IsOnLine($arUser['ID'])) {
    $isOnline = 1;
} else {
    $isOnline = 0;
}

$fileId = $arUser['PERSONAL_PHOTO'];
$imgPath = CFile::GetPath($fileId);

$arMonthes=[
        'января',
        'февраля',
        'марта',
        'апреля',
        'мая',
        'июня',
        'июля',
        'августа',
        'сентября',
        'октября',
        'ноября',
        'декабря',
];
$arBirthDay=explode('.',$arUser['PERSONAL_BIRTHDAY']);

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    :root {
        --bg: #f6f6f6;
        --card: #ffffff;
        --text: #1e1e1e;
        --muted: #7a7a7a;
        --border: #ececec;
        --green: #b7dc63;
        --red: #e31c24;
        --shadow: 0 6px 18px rgba(0, 0, 0, .05);
        --radius: 22px;
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;

        background: var(--bg);
        color: var(--text);
    }

    .page {
        padding: 24px 0;
    }

    .page-title {
        font-size: clamp(24px, 2vw, 32px);
        font-weight: 500;
        margin: 0 0 18px;
        color: #444;
    }

    .sidebar-card,
    .content-card,
    .service-block {
        background: var(--card);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
    }

    .sidebar-card {
        padding: 20px;
        margin-bottom: 22px;
    }

    .content-card {
        padding: 22px;
        margin-bottom: 22px;
    }

    .service-block {
        background: #b7dc63;
        padding: 22px;
        min-height: 260px;
    }

    .role-select {
        border: 1px solid #d5d5d5;
        border-radius: 999px;
        padding: 8px 16px;
        background: #fff;
        font-size: 14px;
        line-height: 1;
    }

    .online {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #7f7f7f;
        font-size: 14px;
    }

    .online::before {
        content: "";
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #b7dc63;
        display: inline-block;
    }

    .avatar-wrap {
        display: flex;
        justify-content: center;
        margin-top: 14px;
    }

    .avatar {
        width: 185px;
        height: 185px;
        border-radius: 50%;
        object-fit: cover;
        background: #ddd;
    }

    .section-title {
        font-size: 24px;
        font-weight: 700;
        margin: 0 0 12px;
    }

    .name-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .name {
        font-size: 20px;
        font-weight: 700;
        margin: 0;
    }

    .subtitle {
        color: var(--muted);
        margin: 6px 0 0;
        font-size: 15px;
    }

    .pill-btn {
        border: 1px solid #cfcfcf;
        background: #fff;
        border-radius: 999px;
        padding: 8px 16px;
        font-size: 14px;
        white-space: nowrap;
    }

    .info-list {
        display: grid;
        grid-template-columns: 220px 1fr;
        gap: 14px 30px;
        margin-top: 18px;
        font-size: 15px;
    }

    .info-label {
        color: #8a8a8a;
    }

    .info-value {
        color: #4a4a4a;
        font-weight: 500;
    }

    .more-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 18px;
        color: var(--red);
        text-decoration: none;
        font-size: 14px;
        border-bottom: 1px dotted rgba(227, 28, 36, .5);
        padding-bottom: 2px;
    }

    .block-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 18px;
    }

    .block-head h3 {
        margin: 0;
        font-size: 22px;
        font-weight: 700;
    }

    .arrow {
        font-size: 24px;
        line-height: 1;
        color: #333;
    }

    .subtabs {
        display: flex;
        gap: 18px;
        margin-bottom: 18px;
        font-size: 14px;
    }

    .subtabs a {
        color: rgba(0, 0, 0, .55);
        text-decoration: none;
    }

    .subtabs a.active {
        color: #1f1f1f;
        font-weight: 600;
    }

    .substitute-empty {
        display: flex;
        align-items: center;
        gap: 16px;
        color: #555;
        line-height: 1.5;
    }

    .red-icon {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: var(--red);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        flex: 0 0 auto;
        font-size: 22px;
    }

    .add-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 18px;
        background: var(--red);
        color: #fff;
        border: 0;
        border-radius: 999px;
        padding: 10px 20px;
        font-weight: 600;
    }

    .service-items {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
        margin-top: 18px;
    }

    .service-item {
        min-height: 120px;
        border-radius: 18px;
        background: rgba(255, 255, 255, .78);
        padding: 16px;
    }

    @media (max-width: 991.98px) {
        .info-list {
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .service-items {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 575.98px) {
        .page {
            padding: 14px 0;
        }

        .sidebar-card,
        .content-card,
        .service-block {
            border-radius: 18px;
            padding: 16px;
        }

        .avatar {
            width: 150px;
            height: 150px;
        }

        .name {
            font-size: 18px;
        }

        .section-title,
        .block-head h3 {
            font-size: 18px;
        }

        .substitute-empty {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="page">
    <div class="container-fluid px-3 px-md-4 px-xl-5">
        <div class="row g-4">
            <div class="col-12 col-lg-4 col-xl-3">
                <div class="sidebar-card">
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <button class="role-select">Администратор</button>
                        <? if ($isOnline == 1): ?>
                            <span class="online">В сети</span>
                        <? elseif ($isOnline == 0): ?>
                            <span class="ofline"> Не в сети</span>
                        <? endif; ?>
                    </div>

                    <div class="avatar-wrap">

                        <img class="avatar"
                             src="<?= $imgPath ?>"
                             alt="Фото профиля">
                    </div>
                </div>

                <div class="sidebar-card">
                    <div class="block-head">
                        <h3>Замещающие</h3>
                        <span class="arrow">›</span>
                    </div>

                    <div class="substitute-empty">
                        <div class="red-icon">👤</div>
                        <div>
                            У вас пока нет замещающих. Добавьте замещающих на необходимый период и эта информация будет
                            доступна вашим коллегам.
                        </div>
                    </div>

                    <button class="add-btn">Добавить <span>＋</span></button>
                </div>

                <div class="sidebar-card">
                    <div class="block-head">
                        <h3>Компетенции</h3>
                    </div>
                    <div class="text-muted">Содержимое блока</div>
                </div>
            </div>

            <div class="col-12 col-lg-8 col-xl-9">
                <div class="content-card">
                    <div class="name-row">
                        <div>
                            <p class="name"><?= $arUser['FIO']; ?></p>
                            <p class="subtitle"><?= $arUser['PERSONAL_PROFESSION']; ?></p>
                        </div>
                        <!-- <button class="pill-btn">Указать Статус</button>-->
                    </div>
                </div>

                <div class="content-card">
                    <h2 class="section-title">Контактная информация</h2>

                    <div class="info-list">
                        <div class="info-label">Подразделение</div>
                        <div class="info-value"><?= $deptName; ?></div>

                        <div class="info-label">Город</div>
                        <div class="info-value"><?= $arUser['PERSONAL_CITY']; ?></div>

                        <div class="info-label">Контактный e-mail</div>
                        <div class="info-value"><?= $arUser['EMAIL']; ?></div>

                        <div class="info-label">Рабочий телефон</div>
                        <div class="info-value"><?= $arUser['WORK_PHONE']; ?> </div>

                        <div class="info-label">Мессенджеры</div>
                        <div class="info-value"></div>
                    </div>

                    <div class="expandable-card">
                        <div class="action-area">
                            <button class="btn-details" id="detailsButton">
                                <span>Подробная информация</span>
                                <i class="arrow-icon">▼</i>
                            </button>
                        </div>

                        <!-- РАЗВОРАЧИВАЮЩИЙСЯ БЛОК с контентом -->
                        <div class="expandable-content" id="expandableContent">


                            <div class="info-list">
                                <div class="info-label">День рождения:</div>
                                <div class="info-value"><?= $arBirthDay[0].' '.$arMonthes[$arBirthDay[1]-1]?></div>
                                <div class="info-label">Пол:</div>
                                <div class="info-value"><?= $arUser['PERSONAL_GENDER']?></div>
                            </div>
                        </div>

                    </div>

                    <!--<a href="#" class="more-link">Подробная информация <span>▼</span></a>-->
                </div>

                <div class="content-card" style="height: 60px;"></div>

                <div class="service-block">
                    <div class="block-head">
                        <h3>Мои сервисы</h3>
                        <span class="arrow">›</span>
                    </div>

                    <div class="subtabs">
                        <a href="#" class="active">Основное</a>
                        <a href="#">Избранное</a>
                    </div>

                    <div class="service-items">
                        <div class="service-item"></div>
                        <div class="service-item"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<script>
    $(document).ready(function () {

        // Получаем элементы
        const $button = $('#detailsButton');
        const $content = $('#expandableContent');

        // Флаг состояния (открыт/закрыт) — можно также проверять по классу open у контента
        let isOpen = false;

        // Функция для плавного закрытия/открытия с использованием max-height анимации,
        // но т.к. используем CSS-переход max-height, нам достаточно добавить/удалить класс .open
        // Однако чтобы динамически менять текст кнопки и классы — делаем обработчик.

        function toggleExpand() {
            if (isOpen) {
                // Закрываем: удаляем класс open у блока с контентом
                $content.removeClass('open');
                // Меняем текст кнопки на исходный
                $button.find('span:first-child').text('Подробная информация');
                // Убираем класс open у кнопки (чтобы стрелка не была повернута)
                $button.removeClass('open');
                isOpen = false;
            } else {
                // Открываем: добавляем класс open
                $content.addClass('open');
                // Меняем текст кнопки на "Скрыть детали" (или другой вариант, лучше информативно)
                $button.find('span:first-child').text('Скрыть детали');
                // Добавляем класс open кнопке для анимации стрелки
                $button.addClass('open');
                isOpen = true;
            }
        }

        // Обработчик клика по кнопке
        $button.on('click', function (e) {
            e.preventDefault();
            toggleExpand();
        });

        // Дополнительная опция: при клике на документ не закрываем, чтобы случайно не скрыть,
        // но для удобства если хотим закрыть при клике вне (опционально, раскомментируйте если нужно)
        // Однако по заданию требуется "при клике на Подробная информация", так что базовая логика выше полностью выполняет требование.
        // Но заодно добавим "доступность" и плавность: при открытии скроллим не обязательно,
        // но если контент длинный – оставляем как есть, красиво.

        // Для того чтобы избежать ошибки, если контент динамически менялся бы, но у нас статика.
        // Также обработаем случай повторных быстрых кликов: CSS-переходы защищены от конфликтов,
        // но toggle хорошо работает.

        // Небольшая дополнительная фишка: если пользователь открыл блок и его содержимое немного
        // выходит за пределы видимости, можно мягко проскроллить, но это не обязательно.
        // Но для лучшего UX, сделаем так, чтобы при открытии, если блок не помещается в видимой области,
        // плавно подскроллить до начала блока (немного эстетики).

        // Функция плавного скролла к карточке при открытии (только если блок открылся и видимость не полная)
        // Но это может конфликтовать с привычкой пользователя, добавим изящно, но без навязчивости.
        // Реализуем скролл только в случае, если блок расширяется и нижняя часть контента уходит за экран.
        // В реальных проектах часто полезно. Сделаем аккуратное дополнение: после открытия проверяем,
        // если элемент контента частично вне зоны видимости, то прокручиваем к началу карточки (или к блоку)

        function smoothScrollIfNeeded() {
            if (!isOpen) return;
            // проверяем видимость нижней части контента
            const $card = $('.expandable-card');
            const cardRect = $card[0].getBoundingClientRect();
            const viewportHeight = window.innerHeight;
            // Если нижняя граница карточки за пределами экрана больше чем на 50px, прокрутим плавно
            if (cardRect.bottom > viewportHeight - 30) {
                $('html, body').animate({
                    scrollTop: $card.offset().top - 20
                }, 300);
            }
        }

        // Переопределим toggleExpand с вызовом скролла после открытия
        // перезапишем функцию, сохранив базовую логику, но добавим скролл после анимации
        // поскольку анимация max-height длится 0.65s, вызовем скролл с задержкой, чтобы DOM обновился
        const originalToggle = toggleExpand;
        window.toggleExpand = function () {
            originalToggle();
            if (isOpen) {
                // Небольшая задержка для завершения перестройки layout
                setTimeout(() => {
                    smoothScrollIfNeeded();
                }, 100);
            }
        };

        // Заменим обработчик события, чтобы использовать улучшенную версию
        // отвяжем старый обработчик и повесим новый с обновлённой функцией
        $button.off('click');
        $button.on('click', function (e) {
            e.preventDefault();
            window.toggleExpand();
        });

        // Обновим переменную, чтобы при загрузке страницы соответствовало состоянию закрытого блока
        // синхронизируем флаг isOpen изначально: false, блок закрыт, класс open отсутствует, стрелка не повернута
        // убедимся, что кнопка не имеет класса open и текст корректен
        $button.removeClass('open');
        $button.find('span:first-child').text('Подробная информация');
        $content.removeClass('open');
        isOpen = false;

        // Заодно обеспечим, чтобы при изменении размера окна браузера в открытом состоянии ничего не ломалось,
        // можно повторно проверить скролл? Но для простоты и элегантности оставим так.

        // Дополнительная эстетика: если пользователь нажимает на ссылки внутри блока, чтобы не закрывалось случайно (прекрасно работает)
        // Плюс можно добавить hover-эффекты
        console.log('Готово: разворачивающийся блок с jQuery и CSS анимацией');
    });
</script>