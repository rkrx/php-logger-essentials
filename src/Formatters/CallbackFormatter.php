<?php
namespace Kir\Logging\Essentials\Formatters;

use Kir\Logging\Essentials\Common\AbstractLogger;
use Psr\Log\LoggerInterface;

class CallbackFormatter extends AbstractLogger {
	/**
	 * @var LoggerInterface
	 */
	private $logger;
	/**
	 * @var callable
	 */
	private $fn;

	/**
	 * @param LoggerInterface $logger
	 * @param \Closure $fn
	 */
	public function __construct(LoggerInterface $logger, $fn) {
		$this->logger = $logger;
		$this->fn = $fn;
	}

	/**
	 * Logs with an arbitrary level.
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($level, $message, array $context = array()) {
		$result = call_user_func($this->fn, $level, $message, $context);
		if($result) {
			$this->logger->log($level, $message, $context);
		}
		return $this;
	}
}