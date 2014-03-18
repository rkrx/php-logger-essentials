<?php
namespace Kir\Logging\Essentials\Targets;

use Kir\Logging\Essentials\Common\AbstractFormatableLogger;
use Kir\Logging\Essentials\Formatters\Formatter;
use Kir\Logging\Essentials\Formatters\Proxies\DateTimeFormatProxy;
use Kir\Logging\Essentials\Formatters\Proxies\NewlineFomatProxy;

class StreamLogger extends AbstractFormatableLogger {
	/**
	 * @var resource
	 */
	private $resource = null;

	/**
	 * @param resource $resource
	 * @param Formatter $formatter
	 */
	public function __construct($resource, Formatter $formatter = null) {
		if($formatter === null) {
			$formatter = self::getDefaultFormatter();
			$formatter = new DateTimeFormatProxy($formatter);
			$formatter = new NewlineFomatProxy($formatter);
		}
		parent::__construct($formatter);
		$this->resource = $resource;
	}

	/**
	 * Logs with an arbitrary level.
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($level, $message, array $context = array()) {
		$fmtMessage = $this->getFormatter()->format($level, $message, $context, array());
		fwrite($this->resource, $fmtMessage);
		return $this;
	}
}