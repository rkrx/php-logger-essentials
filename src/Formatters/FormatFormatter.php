<?php
namespace Kir\Logging\Essentials\Formatters;

use Kir\Logging\Essentials\Common\AbstractLogger;
use Psr\Log\LoggerInterface;

class FormatFormatter extends AbstractLogger {
	/**
	 * @var LoggerInterface
	 */
	private $logger;
	/**
	 * @var string
	 */
	private $format = '';
	/**
	 * @var array
	 */
	private $additionalValues;

	/**
	 * @param LoggerInterface $logger
	 * @param string $format
	 * @param array $additionalValues
	 */
	public function __construct(LoggerInterface $logger, $format = '%s', array $additionalValues = array()) {
		$this->logger = $logger;
		$this->format = $format;
		$this->additionalValues = $additionalValues;
	}

	/**
	 * Logs with an arbitrary level.
	 *
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($level, $message, array $context = array()) {
		$values = $this->additionalValues;
		array_unshift($values, $message);
		$message = vsprintf($this->format, $values);
		$this->logger->log($level, $message, $context);
		return $this;
	}
}