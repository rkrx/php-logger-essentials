<?php
namespace Kir\Logging\Essentials\Common;

use Psr\Log\LoggerInterface;

abstract class AbstractLoggerAware extends AbstractLogger {
	/**
	 * @var LoggerInterface
	 */
	private $logger = null;

	/**
	 * @param LoggerInterface $logger
	 */
	public function __construct(LoggerInterface $logger) {
		$this->logger = $logger;
	}

	/**
	 * @return LoggerInterface
	 */
	protected function logger() {
		return $this->logger;
	}
}