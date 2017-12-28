<?php

namespace NotificationChannels\NetCoreSms\Exceptions;

use Exception;

class InvalidConfiguration extends Exception {
	/**
	 * @return static
	 */
	public static function configurationNotSet()
	{
		return new static('In order to send notification via NetCore you need to add credentials in the `NetCore` key of `config.services`.');
	}
}