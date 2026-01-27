<?php

use Bitrix\Main\Routing\RoutingConfigurator;

use Korus\Kerberos\Http\Controller\KerberosAuthController;

return fn(RoutingConfigurator $routes) => $routes->group(function(RoutingConfigurator $routes) {
    $routes->post('/kerberos', [KerberosAuthController::class, 'authByUserData']);
    $routes->post('/kerberos-auth-by-token', [KerberosAuthController::class, 'authByTokenAction']);
});
