<?php
namespace Kir\Logging\Essentials\Loggers;

class StreamLogger extends ResourceLogger {
	/**
	 * @param string $connectionUri
	 * @param string $mode
	 */
	public function __construct($connectionUri, $mode='a+') {
		$resource = fopen($connectionUri, $mode);
		parent::__construct($resource);
	}
}