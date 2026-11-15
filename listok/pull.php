<?
define("BX_FORCE_DISABLE_SEPARATED_SESSION_MODE", true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

global $USER;

$isAdmin    = $USER->IsAdmin();
$isInGroup1 = $USER->IsAuthorized() && CSite::InGroup([1]);
if (!$isInGroup1 && !$isAdmin) {
    echo 0;
    die();
}
$bUSER_HAVE_ACCESS = false;

$filePath = $_SERVER['DOCUMENT_ROOT'] . '/upload/zp_listok.txt';

// Проверяем существование файла
if (!file_exists($filePath)) {
    echo 'Файл не найден';
    return;
}

// Читаем содержимое
$json = file_get_contents($filePath);
if ($json === false) {
    echo 'Не удалось прочитать файл';
    return;
}else{
    echo $json = file_get_contents($filePath);
    if ($json != '') {
        $log = date('Y-m-d H:i:s') . ' ZP listok log ' . $json;
        file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/ZP_listok_log.txt', $log . PHP_EOL, FILE_APPEND);
    }
}

// Очищаем файл: перезаписываем пустой строкой
if (file_put_contents($filePath, '') === false) {
    echo 'Не удалось очистить файл';
}

