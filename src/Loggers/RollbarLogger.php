<?php
namespace Kir\Logging\Essentials\Loggers;

use Kir\Logging\Essentials\Common\AbstractLogger;
use Kir\Logging\Essentials\Loggers\RollbarLogger\RollbarNotifier;

class RollbarLogger extends AbstractLogger {
	/**
	 * @var RollbarNotifier
	 */
	private $rollbarNotifier;
	/**
	 * @var string
	 */
	private $channel;

	/**
	 * @param RollbarNotifier $rollbarNotifier
	 * @param string $channel
	 */
	public function __construct(RollbarNotifier $rollbarNotifier, $channel) {
		$this->rollbarNotifier = $rollbarNotifier;
		$this->channel = $channel;
	}

	/**
	 * Logs with an arbitrary level.
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($level, $message, array $context = array()) {
		$context['level'] = $level;
		$context['channel'] = $this->channel;
		$context['datetime'] = time();

		$this->rollbarNotifier->report_message($message, $level, $context);

		$this->rollbarNotifier->flush();
	}
}