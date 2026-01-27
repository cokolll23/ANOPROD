<?php

use Bitrix\Main\Diag\LogFormatter;
use Bitrix\Main\Diag\FileLogger;
use Bitrix\Main\DI\ServiceLocator;

use Korus\Kerberos\Http\Controller\KerberosAuthController;
use Korus\Kerberos\Auth\KerberosAuthenticator;

return [
    'services' => [
        'value' => [   
            'KerberosLogFormatter' => [
                'className' => LogFormatter::class,
                'constructorParams' => static function () {
                    return [
                        $showArguments = false,
                        $argMaxChars = 30
                    ];
                },
            ],
            'KerberosLogger' => [
                'className' => FileLogger::class,
                'constructorParams' => static function () {
                    return [
                        $logFile = $_SERVER['DOCUMENT_ROOT'] . '/local/log/kerberos.log',
                        $maxLogSize = null
                    ];
                },
            ],
            'KerberosAuthenticator' => [
                'className' => KerberosAuthenticator::class,
                'constructorParams' => static function () {
                    return [
                        $logger = ServiceLocator::getInstance()->get('KerberosLogger')
                    ];
                },
            ],
        ],
        'readonly' => true,
    ],
    'controllers' => [
        'value' => [
            'defaultNamespace' => '\\Korus\\Kerberos\\Http\\Controller',
            'className' => KerberosAuthController::class,
            'constructorParams' => static function () {
                return [
                    $logger = ServiceLocator::getInstance()->get('KerberosLogger')
                ];
            },
        ],
        'readonly' => true
    ],
];