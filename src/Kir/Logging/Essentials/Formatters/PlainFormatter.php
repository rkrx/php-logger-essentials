<?php
namespace Kir\Logging\Essentials\Formatters;

class PlainFormatter implements Formatter {
	/**
	 * @var string
	 */
	private $lineEnding;

	/**
	 * @param string $lineEnding
	 */
	public function __construct($lineEnding = "\n") {
		$this->lineEnding = $lineEnding;
	}

	/**
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @param array $parameters
	 * @return string
	 */
	public function format($level, $message, array $context, array $parameters) {
		return sprintf("%s%s", $message, $this->lineEnding);
	}
}