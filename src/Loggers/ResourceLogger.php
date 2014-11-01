<?php
namespace Kir\Logging\Essentials\Loggers;

use Kir\Logging\Essentials\Common\AbstractLogger;

class ResourceLogger extends AbstractLogger {
	/**
	 * @var resource
	 */
	private $resource = null;

	/**
	 * @param resource $resource
	 */
	public function __construct($resource) {
		$this->resource = $resource;
	}

	/**
	 * Logs with an arbitrary level.
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($level, $message, array $context = array()) {
		fwrite($this->resource, $message);
		return $this;
	}
}