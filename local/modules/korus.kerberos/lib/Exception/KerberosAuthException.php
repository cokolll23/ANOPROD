<?php

declare(strict_types=1);

namespace Korus\Kerberos\Exception;

use Bitrix\Main\SystemException;

class KerberosAuthException extends SystemException
{
	public function __construct($message = '', \Exception $previous = null)
	{
		parent::__construct(($message ?: ''), 0, '', 0, $previous);
	}
}
