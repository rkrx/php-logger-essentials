<?php
namespace Monolog\Handler;

use Kir\Logging\Essentials\Common\AbstractLogger;
use Psr\Log\LogLevel;

class ZendMonitorHandler extends AbstractLogger {
	/**
	 * @var array
	 */
	private static $levelMap = array(
		LogLevel::DEBUG => 0,
		LogLevel::INFO => 1,
		LogLevel::NOTICE => 2,
		LogLevel::WARNING => 3,
		LogLevel::ERROR => 4,
		LogLevel::CRITICAL => 5,
		LogLevel::EMERGENCY => 6,
		LogLevel::ALERT => 7,
	);

	/**
	 * @var array
	 */
	private static $nameMap = array(
		LogLevel::DEBUG => 'DEBUG',
		LogLevel::INFO => 'INFO',
		LogLevel::NOTICE => 'NOTICE',
		LogLevel::WARNING => 'WARN',
		LogLevel::ERROR => 'ERR',
		LogLevel::CRITICAL => 'CRIT',
		LogLevel::EMERGENCY => 'EMERG',
		LogLevel::ALERT => 'ALERT',
	);

	/**
	 * @var \Closure
	 */
	private $fn = null;

	/**
	 */
	public function __construct() {
		if(function_exists('zend_monitor_custom_event')) {
			$this->fn = function (array $event) {
				call_user_func('zend_monitor_custom_event', $event['priority'], $event['message'], $event);
			};
		} elseif(function_exists('monitor_custom_event')) {
			$this->fn = function (array $event) {
				$priority = $event['priority'];
				call_user_func('monitor_custom_event', $priority, $event['message'], ($priority > 2) ? 0 : 1, $event);
			};
		}
	}

	/**
	 * Logs with an arbitrary level.
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($level, $message, array $context = array()) {
		try {
			$event = array(
				'timestamp' => new \DateTime(),
				'priority' => (int) self::$levelMap[$level],
				'priorityName' => self::$nameMap[$level],
				'message' => (string) $message,
				'extra' => $context,
			);
			call_user_func($this->fn, $event);
		} catch(\Exception $e) {
		}
		return $this;
	}
}