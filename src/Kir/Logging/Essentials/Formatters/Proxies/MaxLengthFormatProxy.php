<?php
namespace Kir\Logging\Essentials\Formatters\Proxies;

use Kir\Logging\Essentials\Formatters\Formatter;

class MaxLengthFormatProxy implements Formatter {
	/**
	 * @var int
	 */
	private $maxLength;

	/**
	 * @var string
	 */
	private $charset;

	/**
	 * @param int $maxLength
	 * @param string $charset
	 */
	public function __construct($maxLength, $charset = 'UTF-8') {
		$this->maxLength = abs($maxLength);
		$this->charset = $charset;
	}

	/**
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @param array $parameters
	 * @return string
	 */
	public function format($level, $message, array $context, array $parameters) {
		if(mb_strlen($message, $this->charset)) {
			if($this->maxLength > 3) {
				$ellipses = iconv('UTF-8', $this->charset, '...');
				$shortMsg = mb_substr($message, 0, $this->maxLength - 3, $this->charset);
				return $shortMsg . $ellipses;
			}
			return mb_substr($message, 0, $this->maxLength, $this->charset);
		}
		return $message;
	}
}