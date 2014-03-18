<?php
namespace Kir\Logging\Essentials\Filters;

use Kir\Logging\Essentials\Common\AbstractLoggerWrapper;
use Psr\Log\LoggerInterface;

class MessagePrefixProxy extends AbstractLoggerWrapper {
	/**
	 * @var string
	 */
	private $caption = null;

	/**
	 * @var string
	 */
	private $concatenator = null;

	/**
	 * @param LoggerInterface $logger
	 * @param string $caption
	 * @param string $concatenator
	 */
	public function __construct(LoggerInterface $logger, $caption = null, $concatenator = ': ') {
		parent::__construct($logger);
		$this->caption = $caption;
		$this->concatenator = $concatenator;
	}

	/**
	 * Logs with an arbitrary level.
	 * @param mixed $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($level, $message, array $context = array()) {
		$parts = array();
		$parts[] = $this->caption;
		$parts[] = $message;
		$parts = array_filter($parts);
		$newMessage = join($this->concatenator, $parts);
		$this->logger()->log($level, $newMessage, $context);
		return $this;
	}
}