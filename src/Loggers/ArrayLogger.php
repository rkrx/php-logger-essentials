<?php
namespace Kir\Logging\Essentials\Loggers;

use Kir\Logging\Essentials\Common\AbstractLogger;

class ArrayLogger extends AbstractLogger {
	/**
	 * @var array[]
	 */
	private $messages = array();

	/**
	 * @return array[]
	 */
	public function getMessages() {
		return $this->messages;
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
		$this->messages[] = array('level' => $level, 'message' => $message, 'context' => $context);
		return $this;
	}
}