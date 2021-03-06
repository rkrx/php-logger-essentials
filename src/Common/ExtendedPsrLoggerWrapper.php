<?php
namespace Kir\Logging\Essentials\Common;

use Kir\Logging\Essentials\CaptionRenderer;
use Kir\Logging\Essentials\CaptionRenderers\CommonCaptionRenderer;
use Kir\Logging\Essentials\ExtendedLogger;
use Psr\Log\LoggerInterface;

class ExtendedPsrLoggerWrapper extends AbstractLogger implements ExtendedLogger {
	/**
	 * @var LoggerInterface
	 */
	private $logger = null;

	/**
	 * @var string[]
	 */
	private $captionPath = null;

	/**
	 * @var CaptionRenderer
	 */
	private $captionRenderer = null;

	/**
	 * @param LoggerInterface $logger
	 * @param CaptionRenderer $captionRenderer
	 * @param array $captionPath
	 */
	public function __construct(LoggerInterface $logger, CaptionRenderer $captionRenderer = null, array $captionPath = array()) {
		$this->logger = $logger;
		$this->captionRenderer = $captionRenderer ?: new CommonCaptionRenderer();
		$this->captionPath = $captionPath;
	}

	/**
	 * @param string $caption
	 * @return ExtendedLogger
	 */
	public function createSubLogger($caption) {
		$path = $this->captionPath;
		$path[] = $caption;
		return new static($this->logger, $this->captionRenderer, $path);
	}

	/**
	 * Logs with an arbitrary level.
	 * @param mixed $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($level, $message, array $context = array()) {
		$message = $this->captionRenderer->renderCaptionPath($this->captionPath, $level, $message, $context);
		$this->logger->log($level, $message, $context);
		return $this;
	}
}