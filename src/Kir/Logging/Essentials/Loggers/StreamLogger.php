<?php
namespace Kir\Logging\Essentials\Loggers;

use Kir\Logging\Essentials\Formatters\Formatter;

class StreamLogger extends ResourceLogger {
	/**
	 * @param string $connectionUri
	 * @param string $mode
	 * @param Formatter $formatter
	 */
	public function __construct($connectionUri, $mode, Formatter $formatter = null) {
		$resource = fopen($connectionUri, $mode);
		parent::__construct($resource, $formatter);
	}
}