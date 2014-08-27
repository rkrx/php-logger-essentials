<?php
namespace Kir\Logging\Essentials\Formatters;

interface Formatter {
	/**
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @param array $parameters
	 * @return string
	 */
	public function format($level, $message, array $context, array $parameters);
}