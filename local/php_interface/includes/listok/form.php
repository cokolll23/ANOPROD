<?php
// ============================================================
// 2) Отображение страницы
// ============================================================
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
$currentYear = (int)date('Y');
global $USER;

if (in_array(12, $USER->GetUserGroupArray())) {
   echo $blGr12 = 1;
} else {
   echo $blGr12 = 0;
}
$monthNames = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
        'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
?>
<style>
    .months-open-btn {
        display: inline-block;
        padding: 12px 24px;
        background: #2fc7f7;
        color: #fff;
        border: 0;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px
    }

    .months-open-btn:hover {
        background: #1cb6e6
    }

    .months-popup {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center
    }

    .months-popup.is-open {
        display: flex;
        font-family: "IBM Plex Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

    .months-popup__overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .5)
    }

    .months-popup__content {
        position: relative;
        background: #fff;
        width: 100%;
        max-width: 520px;
        padding: 28px;
        border-radius: 10px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, .2);
        max-height: 92vh;
        overflow: auto
    }

    .months-popup__content h2 {
        margin: 0 0 20px;
        font-size: 20px
    }

    .months-field {
        margin-bottom: 18px
    }

    .months-field > label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600
    }

    .months-field .req {
        color: #e00
    }

    .months-field select {
        width: 100%;
        padding: 10px;
        border: 2px solid #ddd;
        border-radius: 6px;
        font-size: 15px
    }

    .months-grid {
        display: grid;
        grid-template-columns:repeat(4, 1fr);
        gap: 8px
    }

    .month-card input {
        position: absolute;
        opacity: 0;
        pointer-events: none
    }

    .month-card span {
        display: block;
        padding: 12px 6px;
        text-align: center;
        border: 2px solid #e3e3e3;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        transition: .15s;
        user-select: none
    }

    .month-card span:hover {
        border-color: #ff4854
    }

    .month-card input:checked + span {
        background: #e30613;
        border-color: #e30613;
        color: #fff
    }

    .months-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 22px
    }

    .months-actions button {
        padding: 11px 22px;
        border-radius: 6px;
        border: 0;
        cursor: pointer;
        font-size: 15px
    }

    .months-actions .btn-cancel {
        background: #eee;
        color: #333
    }

    .months-actions .btn-submit {
        background: #e30613;
        color: #fff
    }

    .months-actions .btn-submit:disabled {
        opacity: .6;
        cursor: not-allowed
    }

    .months-result {
        margin-top: 14px;
        font-size: 14px;
        min-height: 20px
    }

    .months-result.error {
        color: #d00
    }

    .months-result.success {
        color: #1a8f3a
    }

    .month-card.is-disabled span {
        opacity: .35;
        cursor: not-allowed;
        border-color: #eee
    }

    .month-card.is-disabled span:hover {
        border-color: #eee
    }

    .h2 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 20px;
        line-height: 24px;
    }

    #months-form {
        margin-top: 20px
    }

</style>
<div id="months-popup" class="months-popup">
    <div class="months-popup__overlay" data-close="1"></div>
    <div class="months-popup__content">

        <div class="h2" style="color: black">
            Выберите закрытый расчетный период, за который заработная уже выплачена.
        </div>
        <div class="h2-dscr">
            Расчетный лист будет направлен на корпоративную почту в течение 10 минут. Заказать его можно на период
            работы в Организации.
        </div>


        <form id="months-form" novalidate>
            <input type="hidden" name="sessid" value="<?= bitrix_sessid() ?>">
            <input type="hidden" name="action" value="save_months">

            <div class="months-field">
                <label>Год <span class="req">*</span></label>
                <select name="year" required>
                    <?php for ($y = $currentYear; $y >= $currentYear - 8; $y--): ?>
                        <option value="<?= $y ?>" <?= $y === $currentYear ? 'selected' : '' ?>><?= $y ?></option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="months-field">
                <label>Месяцы <span class="req">*</span> <small style="font-weight:400;color:#888">(можно выбрать
                        несколько)</small></label>
                <div class="months-grid">
                    <?php foreach ($monthNames as $i => $name):
                        $m = $i + 1;
                        // месяц доступен, если наступило 7 число следующего месяца
                        $unlocked = (time() >= mktime(0, 0, 0, $m + 1, 7, $currentYear));
                        ?>
                        <label class="month-card">
                            <input type="checkbox" name="months[]" value="<?= $m ?>"
                                   data-unlocked="<?= $unlocked ? '1' : '0' ?>">
                            <span <?= !$unlocked ? 'title="Откроется после 7 числа следующего месяца"' : '' ?>>
                <?= htmlspecialcharsbx($name) ?>
            </span>
                        </label>
                    <?php endforeach; ?>
                </div>

            </div>

            <div class="months-actions">
                <button type="button" class="btn-cancel" data-close="1">Отмена</button>
                <button id="btn-sbmt" style="background-color: #e30613;" type="submit" class="btn-submit">Заказать
                </button>
            </div>

            <div id="months-result" class="months-result"></div>
        </form>
    </div>
</div>
<script>



    (function () {
        const popup = document.getElementById('months-popup');
        const form = document.getElementById('months-form');
        const result = document.getElementById('months-result');
        const submit = form.querySelector('.btn-submit');

        function open() {
            popup.classList.add('is-open');
        }

        function close() {
            popup.classList.remove('is-open');
            result.textContent = '';
            result.className = 'months-result';
        }

        //document.getElementById('months-open-btn').addEventListener('click', open);
        $('body').on('click', '#my-injected-btn', open);

        popup.addEventListener('click', function (e) {
            if (e.target.dataset.close) close();
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && popup.classList.contains('is-open')) close();
        });

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const year = form.querySelector('select[name="year"]').value;
            const months = form.querySelectorAll('input[name="months[]"]:checked');

            result.className = 'months-result';

            if (!year) {
                result.classList.add('error');
                result.textContent = 'Выберите год';
                return;
            }
            if (months.length === 0) {
                result.classList.add('error');
                result.textContent = 'Выберите хотя бы один месяц';
                return;
            }

            const formData = new FormData(form);
            submit.disabled = true;
            result.textContent = 'Отправка...';

            // fetch(window.location.pathname, {
            fetch('/local/php_interface/includes/listok/ajaxn.php', {
                method: 'POST',
                body: formData,
                headers: {'X-Requested-With': 'XMLHttpRequest'},
                credentials: 'same-origin'
            })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        result.className = 'months-result success';
                        result.textContent = 'Ваш запрос отправлен';// + data.saved;
                        form.reset();
                        setTimeout(close, 1500);
                    } else {
                        result.className = 'months-result error';
                        result.textContent = data.error || 'Ошибка';
                    }
                })
                .catch(() => {
                    result.className = 'months-result error';
                    result.textContent = 'Ошибка запроса';
                })
                .finally(() => {
                    submit.disabled = false;
                });
        });
        const currentYearJs = <?= $currentYear ?>;

        function updateMonthAvailability(year) {
            form.querySelectorAll('.month-card').forEach(function (card) {
                const input = card.querySelector('input');
                const locked = (parseInt(year, 10) === currentYearJs && input.dataset.unlocked === '0');
                input.disabled = locked;
                card.classList.toggle('is-disabled', locked);
                if (locked) input.checked = false;
            });
        }

        form.querySelector('select[name="year"]').addEventListener('change', function () {
            updateMonthAvailability(this.value);
        });

        updateMonthAvailability(form.querySelector('select[name="year"]').value);

    })();
</script>
<? if ($blGr12):?>
<script>
    // todo кнопка на ЛК ЗП листок заказать
    function injectButton() {
        const targetSelector = 'article.kt-interests hidden';

        //alert( <?= $blGr12;?>);

        function tryInjectButton() {
            const target = document.querySelector(targetSelector);
            const parentCol = target?.closest('.col-12');

            if (!parentCol || document.getElementById('my-injected-container')) {
                return;
            }

            // Внешний контейнер
            const colDiv = document.createElement('div');
            colDiv.id = 'my-injected-container';
            colDiv.className = 'col-12';



            // Внутренняя обертка
            const wrapperDiv = document.createElement('div');
            wrapperDiv.className = 'kt-widget-wrapper';


            const divH2 =  document.createElement('div');
            divH2.textContent = 'Заказать расчетный лист';
            divH2.className = 'kt-widget-wrapper_title';
            wrapperDiv.appendChild(divH2);

            const wrP =  document.createElement('div');
            wrP.textContent = 'Здесь вы можете заказать расчетный листок за нужный период';
            wrP.className = 'kt-widget-wrapper_dscr';
            wrapperDiv.appendChild(wrP);

            // Кнопка
            const btn = document.createElement('a');
            btn.id = 'my-injected-btn';
            btn.type = 'button';

            btn.className = 'q-btn q-btn-item non-selectable no-outline q-btn--unelevated q-btn--rectangle q-btn--rounded q-btn--actionable q-focusable q-hoverable q-btn--no-uppercase kt-btn kt-btn--primary-theme';

            btn.addEventListener('click', () => {
                console.log('Кнопка нажата!');
            });
            const span = document.createElement('span');
            span.textContent = 'Заказать';
            span.className = 'inner-btn'
            btn.appendChild(span);
            wrapperDiv.appendChild(btn);
            colDiv.appendChild(wrapperDiv);

            // Вставляем после родительского .col-12, а не после article
            parentCol.after(colDiv);
        }

        const observer = new MutationObserver(tryInjectButton);

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });

        // Проверяем сразу — нужный блок уже может быть на странице
        tryInjectButton();
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', injectButton, {once: true});
    } else {
        injectButton();
    }
</script>
<?endif;?>