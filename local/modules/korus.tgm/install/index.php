<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

class Korus_Tgm extends CModule
{
    public $MODULE_ID = 'korus.tgm';
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $MODULE_CSS;
    public $PARTNER_NAME;
    public $PARTNER_URI;

    function __construct()
    {
        $this->MODULE_NAME = Loc::getMessage('KORUS_TGM_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('KORUS_TGM_MODULE_DESCRIPTION');
        $this->PARTNER_NAME = Loc::getMessage('KORUS_TGM_MODULE_PARTNER_NAME');
        $this->PARTNER_URI = 'https://korusconsulting.ru';

        $arModuleVersion = [];

        $path = str_replace('\\', '/', __FILE__);
        $path = substr($path, 0, strlen($path) - strlen('/index.php'));
        include($path . '/version.php');

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        } else {
            $this->MODULE_VERSION = '1.0.0';
            $this->MODULE_VERSION_DATE = '2025-01-21 10:00:00';
        }
    }

    public function DoInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);

        $this->InstallDB();
        return true;
    }

    public function InstallDB()
    {
        Loader::requireModule('sprint.migration');

        $migrationsDir = __DIR__ . '/migrations';
        $directory = new DirectoryIterator($migrationsDir);

        $versions = [];
        /** @var DirectoryIterator $item */
        foreach ($directory as $item) {
            if ($item->isDot() || $item->getFilename() == 'dev') {
                continue;
            }

            if ($item->isDir()) {
                $versions[] = $item->getFilename();
            }
        }

        sort($versions, SORT_NUMERIC);

        $versions[] = 'dev';

        $connection = \Bitrix\Main\Application::getConnection();
        $connection->startTransaction();
        try {
            foreach ($versions as $version) {
                (new Sprint\Migration\Installer(
                    [
                        'migration_table' => 'korus_tgm_migrations',
                        'migration_dir' => $migrationsDir . '/' . $version,
                        'migration_dir_absolute' => true,
                    ]
                ))->up();
            }
            $connection->commitTransaction();
        } catch (Exception $exception) {
            global $APPLICATION;
            $APPLICATION->ThrowException($exception->getMessage());
            $connection->rollbackTransaction();
            throw $exception;
        }
    }

    public function DoUninstall()
    {
        $this->UnInstallDB();
        ModuleManager::unRegisterModule($this->MODULE_ID);

        return true;
    }

    public function UnInstallDB()
    {
        if (Loader::includeModule('sprint.migration')) {
            try {
                (new Sprint\Migration\Installer(
                    [
                        'migration_table' => 'korus_tgm_migrations',
                        'migration_dir' => __DIR__ . '/migrations/dev/',
                        'migration_dir_absolute' => true,
                    ]
                ))->down();
            } catch (Exception $e) {
                global $APPLICATION;
                $APPLICATION->ThrowException($e->getMessage());
                return false;
            }
        }
        return true;
    }
}

