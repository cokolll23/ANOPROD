function toBackUrl(url) {
    if (url && url.length > 0) {
        document.location.href = url;
    } else {
        document.location.reload();
    }
}

$(function () {
    // var $loader = $('#auth-loader');
    function tryDomainAuth(serverNum) {
        $.ajax({
            url: 'http://' + servers[serverNum] + '/kerberos',
            method: 'POST',
            xhrFields: {
                withCredentials: true
            }
        }).done(function (result) {
            if (result.status == 'success') {
                if (result.data.data == 'auth') {
                    toBackUrl(backurl);
                    return;
                }
                var jwt = result.data.data;
                $.ajax({
                    url: '/kerberos-auth-by-token',
                    method: 'POST',
                    headers: {
                        'x-auth-token': jwt
                    }
                }).done(function (result) {
                    if (result.data.status == 'success') {
                        toBackUrl(backurl);
                    } else {
                        console.warn('Ошибка авторизации по протоколу Kerberos');
                    }
                }).fail(function () {
                    console.warn('Ошибка авторизации по протоколу Kerberos');
                    // $loader.hide();
                })
            } else if (serverNum + 1 < servers.length) {
                tryDomainAuth(serverNum + 1);
            } else {
                console.log('Успешная авторизация по протоколу Kerberos');
                // $loader.hide();
            }
        }).fail(function () {
            if (serverNum + 1 < servers.length) {
                tryDomainAuth(serverNum + 1);
            } else {
                console.warn('Ошибка авторизации по протоколу Kerberos');
                // $loader.hide();
            }
        })
    }

    $.ajax({
        url: '/kerberos',
        method: 'POST',
    }).done(function (result) {
        if (result.status == 'success' && result.data.data == 'auth') {
            toBackUrl(backurl);
        } else if (servers.length > 0) {
            tryDomainAuth(0);
        } else {
            console.warn('Ошибка авторизации по протоколу Kerberos. Не установлены сервера авторизации');
        }
    }).fail(function () {
        if (servers.length > 0) {
            tryDomainAuth(0);
        } else {
            console.warn('Ошибка авторизации по протоколу Kerberos');
            // $loader.hide();
        }
    })
});
