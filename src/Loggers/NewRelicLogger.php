<?php
namespace Kir\Logging\Essentials\Loggers;

use Kir\Logging\Essentials\Common\AbstractLogger;

class NewRelicLogger extends AbstractLogger {
	/**
	 * @var string
	 */
	private $appName;
	/**
	 * @var array
	 */
	private $params;
	/**
	 * @var bool
	 */
	private $useFlatKeys;

	/**
	 * @param string $appName
	 * @param array $params
	 * @param $useFlatKeys
	 */
	public function __construct($appName = null, array $params = array(), $useFlatKeys = false) {
		if(!extension_loaded('newrelic')) {
			throw new \RuntimeException('The newrelic PHP extension is required to use the NewRelicLogger');
		}
		$this->appName = $appName;
		$this->params = $params;
		$this->useFlatKeys = $useFlatKeys;
	}

	/**
	 * Logs with an arbitrary level.
	 * @param string $level
	 * @param string $message
	 * @param array $context
	 * @return $this
	 */
	public function log($level, $message, array $context = array()) {
		call_user_func('newrelic_set_appname', $this->appName);
		call_user_func('newrelic_notice_error', $message);
		if(!$this->useFlatKeys) {
			call_user_func('newrelic_add_custom_parameter', $context);
		} else {
			foreach ($context as $paramKey => $paramValue) {
				if(is_array($paramValue)) {
					foreach($paramValue as $subKey => $subValue) {
						call_user_func('newrelic_add_custom_parameter', "context_{$paramKey}_{$subKey}", $subValue);
					}
				} else {
					call_user_func('newrelic_add_custom_parameter', "context_{$paramKey}", $paramValue);
				}
			}
		}
		return $this;
	}
}