<?php
namespace Kir\Logging\Essentials\Loggers;

use Kir\Logging\Essentials\Common\AbstractLogger;
use Kir\Logging\Essentials\Connectors\Connector;

class ConnectedLogger extends AbstractLogger {
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
	 */
	public function __construct(Connector $connector, array $parameters = array()) {
		$this->connector = $connector;
		$this->parameters = $parameters;
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
			$this->connector->send($message);
		} catch (\Exception $e) {
		}
		return $this;
	}
}