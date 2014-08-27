<?php
namespace Kir\Logging\Essentials\Loggers\Connectors;

interface Connector {
	/**
	 * @param string $data
	 * @return void
	 */
	public function send($data);
} 