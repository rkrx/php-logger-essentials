<?php
namespace Kir\Logging\Essentials\Formatters\Proxies;

use Kir\Logging\Essentials\Formatters\Formatter;

class DateTimeFormatProxy implements Formatter {
	/**
	 * @var Formatter
	 */
	private $formatter;

	/**
	 * @var string
	 */
	private $dateFmt;

	/**
	 * @var string
	 */
	private $format;

	/**
	 * @param Formatter $formatter
	 * @param string $dateFmt
	 * @param string $format
	 */
	public function __construct(Formatter $formatter, $dateFmt = "Y-m-d H:i:s", $format = '%s  %s') {
		$this->formatter = $formatter;
		$this->dateFmt = $dateFmt;
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
		$message = $this->formatter->format($level, $message, $context, $parameters);
		return sprintf($this->format, date($this->dateFmt), $message);
	}
} 