<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>

<div class="branch-grid">
    <?php foreach ($arResult['ITEMS'] as $item): ?>
        <section class="branch-grid-item">
            <a href="<?= $item['DETAIL_URL'] ?>">
                <div class="branch-grid-item-image-wrapper">
                    <div class="branch-grid-item-image"
                         style="background-image: url('<?= $item['DETAIL_PICTURE_URL']; ?>');"></div>
                </div>
            </a>

            <div class="branch-grid-item-content">
                <a href="<?= $item['DETAIL_URL'] ?>" class="branch-grid-item-title base-link ui-link ui-link-dark"><?= $item['NAME'] ?></a>
                <?php if ($item['CURRENT_TIME']): ?>
                    <div class="branch-grid-item-local-time"><?= $item['CURRENT_TIME'] ?></div>
                <?php endif; ?>
            </div>
        </section>
    <?php endforeach; ?>
</div>
