<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

header('Content-Type: application/json; charset=utf-8');

$result = [
    'success' => false,
    'isExcluded' => false
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'checkExclude') {
    global $USER;
    $currentUserId = $USER->GetID();

    if ($currentUserId > 0 && isset($_POST['userId'])) {
        $checkUserId = (int)$_POST['userId'];

        // Получаем UF_EXCLUDE для текущего пользователя
        $rsUser = CUser::GetByID($currentUserId);
        $arUser = $rsUser->Fetch();

        if ($arUser && isset($arUser['UF_EXCLUDE']) && is_array($arUser['UF_EXCLUDE'])) {
            // UF_EXCLUDE — множественное поле (строки), приводим к int для сравнения
            $excludeIds = array_map('intval', $arUser['UF_EXCLUDE']);
            $result['isExcluded'] = in_array($checkUserId, $excludeIds, true);
        }

        $result['success'] = true;
    }
}

echo json_encode($result);
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php');
?>

