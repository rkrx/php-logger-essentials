<?php
namespace Kir\Logging\Essentials\Common;

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
		call_user_func($this->callable, $level, $message, $context);
		return $this;
	}
}