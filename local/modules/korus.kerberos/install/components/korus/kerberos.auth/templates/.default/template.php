<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
\CJSCore::Init(['jquery3']);
?>
<script>
    var servers = <?=\CUtil::PhpToJSObject($arResult['SERVERS']);?>,
        backurl = '<?=$arResult['BACKURL'];?>';
</script>
