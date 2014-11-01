<?php
namespace Kir\Logging\Essentials\Connectors;

class TcpConnector implements Connector {
	/**
	 * @var resource
	 */
	private $res;

	/**
	 * @param string $host
	 * @param int $port
	 */
	public function __construct($host, $port) {
		$this->res = fsockopen("tcp://{$host}", $port);
	}

	/**
	 * @return resource
	 */
	public function getResource() {
		return $this->res;
	}

	/**
	 * @param string $data
	 * @return void
	 */
	public function send($data) {
		fwrite($this->res, $data);
	}
}