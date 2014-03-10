<?php
namespace Kir\Logging\Essentials\Filters;

use Kir\Logging\Essentials\Common\AbstractLogger;
use Psr\Log\LoggerInterface;

class ExcludedLogLevelFilterWrapper extends AbstractLogger {
	/**
	 * @var LoggerInterface
	 */
	private $logger;

	/**
	 * @var string
	 */
	private $excludedLogLevel = null;

	/**
	 * @param LoggerInterface $logger
	 * @param string $excludedLogLevel
	 */
	public function __construct(LoggerInterface $logger, $excludedLogLevel) {
		$this->logger = $logger;
		$this->excludedLogLevel = $excludedLogLevel;
	}

	/**
	 * Logs with an arbitrary level.
	 * @param mixed $psrLevel
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($psrLevel, $message, array $context = array()) {
		if($this->excludedLogLevel != $psrLevel) {
			$this->logger->log($psrLevel, $message, $context);
		}
		return $this;
	}
}