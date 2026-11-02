<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
//if ($_REQUEST['act']=='exc') {
$fieldName = "UF_EXCLUDE";
$userClass = new CUser;
$limit = 1000; // сколько пользователей за один запуск

$dbUsers = CUser::GetList(
    "id",
    "asc",
    ["ACTIVE" => "Y"],
    ["SELECT" => ["ID"], "LIMIT" => $limit]
);

$count = 0;
while ($arUser = $dbUsers->Fetch()) {
    if ($userClass->Update($arUser["ID"], [$fieldName => []])) {
        $count++;
    }
}

echo "Обработано: " . $count . " пользователей (лимит " . $limit . ").";

//}

?>

