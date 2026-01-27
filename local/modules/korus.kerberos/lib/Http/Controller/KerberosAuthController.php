<?php

declare(strict_types=1);

namespace Korus\Kerberos\Http\Controller;

use Bitrix\Main\Application;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Error;
use Bitrix\Main\DI\ServiceLocator;
use Bitrix\Main\Diag\FileLogger;
use Bitrix\Main\Diag\Helper;

use Korus\Main\Controller\BaseController;
use Korus\Kerberos\Auth\KerberosAuthenticator;
use Korus\Kerberos\Auth\KerberosAuthResult;

/**
 * @todo Реализовать коррктное инжектирование логгера
 */
class KerberosAuthController extends BaseController
{
    public function configureActions()
    {
        return [
            'authByUserData' => [
                '-prefilters' => [
                    ActionFilter\Authentication::class,
                    ActionFilter\Csrf::class
                ],
                'postfilters' => []
            ],
            'authByToken' => [
                '-prefilters' => [
                    ActionFilter\Authentication::class,
                    ActionFilter\Csrf::class
                ],
                'postfilters' => []
            ]
        ];
    }

    public function authByUserDataAction() : ?array
    {
        try {
            /** @var KerberosAuthenticator */
            $authenticator = ServiceLocator::getInstance()->get('KerberosAuthenticator');
            /** @var KerberosAuthResult */
            $result = $authenticator->findRemoteUserDataAndAuth();

        } catch (\Throwable $e) {
            $this->addError(new Error($e->getMessage(), $e->getCode()));
            /** @var FileLogger */
            $this->getLogger()->error("{date} {exception}\n", ['exception' => $e]);
        } finally {
            return [
                'status' => $result->status,
                'data' => $result->data
            ];
        }
    }

    public function authByTokenAction() : ?array
    {
        try {
            $request = Application::getInstance()->getContext()->getRequest();
            $token = $request->getHeader('x-auth-token');

            /** @var KerberosAuthenticator */
            $authenticator = ServiceLocator::getInstance()->get('KerberosAuthenticator');
            /** @var KerberosAuthResult */
            $result = $authenticator->authByToken($token);

        } catch (\Throwable $e) {
            $this->addError(new Error($e->getMessage(), $e->getCode()));
            /** @var FileLogger */
            $this->getLogger()->error("{date} {exception}\n", ['exception' => $e]);
        } finally {
            return [
                'status' => $result->status,
                'data' => $result->data
            ];
        }
    }

    private function getLogger()
    {
        return ServiceLocator::getInstance()->get('KerberosLogger');
    }
}
