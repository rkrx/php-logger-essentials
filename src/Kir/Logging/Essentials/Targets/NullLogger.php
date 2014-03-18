<?php
namespace Kir\Logging\Essentials\Targets;

use Kir\Logging\Essentials\Common\AbstractLogger;
use Kir\Logging\Essentials\Formatters\Proxies;

class NullLogger extends AbstractLogger {
	/**
	 * Logs with an arbitrary level.
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($level, $message, array $context = array()) {
	}
}