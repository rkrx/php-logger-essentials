<?php
namespace Kir\Logging\Essentials\Formatters;

use Kir\Logging\Essentials\Common\AbstractLogger;
use Psr\Log\LoggerInterface;

class ContextJsonFormatter extends AbstractLogger {
	/**
	 * @var LoggerInterface
	 */
	private $logger;
	/**
	 * @var int
	 */
	private $jsonOptions;
	/**
	 * @var string
	 */
	private $format;

	/**
	 * @param LoggerInterface $logger
	 * @param int $jsonOptions
	 * @param string $format
	 */
	public function __construct(LoggerInterface $logger, $jsonOptions = 0, $format = '%s %s') {
		$this->logger = $logger;
		$this->jsonOptions = $jsonOptions;
		$this->format = $format;
	}

	/**
	 * Logs with an arbitrary level.
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($level, $message, array $context = array()) {
		$message = sprintf('%s %s', $message, json_encode($context, $this->jsonOptions));
		$this->logger->log($level, $message, $context);
		return $this;
	}
}