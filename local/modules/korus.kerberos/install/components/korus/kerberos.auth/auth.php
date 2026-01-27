<?php

use Bitrix\Main\Application;
use Bitrix\Main\Config\Configuration;
use Bitrix\Main\Engine\Response\AjaxJson;
use Bitrix\Main\Loader;
use Bitrix\Main\Web\JWT;

define("NOT_CHECK_PERMISSIONS", true);
define("NEED_AUTH", false);
define("NO_KEEP_STATISTIC", true);

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

global $USER;

$request = Application::getInstance()->getContext()->getRequest();
$token = $request->getHeader('x-auth-token');
$config = Configuration::getInstance();
$key = $config->get('auth_token_key');

$status = AjaxJson::STATUS_DENIED;
if ($token && $key) {
    $userData = JWT::decode($token, $key, ['HS256']);
    if (!empty($userData->code) && !empty($userData->uid)) {
        $auth = new Auth($userData->uid);
        if ($auth->authByCode($userData->code)) {
            $status = AjaxJson::STATUS_SUCCESS;
        }
    }
}
$response = new AjaxJson('', $status);
$response->send();

require($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php");
