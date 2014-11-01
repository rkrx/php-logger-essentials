<?php
namespace Kir\Logging\Essentials\Formatters;

use Kir\Logging\Essentials\Common\AbstractLogger;

class PassThroughFormatter extends AbstractLogger {
	/**
	 * Logs with an arbitrary level.
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($level, $message, array $context = array()) {
		return $message;
	}
}