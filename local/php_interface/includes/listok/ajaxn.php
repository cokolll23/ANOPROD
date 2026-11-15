<?php
// ============================================================
// 1) AJAX-обработчик (до подключения шапки сайта)
// ============================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'save_months') {
    require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

    header('Content-Type: application/json; charset=UTF-8');

    // --- проверка AJAX ---
    $request = \Bitrix\Main\Context::getCurrent()->getRequest();
    /* if (!$request->isAjax())
     {
         echo json_encode(['success' => false, 'error' => 'Not AJAX request']); exit;
     }*/

    // --- проверка id сессии ---
    if (!check_bitrix_sessid()) {
        echo json_encode(['success' => false, 'error' => 'Invalid sessid']);
        exit;
    }

    // --- пользователь ---
    global $USER;
    if (!$USER->IsAuthorized()) {
        echo json_encode(['success' => false, 'error' => 'Not authorized']);
        exit;
    }
    $userId = (int)$USER->GetID();
    $userRow = CUser::GetByID($userId)->Fetch();
    $xmlId = trim((string)($userRow['XML_ID'] ?? ''));
    if ($xmlId === '') {
        echo json_encode(['success' => false, 'error' => 'XML_ID is empty']);
        exit;
    }

    // --- валидация года ---
    $year = (int)($_POST['year'] ?? 0);
    $currentYear = (int)date('Y');
    if ($year < 2000 || $year > $currentYear) {
        echo json_encode(['success' => false, 'error' => 'Invalid year']);
        exit;
    }

    // --- валидация месяцев ---
    $months = $_POST['months'] ?? [];
    if (!is_array($months)) {
        $months = [];
    }
    $months = array_values(array_unique(array_filter(
        array_map('intval', $months),
        fn($m) => $m >= 1 && $m <= 12
    )));
    if (empty($months)) {
        echo json_encode(['success' => false, 'error' => 'Select at least one month']);
        exit;
    }
    sort($months);

    /*  // --- формируем записи ---
      $newRecords = [];
      foreach ($months as $m)
      {
          // количество дней в месяце (учитывает 28/29/30/31 и високосные года)
          $lastDay = (int)date('t', mktime(0, 0, 0, $m, 1, $year));

          $newRecords[] = [
              // первое число месяца, 00:00:00
                  'DateBegin' => sprintf('%04d%02d01000000', $year, $m),
              // последнее число месяца, 23:59:59
                  'DateEnd'   => sprintf('%04d%02d%02d000000', $year, $m, $lastDay),
                  'UID'       => $xmlId,
          ];
      }*/

    // --- формируем записи объединёнными диапазонами месяцев ---
    $newRecords = [];

    $rangeStart = $months[0];
    $rangeEnd = $months[0];

    foreach (array_slice($months, 1) as $month) {
        // Если следующий месяц идёт подряд, расширяем текущий диапазон
        if ($month === $rangeEnd + 1) {
            $rangeEnd = $month;
            continue;
        }

        // Сохраняем завершённый диапазон
        $lastDay = (int)date(
            't',
            mktime(0, 0, 0, $rangeEnd, 1, $year)
        );

        $newRecords[] = [
            'DateBegin' => sprintf(
                '%04d%02d01000000',
                $year,
                $rangeStart
            ),
            'DateEnd' => sprintf(
                '%04d%02d%02d000000',
                $year,
                $rangeEnd,
                $lastDay
            ),
            'UID' => $xmlId,
        ];

        // Начинаем новый диапазон
        $rangeStart = $month;
        $rangeEnd = $month;
    }

// Сохраняем последний диапазон
    $lastDay = (int)date(
        't',
        mktime(0, 0, 0, $rangeEnd, 1, $year)
    );

    $newRecords[] = [
        'DateBegin' => sprintf(
            '%04d%02d01000000',
            $year,
            $rangeStart
        ),
        'DateEnd' => sprintf(
            '%04d%02d%02d000000',
            $year,
            $rangeEnd,
            $lastDay
        ),
        'UID' => $xmlId,
    ];

    // --- запись в один JSON-файл c блокировкой ---
    $fileDir = $_SERVER['DOCUMENT_ROOT'] . '/upload';


    if (!is_dir($fileDir)) {
        @mkdir($fileDir, 0777, true);
    }
    $filePath = $fileDir . '/user_months.json';

    /*$fp = @fopen($filePath, 'c+');
    if (!$fp) {
        echo json_encode(['success' => false, 'error' => 'Cannot open file']);
        exit;
    }
    if (!flock($fp, LOCK_EX)) {
        fclose($fp);
        echo json_encode(['success' => false, 'error' => 'Cannot lock file']);
        exit;
    }

    $content = stream_get_contents($fp);
    $data = ($content !== '' && $content !== false) ? json_decode($content, true) : [];
    if (!is_array($data)) {
        $data = [];
    }*/

    foreach ($newRecords as $rec) {
        $data[] = $rec;
    }

    $log = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/upload/zp_listok.txt', $log . PHP_EOL, FILE_APPEND);

    $gotCont=file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/upload/zp_listok.txt');
    if ($gotCont !== false) {
        $cont = true;
    } else {
        $cont = false;
    }

   /* ftruncate($fp, 0);
    rewind($fp);
    fwrite($fp, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    fflush($fp);
    flock($fp, LOCK_UN);
    fclose($fp);*/

    echo json_encode([
        'success' => $cont,
        'saved' => count($newRecords),
        'uid' => $xmlId,
        'cont' => $gotCont,
    ]);
    exit;
}
?>