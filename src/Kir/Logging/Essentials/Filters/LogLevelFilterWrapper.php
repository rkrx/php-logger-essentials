<?php
namespace Kir\Logging\Essentials\Filters;

use Kir\Logging\Essentials\Common\AbstractLogger;
use Kir\Logging\Essentials\Tools\LogLevelTranslator;
use Psr\Log\LoggerInterface;

class LogLevelFilterWrapper extends AbstractLogger {
	/**
	 * @var LoggerInterface
	 */
	private $logger;

	/**
	 * @var int
	 */
	private $minLevel = null;

	/**
	 * @var int
	 */
	private $maxLevel = null;

	/**
	 * @param LoggerInterface $logger
	 * @param string $minLevel
	 * @param string $maxLevel
	 */
	public function __construct(LoggerInterface $logger, $minLevel, $maxLevel) {
		$this->logger = $logger;
		$this->minLevel = 7 - LogLevelTranslator::getLevelNo($minLevel);
		$this->maxLevel = 7 - LogLevelTranslator::getLevelNo($maxLevel);
	}

	/**
	 * Logs with an arbitrary level.
	 * @param mixed $psrLevel
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($psrLevel, $message, array $context = array()) {
		$level = 7 - LogLevelTranslator::getLevelNo($psrLevel);
		if($this->minLevel <= $level && $this->maxLevel >= $level) {
			$this->logger->log($psrLevel, $message, $context);
		}
		return $this;
	}
}