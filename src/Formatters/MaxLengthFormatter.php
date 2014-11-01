<?php
namespace Kir\Logging\Essentials\Formatters;

use Kir\Logging\Essentials\Common\AbstractLogger;
use Psr\Log\LoggerInterface;

class MaxLengthFormatter extends AbstractLogger {
	/**
	 * @var LoggerInterface
	 */
	private $logger;
	/**
	 * @var int
	 */
	private $maxLength;
	/**
	 * @var string
	 */
	private $charset;
	/**
	 * @var string
	 */
	private $ellipsis;

	/**
	 * @param LoggerInterface $logger
	 * @param int $maxLength
	 * @param string $ellipsis
	 * @param string $charset
	 */
	public function __construct(LoggerInterface $logger, $maxLength, $ellipsis = '...', $charset = 'UTF-8') {
		$this->logger = $logger;
		$this->ellipsis = $ellipsis;
		$this->maxLength = $maxLength < 0 ? 0 : $maxLength;
		$this->charset = $charset;
	}

	/**
	 * Logs with an arbitrary level.
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($level, $message, array $context = array()) {
		if($this->maxLength > mb_strlen($this->ellipsis)) {
			$ellipses = iconv('UTF-8', $this->charset, '...');
			$message = mb_substr($message, 0, $this->maxLength - 3, $this->charset);
			$message = $message . $ellipses;
		} else {
			$message = mb_substr($message, 0, $this->maxLength, $this->charset);
		}
		$this->logger->log($level, $message, $context);
		return $this;
	}
}