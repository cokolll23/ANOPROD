<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("testaaa");
?>
<?php
use Bitrix\Main\Loader;
use Bitrix\Sale\Order;
use Bitrix\Main\Entity;

Loader::includeModule('sale');

$userId = $GLOBALS['USER']->GetID();

if ($userId > 0) {
    $orders = Order::getList([
        'select' => [
            'ID',
            'PRICE'
        ],
        'filter' => [
            'USER_ID' => $userId,
            // Можно добавить дополнительные фильтры:
            // '>=DATE_INSERT' => (new DateTime())->modify('-1 month'), // За последний месяц
             '!CANCELED' => 'Y', // Только не отмененные
        ],
        'order' => [],
    ]);

    while ($order = $orders->fetch()) {
        // Обработка каждого заказа
       $TotalPrice += $order['PRICE'] ;
    }
    echo $TotalPrice;
}
?>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>