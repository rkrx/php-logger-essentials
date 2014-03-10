<?php
namespace Kir\Logging\Essentials\Common;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

abstract class AbstractLogger implements LoggerInterface {
	/**
	 * System is unusable.
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function emergency($message, array $context = array()) {
		$this->log(LogLevel::EMERGENCY, $message, $context);
		return $this;
	}

	/**
	 * Action must be taken immediately.
	 * Example: Entire website down, database unavailable, etc. This should
	 * trigger the SMS alerts and wake you up.
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function alert($message, array $context = array()) {
		$this->log(LogLevel::EMERGENCY, $message, $context);
		return $this;
	}

	/**
	 * Critical conditions.
	 * Example: Application component unavailable, unexpected exception.
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function critical($message, array $context = array()) {
		$this->log(LogLevel::ALERT, $message, $context);
		return $this;
	}

	/**
	 * Runtime errors that do not require immediate action but should typically
	 * be logged and monitored.
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function error($message, array $context = array()) {
		$this->log(LogLevel::ERROR, $message, $context);
		return $this;
	}

	/**
	 * Exceptional occurrences that are not errors.
	 * Example: Use of deprecated APIs, poor use of an API, undesirable things
	 * that are not necessarily wrong.
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function warning($message, array $context = array()) {
		$this->log(LogLevel::WARNING, $message, $context);
		return $this;
	}

	/**
	 * Normal but significant events.
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function notice($message, array $context = array()) {
		$this->log(LogLevel::NOTICE, $message, $context);
		return $this;
	}

	/**
	 * Interesting events.
	 * Example: User logs in, SQL logs.
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function info($message, array $context = array()) {
		$this->log(LogLevel::INFO, $message, $context);
		return $this;
	}

	/**
	 * Detailed debug information.
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function debug($message, array $context = array()) {
		$this->log(LogLevel::DEBUG, $message, $context);
		return $this;
	}

	/**
	 * Logs with an arbitrary level.
	 * @param mixed $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	abstract public function log($level, $message, array $context = array());
}