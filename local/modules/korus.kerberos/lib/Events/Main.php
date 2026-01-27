<?php

namespace Korus\Kerberos\Events;

use Bitrix\Main\Config\Configuration;
use Bitrix\Main\DI\ServiceLocator;
use Korus\Kerberos\Auth\AuthStatus;
use Korus\Kerberos\Exception\KerberosAuthException;

class Main
{
    public static function kerberosAuthRedirect()
    {
        global $USER;
        $instance = \Bitrix\Main\Application::getInstance();

        /**
         * @var $kerberosAuthenticator \Korus\Kerberos\Auth\KerberosAuthenticator
	 */

        if (!$USER->GetID()) {
            $config = Configuration::getInstance();
            if ($config['kerberos_redirect_url'] && !defined('CONSOLE_IMPORT')) {
                $backUrl = $instance->getContext()->getRequest()->get('backurl') ?: $instance->getContext()->getRequest()->getRequestUri();

                if (!$instance->getSession()->get('NEED_AUTH')) {
                    $instance->getSession()->set('NEED_AUTH', 'kerberos');
                    LocalRedirect($config['kerberos_redirect_url'] . '?backurl=' . $backUrl);
                } elseif ($instance->getSession()->get('NEED_AUTH') == 'kerberos') {
                    if ($_SERVER['REMOTE_USER']) {
                        $kerberosAuthenticator = ServiceLocator::getInstance()->get('KerberosAuthenticator');
                        if (!$instance->getSession()->get('jwt')) {
                            try {
                                $result = $kerberosAuthenticator->findRemoteUserDataAndAuth();

                                if ($result->status == AuthStatus::Success->value) {
                                    if ($result->data == 'auth') {
                                        LocalRedirect($backUrl);
                                    } else {
                                        $instance->getSession()->set('jwt', $result->data);
                                        LocalRedirect($config['kerberos_redirect_url'] . '?backurl=' . $backUrl);
                                    }
                                }
                            } catch (KerberosAuthException $e) {
                                $kerberosAuthenticator->getLogger()->info($e->getMessage());
                            }
                        } else {
                            $kerberosAuthenticator->authByToken($instance->getSession()->get('jwt'));
                            $instance->getSession()->set('jwt', null);
                        }
                    }

                    static::redirectToNormalAuthorization($instance);
                }
            }
        } else {
            $instance->getSession()->set('NEED_AUTH', null);
        }
    }

    protected static function redirectToNormalAuthorization($instance)
    {
        $instance->getSession()->set('NEED_AUTH', 'normal');
        LocalRedirect($instance->getContext()->getRequest()->get('backurl'));
    }
}
