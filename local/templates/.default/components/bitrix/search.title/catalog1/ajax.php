<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}
//pretty_print($arResult);
if (!empty($arResult['CATEGORIES']) && $arResult['CATEGORIES_ITEMS_EXISTS']):?>
	<table class="title-search-result">
		<?php foreach ($arResult['CATEGORIES'] as $category_id => $arCategory):?>
			<tr>
				<th class="title-search-separator">&nbsp;</th>
				<td class="title-search-separator">&nbsp;</td>
			</tr>
			<?php foreach ($arCategory['ITEMS'] as $i => $arItem):?>
			<tr>
				<?php if ($i == 0):?>
					<th>&nbsp;<?php echo $arCategory['TITLE']?></th>
				<?php else:?>
					<th>&nbsp;</th>
				<?php endif?>

				<?php if ($category_id === 'all1'):?>
					<td class="title-search-all">
                        <a class="smooth-link smooth1" href="#с<?php echo $arItem['ITEM_ID']?>">
                            <?php echo $arItem['NAME']?></a></td>
				<?php elseif (isset($arResult['ELEMENTS'][$arItem['ITEM_ID']])):
					$arElement = $arResult['ELEMENTS'][$arItem['ITEM_ID']];
				?>
					<td class="title-search-item">
                        <a  onclick="alert('ok'); return false;" class="smooth-link smooth" href="#с<?php echo $arItem['ITEM_ID']?>">

					</td>
				<?php elseif (isset($arItem['ICON'])):?>
					<td class="title-search-item">
                        <a onclick="scrollToJakor(); return false;" class=" smooth-link smooth2" href="#с<?php echo $arItem['ITEM_ID']?>">
                            <?php echo $arItem['NAME']?>
                        </a>
                    </td>

                <?php else:?>

				<?php endif;?>
			</tr>
			<?php endforeach;?>
		<?php endforeach;?>
		<tr>
			<th class="title-search-separator">&nbsp;</th>
			<td class="title-search-separator">&nbsp;</td>
		</tr>
	</table><div class="title-search-fader"></div>
<?php else:?>

<div class="noresult" style="padding:0 5% 1% 5%">
    <p>Такого термина пока нет в словаре </p>
    <p>Можно предложить его добавить — для этого заполните форму: </p>
    <a target="_blank" href="/news/vote_new.php?VOTE_ID=7" class="hero__btn">дополнить словарь</a>

</div>
<?php endif;
