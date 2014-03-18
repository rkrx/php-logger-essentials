<?php
namespace Kir\Logging\Essentials\Formatters\Proxies;

use Kir\Logging\Essentials\Formatters\Formatter;

class NewlineFomatProxy implements Formatter {
	/**
	 * @var Formatter
	 */
	private $formatter;

	/**
	 * @var string
	 */
	private $lineEnding;

	/**
	 * @param Formatter $formatter
	 * @param string $lineEnding
	 */
	public function __construct(Formatter $formatter, $lineEnding = "\n") {
		$this->formatter = $formatter;
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
		$message = $this->formatter->format($level, $message, $context, $parameters);
		return $message . $this->lineEnding;
	}
}