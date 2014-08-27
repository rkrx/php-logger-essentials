<?php
namespace Kir\Logging\Essentials\Common;

use Psr\Log\LoggerInterface;

class LoggerCollection extends AbstractLogger {
	/**
	 * @var LoggerInterface[]
	 */
	private $loggers = array();

	/**
	 * @param array $loggers
	 */
	public function __construct(array $loggers = array()) {
		foreach($loggers as $logger) {
			$this->add($logger);
		}
	}

	/**
	 * @param LoggerInterface $logger
	 * @return $this
	 */
	public function add(LoggerInterface $logger) {
		$this->loggers[] = $logger;
		return $this;
	}

	/**
	 * Logs with an arbitrary level.
	 * @param mixed $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($level, $message, array $context = array()) {
		foreach($this->loggers as $logger) {
			$logger->log($level, $message, $context);
		}
		return $this;
	}
}