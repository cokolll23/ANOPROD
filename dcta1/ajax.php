<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;

global $USER;

header('Content-Type: application/json; charset=utf-8');

if (!$USER->IsAuthorized()) {
    echo json_encode([
        'success' => false,
        'message' => 'Пользователь не авторизован'
    ]);
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
    die();
}

$message = trim($_POST['message'] ?? '');

if ($message === '') {
    echo json_encode([
        'success' => false,
        'message' => 'Пустое сообщение'
    ]);
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
    die();
}

if (!Loader::includeModule('blog')) {
    echo json_encode([
        'success' => false,
        'message' => 'Модуль blog не подключен'
    ]);
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
    die();
}

$userId = (int)$USER->GetID();

try {
    $blogId = null;

    $blogRes = \CBlog::GetList(
        [],
        [
            'OWNER_ID' => $userId,
            'GROUP_ID' => 'PERSONAL',
            'ACTIVE' => 'Y'
        ],
        false,
        false,
        ['ID']
    );

    if ($blog = $blogRes->Fetch()) {
        $blogId = (int)$blog['ID'];
    } else {
        $fields = [
            'NAME' => 'Блог пользователя #' . $userId,
            'DESCRIPTION' => '',
            'ACTIVE' => 'Y',
            'EMAIL_NOTIFY' => 'Y',
            'OWNER_ID' => $userId,
            'GROUP_ID' => 'PERSONAL',
            'URL' => 'user-' . $userId,
            'PERMS_POST' => ['1' => 'P'],
            'PERMS_COMMENT' => ['1' => 'P']
        ];

        $blogId = (int)\CBlog::Add($fields);

        if ($blogId <= 0) {
            throw new \Exception('Не удалось создать блог');
        }
    }

    $postFields = [
        'BLOG_ID' => $blogId,
        'AUTHOR_ID' => $userId,
        'TITLE' => 'Обо мне',
        'DETAIL_TEXT' => $message,
        'DETAIL_TEXT_TYPE' => 'text',
        'PUBLISH_STATUS' => 'P',
        'ENABLE_TRACKBACK' => 'N',
        'ENABLE_COMMENTS' => 'N',
        'DATE_PUBLISH' => ConvertTimeStamp(time(), 'FULL')
    ];

    $postId = 0;

    $existingPostRes = \CBlogPost::GetList(
        [],
        [
            'BLOG_ID' => $blogId,
            'AUTHOR_ID' => $userId,
            'TITLE' => 'Обо мне'
        ],
        false,
        false,
        ['ID', 'DETAIL_TEXT']
    );

    if ($existingPost = $existingPostRes->Fetch()) {
        $postId = (int)$existingPost['ID'];
        $update = \CBlogPost::Update($postId, $postFields);
        if (!$update) {
            throw new \Exception('Не удалось обновить запись');
        }
    } else {
        $postId = (int)\CBlogPost::Add($postFields);
        if ($postId <= 0) {
            throw new \Exception('Не удалось создать запись');
        }
    }

    echo json_encode([
        'success' => true,
        'data' => [
            'blog_id' => $blogId,
            'post_id' => $postId,
            'text' => $message
        ]
    ], JSON_UNESCAPED_UNICODE);
} catch (\Throwable $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");