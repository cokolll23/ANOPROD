<?php

use Bitrix\Main\Application;
use Bitrix\Main\Config\Configuration;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
use Korus\Translom\Helper\Option as OptionHelper;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class KorusKerberosAuth extends CBitrixComponent
{
    public function executeComponent()
    {
        $config = Configuration::getInstance();
        $this->arResult['SERVERS'] = $config['auth_domains'];
        $request = Application::getInstance()->getContext()->getRequest();
        $this->arResult['BACKURL'] = $request->get('backurl') ?? '';

        $this->includeComponentTemplate();
    }
}
