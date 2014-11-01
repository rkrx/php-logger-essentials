<?php
namespace Kir\Logging\Loggers;

use Kir\Logging\Essentials\Common\AbstractFormatableLogger;
use Kir\Logging\Essentials\Common\AbstractLogger;
use Kir\Logging\Essentials\Formatters\Formatter;

class CallbackLogger extends AbstractLogger {
	/**
	 * @var callable
	 */
	private $callable = null;

	/**
	 * @param callable $callable
	 */
	public function __construct($callable) {
		$this->callable = $callable;
	}

	/**
	 * Logs with an arbitrary level.
	 * @param mixed $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($level, $message, array $context = array()) {
		try {
			call_user_func($this->callable, $level, $message, $context);
		} catch(\Exception $e) {
		}
		return $this;
	}
}