<?php
namespace Kir\Logging\Essentials\Loggers;

use Kir\Logging\Essentials\Common\AbstractLogger;

class ArrayLogger extends AbstractLogger {
	/**
	 * @var array[]
	 */
	private $messages = array();

	/**
	 * @var callable[]
	 */
	private $processors = array();

	/**
	 * @return array[]
	 */
	public function getMessages() {
		return $this->messages;
	}

	/**
	 * @param callable $fn
	 * @return $this
	 */
	public function addProcessor($fn) {
		$this->processors = $fn;
		return $this;
	}

	/**
	 * Logs with an arbitrary level.
	 *
	 * @param mixed $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($level, $message, array $context = array()) {
		$message = array('level' => $level, 'message' => $message, 'context' => $context);
		foreach($this->processors as $processor) {
			$message = call_user_func($processor, $message);
		}
		$this->messages[] = $message;
		return $this;
	}
}