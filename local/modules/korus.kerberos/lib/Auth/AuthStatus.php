<?php

declare(strict_types=1);

namespace Korus\Kerberos\Auth;

enum AuthStatus: string {
	case Success = 'success';
	case Denied  = 'denied';
	case Error   = 'error';
}
