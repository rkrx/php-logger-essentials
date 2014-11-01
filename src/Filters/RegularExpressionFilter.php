<?php
namespace Kir\Logging\Essentials\Filters;

use Kir\Logging\Essentials\Common\AbstractLogger;
use Psr\Log\LoggerInterface;

class RegularExpressionFilter extends AbstractLogger {
	/**
	 * @var LoggerInterface
	 */
	private $logger;
	/**
	 * @var
	 */
	private $pattern;
	/**
	 * @var string
	 */
	private $modifiers;
	/**
	 * @var bool
	 */
	private $negate;

	/**
	 * @param LoggerInterface $logger
	 * @param $pattern
	 * @param string $modifiers
	 * @param bool $negate
	 */
	public function __construct(LoggerInterface $logger, $pattern, $modifiers = 'u', $negate = false) {
		$this->logger = $logger;
		$this->pattern = $pattern;
		$this->modifiers = $modifiers;
		$this->negate = !!$negate;
	}

	/**
	 * Logs with an arbitrary level.
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($level, $message, array $context = array()) {
		if(!!preg_match(sprintf("/%s/%s", preg_quote($this->pattern, '/'), $this->modifiers), $message) !== $this->negate) {
			$this->logger->log($level, $message, $context);
		}
		return $this;
	}
}