<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

use Bitrix\Main\Loader;
use Bitrix\Iblock\ElementTable;
use Bitrix\Main\Application;
use Bitrix\Main\ORM\Query\Query;
use Bitrix\Calendar\Internals\EventTable;

if ($_POST['action'] == 'getLinkMore') {
// получение ссылки на мероприятие
    if (Loader::includeModule('calendar')) {

        $eventId = trim($_POST['eventId'] ?? '');

        // Безопасная выборка через ORM
        $event = EventTable::getList([
            'select' => ['ID', 'DESCRIPTION'],
            'filter' => ['=ID' => $eventId],
            'limit' => 1
        ])->fetch();

        if ($event) {
            $LINK = explode(';', $event['DESCRIPTION'])[1];
            $link1 = explode(']', $event['DESCRIPTION'])[1];
            $link = explode('[', $link1)[0];
        }

    }
    if($link !=''){
        $resLink = $link;
        $success = true;
    }else{
        $resLink = `<h3 style = 'color:green;'> Нет мероприятий по этому событию</h3>`;
        $success = false;
    }

    $arResults = array(
        'success' => $success,
        'LINK' => $resLink,
    );
    echo json_encode($arResults);
    die();
}

// Получаем форму
if ($_POST['action'] == 'getWebForm') {
    $eventId = trim($_POST['eventId'] ?? '');
    $userId = trim($_POST['userId'] ?? '');
    define('STOP_STATISTICS', true);
    define('PUBLIC_AJAX_MODE', true);
    // Подключаем модуль календаря
    if (Loader::includeModule('calendar')) {

        // Безопасная выборка через ORM
        $event = EventTable::getList([
            'select' => ['ID', 'NAME', 'DESCRIPTION'],
            'filter' => ['=ID' => $eventId],
            'limit' => 1
        ])->fetch();

        if ($event) {
            $formId = explode(';', $event['DESCRIPTION'])[0];
        }
    }
    if ($formId != 0) {
        ob_start(); ?>

        <? $APPLICATION->IncludeComponent(
            "lab:form.result.new",
            "cal",
            array(
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "CHAIN_ITEM_LINK" => "",
                "CHAIN_ITEM_TEXT" => "",
                "EDIT_URL" => "result_edit.php",
                "IGNORE_CUSTOM_TEMPLATE" => "Y",
                "LIST_URL" => "result_list.php",
                "SEF_MODE" => "N",
                "SUCCESS_URL" => "",
                "USE_EXTENDED_ERRORS" => "Y",
                "WEB_FORM_ID" => $formId,
                "COMPONENT_TEMPLATE" => "calendar",
                "VARIABLE_ALIASES" => array(
                    "WEB_FORM_ID" => "WEB_FORM_ID",
                    "RESULT_ID" => "RESULT_ID",
                )
            ),
            false
        ); ?>

        <?

        $html = ob_get_contents();
        ob_end_clean();
        if ($formId != '') {

            $success = true;
        }
    }else{

        $success = false;
        // $formLink = explode(';', $event['DESCRIPTION'])[2];
        $formLink2 = explode(';', $event['DESCRIPTION'])[2];
        $formLink1 = explode('=', $formLink2)[1];
        $formLink = explode('[', $formLink1)[0];
        $formLinkRes = explode(']', $formLink)[0];
    }

    $arResults = array(
        'html' => $html,
        'success' => $success,
        'EVENT_ID' => $eventId,
        'RESULT_ID' => $_REQUEST,
        'NAME' => $event['NAME'],
        'FormLink' => $formLinkRes,

    );
    echo json_encode($arResults);
    die();
}


if ($_POST['web_form_apply'] == 'Y' || $_REQUEST['formresult'] == 'addok' || $_REQUEST['WEB_FORM_ID']) {
    $formId = $_POST['WEB_FORM_ID'];

    ob_start(); ?>

    <?$APPLICATION->IncludeComponent(
        "lab:form.result.new",
        "cal",
        array(
            "CACHE_TIME" => "3600",
            "CACHE_TYPE" => "A",
            "CHAIN_ITEM_LINK" => "",
            "CHAIN_ITEM_TEXT" => "",
            "EDIT_URL" => "",
            "IGNORE_CUSTOM_TEMPLATE" => "Y",
            "LIST_URL" => "result_list.php",
            "SEF_MODE" => "N",
            "SUCCESS_URL" => "",
            "USE_EXTENDED_ERRORS" => "Y",
            "WEB_FORM_ID" => $formId,
            "COMPONENT_TEMPLATE" => "calendar",
            "VARIABLE_ALIASES" => array(
                "WEB_FORM_ID" => "WEB_FORM_ID",
                "RESULT_ID" => "RESULT_ID",
            )
        ),
        false
    );?>

    <?
    $html = ob_get_contents();
    ob_end_clean();

    $arResults = array(
        'html' => $html,
        'success' => $_REQUEST["RESULT_ID"] != null ? true : false,
        '$_REQUEST' => $_REQUEST,
    );
    echo json_encode($arResults);
    die();
}
/*if ($_POST['WEB_FORM_ID']) {

    \Bitrix\Main\Loader::includeModule('form');

    $WEB_FORM_ID = $_POST['WEB_FORM_ID'];

    $FORM_ID = 4; // ID веб-формы
// сформируем массив фильтра
    $arFilter = array(
        "ID" => $FORM_ID,     // вопрос с ID=140 или с ID=141
        "ACTIVE" => "Y",             // флаг активности
        //"REQUIRED"              => "Y",             // флаг обязательности ответа на вопрос
    );
// получим список всех вопросов веб-формы #4
    $rsQuestions = CFormField::GetList(
        $FORM_ID,
        "N",
        $by = "",
        $order = "",
        $arFilter,
    );
    while ($arQuestion = $rsQuestions->Fetch()) {
        $arQuestions[] = $arQuestion;
    }
    $arRes['Questions'] = $arQuestions;
    unset($_POST['WEB_FORM_ID']);

    if ($RESULT_ID = CFormResult::Add($WEB_FORM_ID)) {
        $arRes['RES'] = $RESULT_ID;
        $arRes['success'] = true;
    } else {
        $arRes['RES'] = 'Err';
        $arRes['success'] = false;
    }

    echo json_encode($arRes);
    die();
}*/


