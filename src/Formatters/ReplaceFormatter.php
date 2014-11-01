<?php
namespace Kir\Logging\Essentials\Formatters;

use Kir\Logging\Essentials\Common\AbstractLogger;
use Psr\Log\LoggerInterface;

class ReplaceFormatter extends AbstractLogger {
	/**
	 * @var LoggerInterface
	 */
	private $logger;
	/**
	 * @var array
	 */
	private $replacement;

	/**
	 * @param LoggerInterface $logger
	 * @param array $replacement
	 */
	public function __construct(LoggerInterface $logger, array $replacement) {
		$this->logger = $logger;
		$this->replacement = $replacement;
	}

	/**
	 * Logs with an arbitrary level.
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($level, $message, array $context = array()) {
		$message = strtr($message, $this->replacement);
		$this->logger->log($level, $message, $context);
		return $this;
	}
}