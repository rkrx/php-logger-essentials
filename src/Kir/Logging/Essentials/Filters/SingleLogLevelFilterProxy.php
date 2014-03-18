<?php
namespace Kir\Logging\Essentials\Filters;

use Kir\Logging\Essentials\Common\AbstractLoggerWrapper;
use Psr\Log\LoggerInterface;

class SingleLogLevelFilterProxy extends AbstractLoggerWrapper {
	/**
	 * @var string
	 */
	private $excludedLogLevel = null;

	/**
	 * @param LoggerInterface $logger
	 * @param string $excludedLogLevel
	 */
	public function __construct(LoggerInterface $logger, $excludedLogLevel) {
		parent::__construct($logger);
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
			$this->logger()->log($psrLevel, $message, $context);
		}
		return $this;
	}
}