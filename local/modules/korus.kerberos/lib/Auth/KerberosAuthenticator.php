<?php

declare(strict_types=1);

namespace Korus\Kerberos\Auth;

use Bitrix\Main\Config\Configuration;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
use Bitrix\Main\Security\Random;
use Bitrix\Main\UserTable;
use Bitrix\Main\Web\JWT;
use Korus\Kerberos\Exception\KerberosAuthException;
use Psr\Log\LoggerInterface;

class KerberosAuthenticator
{

    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    private const CODE_LENGTH = 32;
    private const CODE_TTL = 30;

    /**
     *
     * @return Korus\Kerberos\Auth\KerberosAuthResult
     */
    public function findRemoteUserDataAndAuth(): KerberosAuthResult
    {
        global $USER;

        $result = new KerberosAuthResult();
        $result->status = AuthStatus::Denied->value;
        $result->data = null;

        $remoteUserData = $this->findRemoteUser();

        [$login, $domain] = $remoteUserData;

        if (!empty($login) && Loader::includeModule('ldap')) {
            $userFilter = [
                'ACTIVE' => 'Y',
                'LOGIN' => $login
            ];

            $ldapServerResult = \CLdapServer::GetList(
                ['ID' => 'ASC'],
                [
                    'SERVER' => $domain,
					'ACTIVE' => 'Y'
                ]
            );

            $ldapServer = $ldapServerResult->Fetch();

            if (!$ldapServer) {
                throw new KerberosAuthException('LDAP server settings is not found');
            }

            $userFilter['EXTERNAL_AUTH_ID'] = 'LDAP#' . $ldapServer['ID'];

            $config = Configuration::getInstance();

            $portalDomain = Option::get('main', 'server_name');

            $by = 'ID';
            $order = 'ASC';
            $userResult = \CUser::GetList($by, $order, $userFilter);

            $userInfo = $userResult->Fetch();

            if (!$userInfo) {
                throw new KerberosAuthException('User not found on portal by LDAP_ID');
            }

            $serverName = $_SERVER['SERVER_NAME'];
            if (!$serverName) {
                $serverName = $_SERVER['HTTP_HOST'];
            }

            if (!$serverName) {
                preg_match('/:\/\/(.*?)(\/|$)/', $_SERVER['HTTP_ORIGIN'], $match);

                if ($match[1]) {
                    $serverName = $match[1];
                } else {
                    preg_match('/:\/\/(.*?)(\/|$)/', $_SERVER['HTTP_REFERER'], $match);
                    $serverName = $match[1];
                }
            }

            if ($serverName == $portalDomain) {
                $USER->Authorize($userInfo['ID']);
                $data = 'auth';
                $status = AuthStatus::Success->value;

                $result->status = $status;
                $result->data = $data;
            } else {
                $key = $config->get('auth_token_key');

                if (empty($key)) {
                    $key = Random::getString(64);
                    $config->addReadonly('auth_token_key', $key);
                    $config->saveConfiguration();
                }

                $code = $this->setAuthCode($userInfo['ID']);

                if ($code !== null) {
                    $data = JWT::encode([
                        'code' => $code,
                        'uid' => $userInfo['ID']
                    ], $key, 'HS256');
                    $status = AuthStatus::Success->value;

                    $result->status = $status;
                    $result->data = $data;
                }
            }
        }

        return $result;
    }

    public function authByToken(string $token): KerberosAuthResult
    {
        $result = new KerberosAuthResult();
        $result->status = AuthStatus::Denied->value;
        $result->data = null;

        $config = Configuration::getInstance();
        $key = $config->get('auth_token_key');

        if ($token && $key) {
            $userData = JWT::decode($token, $key, ['HS256']);
            if (!empty($userData->code) && !empty($userData->uid)) {
                if ($this->authByCode($userData->code, $userData->uid)) {
                    $result->status = AuthStatus::Success->value;
                }
            }
        }

        return $result;
    }

    /**
     * Генерирует код пользователя и записывает его в БД
     * Возвращает сгенеренный код
     *
     * @return string|null
     */
    private function setAuthCode($userId): ?string
    {
        $code = $this->generateCode();
        $codeExpTime = time() + self::CODE_TTL;
        $user = new \CUser();
        $fields = [
            'UF_AUTH_CODE' => $code,
            'UF_AUTH_CODE_EXP_TIME' => $codeExpTime
        ];
        $result = $user->Update($userId, $fields);

        if ($result) {
            return $code;
        }

        return null;
    }

    private function generateCode()
    {
        return Random::getString(self::CODE_LENGTH);
    }


    private function findRemoteUser(): ?array
    {
        $remoteUser = $_SERVER['REMOTE_USER'];

        if ($remoteUser) {
            return explode('@', $remoteUser);
        }

        return null;
    }

    /**
     * @param string $code
     * @return bool
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function authByCode(string $code, string $userId): bool
    {
        global $USER;

        $user = UserTable::getList([
            'filter' => [
                'ID' => $userId,
                'UF_AUTH_CODE' => $code,
                // '<=UF_AUTH_CODE_EXP_TIME' => time()
            ]
        ])->fetchObject();
        if ($user) {
            $USER->Authorize($user->getId());
            return true;
        }

        return false;
    }

    public function getLogger()
    {
        return $this->logger;
    }
}
