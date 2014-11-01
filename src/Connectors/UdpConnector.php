<?php
namespace Kir\Logging\Essentials\Connectors;

class UdpConnector implements Connector {
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
	 */
	public function __construct($host, $port) {
		$this->host = $host;
		$this->port = $port;
	}

	/**
	 * @param string $data
	 * @return void
	 */
	public function send($data) {
		$sock = fsockopen("udp://{$this->host}", $this->port);
		fputs($sock, $data);
		fclose($sock);
	}
}