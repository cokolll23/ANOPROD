<?php

use Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\ModuleManager;
use Bitrix\Main\Config\Configuration;

Loc::loadMessages(__FILE__);

class Korus_Kerberos extends CModule
{
    public $MODULE_ID = 'korus.kerberos';
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $NEED_MAIN_VERSION = '21.0.0';
    public $NEED_MODULES = ['ldap'];
    public $eventsData = [
        'main' => [
            'OnBeforeProlog' => [
                ['Korus\\Kerberos\\Events\\Main', 'kerberosAuthRedirect'],
            ],
            'OnAfterUserLogout' => [
                ['Korus\\Kerberos\\Events\\User', 'setNormalAuthorization']
            ]
        ],
    ];

    function __construct()
    {
        $arModuleVersion = [];
        include(__DIR__ . "/version.php");

        $this->MODULE_VERSION = $arModuleVersion["Version"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["Version_Date"];
        $this->MODULE_NAME = Loc::GetMessage("Korus_Kerberos_Module_Name");
        $this->MODULE_DESCRIPTION = Loc::GetMessage("Korus_Kerberos_Module_Desc");

        $this->PARTNER_NAME = Loc::GetMessage("Korus_Kerberos_Partner_Name");
        $this->PARTNER_URI = Loc::GetMessage("Korus_Kerberos_Partner_Uri");

        $this->SHOW_SUPER_ADMIN_GROUP_RIGHTS = 'Y';
        $this->MODULE_GROUP_RIGHTS = 'Y';
    }

    function DoInstall()
    {
        global $APPLICATION;
        // Проверка установленных модулей и их версий
        if (is_array($this->NEED_MODULES) && !empty($this->NEED_MODULES) && strlen($this->NEED_MAIN_VERSION) >= 0) {
            foreach ($this->NEED_MODULES as $module) {
                if (!ModuleManager::isModuleInstalled($module)) {
                    $APPLICATION->ThrowException(Loc::GetMessage('Korus_Kerberos_Need_Modules', array('#Module#' => $module)));
                    return false;
                }
            }
            if (CheckVersion(ModuleManager::getVersion('main'), $this->NEED_MAIN_VERSION)) {
                if (!$this->InstallFiles()) {
                    $APPLICATION->ThrowException(Loc::getMessage('KORUS_KEYCLOAK_FILES_NOT_COPY'));
                    return false;
                };

                $this->installRouting();

                Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);

                $this->installEvents();
                $this->installUfField();

                return true;
            } else {
                $APPLICATION->ThrowException(Loc::GetMessage('Korus_Kerberos_Need_Right_Ver', array('#Need#' => $this->NEED_MAIN_VERSION)));
                return false;
            }
        } else {
            $APPLICATION->ThrowException(Loc::GetMessage('Korus_Kerberos_Need_Error'));
            return false;
        }
    }

    function DoUninstall()
    {
        ModuleManager::unRegisterModule($this->MODULE_ID);
        $this->unInstallRouting();
        $this->UnInstallFiles();
        $this->unInstallEvents();
    }

    function InstallFiles()
    {   
        $resultCopyComponents = CopyDirFiles(
            __DIR__ . '/components/korus/',
            $_SERVER['DOCUMENT_ROOT'] . '/local/components/korus/',
            true,
            true
        );

        CopyDirFiles(__DIR__ . '/routes', $_SERVER['DOCUMENT_ROOT'] . '/local/routes');

        return ($resultCopyComponents);
    }

    function installEvents()
    {
        $eventManager = Bitrix\Main\EventManager::getInstance();
        foreach ($this->eventsData as $module => $events) {
            foreach ($events as $eventCode => $arCallbacks) {
                foreach ($arCallbacks as $callback) {
                    $eventManager->registerEventHandler(
                        $module,
                        $eventCode,
                        $this->MODULE_ID,
                        $callback[0],
                        $callback[1]
                    );
                }
            }
        }
    }

    function installUfField()
    {
        $oUserTypeEntity = new \CUserTypeEntity();

        $aUserFields = [
            'ENTITY_ID' => 'USER',
            'FIELD_NAME' => 'UF_AUTH_CODE',
            'USER_TYPE_ID' => 'string',
            'SORT' => 500,
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'N',
            'EDIT_IN_LIST' => 'N',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' => [],
            'EDIT_FORM_LABEL' => [
                'ru' => 'Код аутентификации',
                'en' => 'Auth code',
            ],
        ];
        $oUserTypeEntity->Add($aUserFields);
    }

    function UnInstallFiles()
    {
        foreach (array_diff(scandir(__DIR__ . '/components/korus/'), ['.', '..']) as $folder) {
            DeleteDirFilesEx('/local/components/korus/' . $folder);
        }

        unlink($_SERVER['DOCUMENT_ROOT'] . '/local/routes/korus.congratulations.api.php');
    }

    public function installRouting()
    {
        $config = Configuration::getInstance();
        $routing = $config->get('routing');

        $config->add('routing', [
            'config' => array_merge(
                (array)$routing['config'],
                static::getDirFiles(__DIR__ . '/routes')
            )
        ]);
        $config->saveConfiguration();
    }

    public function unInstallRouting()
    {
        $config = Configuration::getInstance();
        $routing = $config->get('routing');

        $config->add('routing', [
            'config' => array_diff(
                (array)$routing['config'],
                static::getDirFiles(__DIR__ . '/routes')
            )
        ]);
        $config->saveConfiguration();
    }

    function unInstallEvents()
    {
        $eventManager = Bitrix\Main\EventManager::getInstance();
        foreach ($this->eventsData as $module => $events) {
            foreach ($events as $eventCode => $arCallbacks) {
                foreach ($arCallbacks as $callback) {
                    $eventManager->unRegisterEventHandler(
                        $module,
                        $eventCode,
                        $this->MODULE_ID,
                        $callback[0],
                        $callback[1]
                    );
                }
            }
        }
    }

    public static function getDirFiles(string $dir): array
    {
        return (array)array_diff(scandir($dir), ['.', '..']);
    }
}
