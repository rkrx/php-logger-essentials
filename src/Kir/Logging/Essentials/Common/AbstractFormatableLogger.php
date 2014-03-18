<?php
namespace Kir\Logging\Essentials\Common;

use Kir\Logging\Essentials\Formatters\DefaultFormatter;
use Kir\Logging\Essentials\Formatters\Formatter;

abstract class AbstractFormatableLogger extends AbstractLogger {
	/**
	 * @return Formatter
	 */
	public static function getDefaultFormatter() {
		return new DefaultFormatter();
	}

	/**
	 * @var Formatter
	 */
	private $formatter = null;

	/**
	 * @param Formatter $formatter
	 */
	public function __construct(Formatter $formatter = null) {
		if($formatter === null) {
			$formatter = static::getDefaultFormatter();
		}
		$this->setFormatter($formatter);
	}

	/**
	 * @return Formatter
	 */
	public function getFormatter() {
		return $this->formatter;
	}

	/**
	 * @param Formatter $formatter
	 * @return $this
	 */
	public function setFormatter(Formatter $formatter = null) {
		$this->formatter = $formatter;
		return $this;
	}
}