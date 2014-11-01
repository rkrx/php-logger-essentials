<?php
namespace Kir\Logging\Essentials\Connectors;

interface Connector {
	/**
	 * @param string $data
	 * @return void
	 */
	public function send($data);
} 