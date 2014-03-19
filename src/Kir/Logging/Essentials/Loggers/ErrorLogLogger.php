<?php
namespace Kir\Logging\Essentials\Loggers;

use Kir\Logging\Essentials\Common\AbstractFormatableLogger;

class ErrorLogLogger extends AbstractFormatableLogger {
	/**
	 * Logs with an arbitrary level.
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($level, $message, array $context = array()) {
		$message = $this->getFormatter()->format($level, $message, $context, array());
		error_log($message);
		return $this;
	}
}