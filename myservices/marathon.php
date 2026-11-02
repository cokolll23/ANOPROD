<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$fieldName = "UF_MARATHON";
$value = "5";

// Получаем список активных пользователей
$rsUsers = CUser::GetList(
    $by = "id",
    $order = "asc",
    ["ACTIVE" => "Y"],
    ["SELECT" => [$fieldName]]
);

$count = 0;
while ($arUser = $rsUsers->Fetch()) {
    $userId = $arUser["ID"];

    // Проверяем, отличается ли текущее значение от нужного (чтобы не писать лишнее)
    if ($arUser[$fieldName] !== $value) {
        $user = new CUser;
        $fields = [$fieldName => $value];
        if ($user->Update($userId, $fields)) {
            $count++;
        } else {
            echo "Ошибка обновления для пользователя ID {$userId}: " . $user->LAST_ERROR . "<br>";
        }
    }
}

echo "Обновлено пользователей: " . $count;


?>

