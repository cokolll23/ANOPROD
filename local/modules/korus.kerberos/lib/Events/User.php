<?php

namespace Korus\Kerberos\Events;

use Bitrix\Main\Config\Configuration;

class User
{
    public static function setNormalAuthorization(&$arParams)
    {
        $config = Configuration::getInstance();
        if ($config['kerberos_redirect_url']) {
            \Bitrix\Main\Application::getInstance()->getSession()->set('NEED_AUTH', 'normal');
        }
    }
}