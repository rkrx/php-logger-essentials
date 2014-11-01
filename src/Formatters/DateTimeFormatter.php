<?php
namespace Kir\Logging\Essentials\Formatters;

use Kir\Logging\Essentials\Common\AbstractLogger;
use Psr\Log\LoggerInterface;

class DateTimeFormatter extends AbstractLogger {
	/**
	 * @var LoggerInterface
	 */
	private $logger;
	/**
	 * @var string
	 */
	private $dateFmt;
	/**
	 * @var string
	 */
	private $format;

	/**
	 * @param LoggerInterface $logger
	 * @param string $dateFmt
	 * @param string $format
	 */
	public function __construct(LoggerInterface $logger, $dateFmt = "Y-m-d H:i:s", $format = '%s  %s') {
		$this->logger = $logger;
		$this->dateFmt = $dateFmt;
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
		$message = sprintf($this->format, date($this->dateFmt), $message);
		$this->logger->log($level, $message, $context);
		return $this;
	}
}