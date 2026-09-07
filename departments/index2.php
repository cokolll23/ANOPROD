<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Оргструктура");

use Lab\Helpers\UsersHelpers as UH;
?>
<style>
    .scroll-wrapper {
    position: relative;
    margin: 20px 0;
    }

    .scroll-container {
    overflow-x: auto;
    overflow-y: hidden;
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: thin; /* для Firefox */
    }

    /* Скрываем стандартный скроллбар для Chrome/Safari */
    .scroll-container::-webkit-scrollbar {
    height: 6px;
    }

    .scroll-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
    }

    .scroll-container::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
    }

    .scroll-content {
    display: flex;
    gap: 20px;
    padding: 10px 0;
    }

    .scroll-item {
    flex-shrink: 0;
    width: 250px;
    height: 300px;
    background: #f5f5f5;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    }

    /* Стрелки */
    .scroll-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 40px;
    height: 40px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    font-size: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    opacity: 0;
    visibility: hidden;
    z-index: 10;
    }

    .left-arrow {
    left: 10px;
    }

    .right-arrow {
    right: 10px;
    }

    /* Показываем стрелки при наведении на обертку */
    .scroll-wrapper:hover .scroll-arrow {
    opacity: 1;
    visibility: visible;
    }

    .scroll-arrow:hover {
    background: rgba(0, 0, 0, 0.9);
    transform: translateY(-50%) scale(1.1);
    }
    </style>
    <div class="scroll-wrapper">
        <div class="scroll-container">
            <div class="scroll-content">
                <img src="departments.jpg">
            </div>
        </div>
        <button class="scroll-arrow left-arrow">←</button>
        <button class="scroll-arrow right-arrow">→</button>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const wrapper = document.querySelector('.scroll-wrapper');
        const container = wrapper.querySelector('.scroll-container');
        const leftArrow = wrapper.querySelector('.left-arrow');
        const rightArrow = wrapper.querySelector('.right-arrow');

        // Прокрутка при клике на стрелки
        if (leftArrow) {
            leftArrow.addEventListener('click', function() {
                container.scrollBy({
                    left: -300,
                    behavior: 'smooth'
                });
            });
        }

        if (rightArrow) {
            rightArrow.addEventListener('click', function() {
                container.scrollBy({
                    left: 300,
                    behavior: 'smooth'
                });
            });
        }

        // Опционально: скрываем стрелки в начале/конце скролла
        function toggleArrows() {
            const scrollLeft = container.scrollLeft;
            const maxScrollLeft = container.scrollWidth - container.clientWidth;

            if (leftArrow) {
                leftArrow.style.opacity = scrollLeft <= 10 ? '0' : '1';
                leftArrow.style.visibility = scrollLeft <= 10 ? 'hidden' : 'visible';
            }

            if (rightArrow) {
                rightArrow.style.opacity = maxScrollLeft - scrollLeft <= 10 ? '0' : '1';
                rightArrow.style.visibility = maxScrollLeft - scrollLeft <= 10 ? 'hidden' : 'visible';
            }
        }

        container.addEventListener('scroll', toggleArrows);
        window.addEventListener('resize', toggleArrows);
        toggleArrows(); // начальная проверка
    });
</script>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>