<?php
namespace Kir\Logging\Essentials\Loggers;

use Exception;
use Kir\Logging\Essentials\Common\AbstractLogger;
use Psr\Log\LogLevel;

class PushoverLogger extends AbstractLogger {
	/**
	 * @var string[]
	 */
	private $parameters = array();
	/**
	 * @var array
	 */
	private $contextConverterCallback;

	/**
	 * @param string $user
	 * @param string $token
	 * @param array $parameters
	 * @param \Closure $contextConverterCallback
	 */
	public function __construct($user, $token, array $parameters, $contextConverterCallback = null) {
		$parameters['token'] = $token;
		$parameters['user'] = $user;
		$this->parameters = $parameters;
		if(!$contextConverterCallback) {
			$contextConverterCallback = function() {
				return array();
			};
		}
		$this->contextConverterCallback = $contextConverterCallback;
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
			$parameters = $this->parameters;
			$parameters = array_merge($parameters, call_user_func($this->contextConverterCallback, $context));
			$parameters['priority'] = $this->convertLevelToPriority($level);
			$parameters['message'] = $message;
			$this->push($parameters);
		} catch (Exception $e) {
		}
		return $this;
	}

	/**
	 * @param string[] $parameters
	 */
	private function push($parameters) {
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => "https://api.pushover.net/1/messages.json",
			CURLOPT_POSTFIELDS => $parameters
		));
		curl_exec($ch);
		curl_close($ch);
	}

	/**
	 * @param string $level
	 * @return int
	 */
	private function convertLevelToPriority($level) {
		switch ($level) {
			case LogLevel::EMERGENCY:
			case LogLevel::ALERT:
				return 2;
			case LogLevel::CRITICAL:
				return 1;
			case LogLevel::ERROR:
				return 0;
		}
		return -1;
	}
}