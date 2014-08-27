<?php
namespace Kir\Logging\Essentials\Formatters;

class DefaultFormatter implements Formatter {
	/**
	 * @var string
	 */
	private $format = '';

	/**
	 * @param string $format
	 */
	public function __construct($format = '%-9s  %s') {
		$this->format = $format;
	}

	/**
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @param array $parameters
	 * @return string
	 */
	public function format($level, $message, array $context, array $parameters) {
		$message = strtr($message, array("\t" => ' ', "\r" => '\\r', "\n" => '\\n'));
		$level = str_pad(strtoupper($level), 9, ' ', STR_PAD_RIGHT);
		return sprintf($this->format, $level, $message);
	}
}