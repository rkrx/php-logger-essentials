<?php
namespace Kir\Logging\Essentials\Loggers;

use Exception;
use Kir\Logging\Essentials\Common\AbstractFormatableLogger;
use Kir\Logging\Essentials\Formatters\Formatter;
use Kir\Logging\Essentials\Formatters\Proxies;
use Kir\Logging\Essentials\Loggers\Connectors\Connector;

class ConnectedLogger extends AbstractFormatableLogger {
	/**
	 * @var Connector
	 */
	private $connector = null;

	/**
	 * @var array
	 */
	private $parameters = array();

	/**
	 * @param Connector $connector
	 * @param array $parameters
	 * @param Formatter $formatter
	 */
	public function __construct(Connector $connector, array $parameters = array(), Formatter $formatter = null) {
		$this->connector = $connector;
		$this->parameters = $parameters;
		if($formatter === null) {
			$formatter = static::getDefaultFormatter();
			$formatter = new Proxies\DateTimeFormatProxy($formatter);
			$formatter = new Proxies\NewlineFomatProxy($formatter);
		}
		parent::__construct($formatter);
	}

	/**
	 * Logs with an arbitrary level.
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($level, $message, array $context = array()) {
		try {
			$message = $this->getFormatter()->format($level, $message, $context, $this->parameters);
			$this->connector->send($message);
		} catch (Exception $e) {
		}
		return $this;
	}
}