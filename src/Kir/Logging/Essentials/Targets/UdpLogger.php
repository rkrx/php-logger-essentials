<?php
namespace Kir\Logging\Essentials\Targets;

use Kir\Logging\Essentials\Common\AbstractFormatableLogger;
use Kir\Logging\Essentials\Formatters\Formatter;
use Kir\Logging\Essentials\Formatters\Proxies;

class UdpLogger extends AbstractFormatableLogger {
	/**
	 * @var string
	 */
	private $host;

	/**
	 * @var int
	 */
	private $port;

	/**
	 * @param string $host
	 * @param int $port
	 * @param Formatter $formatter
	 */
	public function __construct($host, $port = null, Formatter $formatter = null) {
		if($formatter === null) {
			$formatter = static::getDefaultFormatter();
			$formatter = new Proxies\DateTimeFormatProxy($formatter);
			$formatter = new Proxies\NewlineFomatProxy($formatter);
		}

		parent::__construct($formatter);

		if($port === null) {
			$port = -1;
		}

		$this->host = $host;
		$this->port = $port;
	}

	/**
	 * Logs with an arbitrary level.
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($level, $message, array $context = array()) {
		$parameters = array('host' => $this->host, 'port' => $this->port);
		$message = $this->getFormatter()->format($level, $message, $context, $parameters);
		$this->send($message);
		return $this;
	}

	/**
	 * @param string $message
	 */
	private function send($message) {
		$sock = fsockopen("udp://{$this->host}", $this->port);
		fputs($sock, $message);
		fclose($sock);
	}
}