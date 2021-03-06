<?php
namespace Kir\Logging\Essentials\Loggers;

use Kir\Logging\Essentials\Formatters\PlainFormatter;
use Kir\Logging\Essentials\Tools\LogLevelTranslator;

class ResourceLoggerTest extends \PHPUnit_Framework_TestCase {
	public function testLogging() {
		$resource = fopen('php://memory', 'r+');
		$logger = new ResourceLogger($resource, new PlainFormatter("\n"));
		foreach(LogLevelTranslator::getLevelTokens() as $level) {
			$logger->log($level, $level);
		}
		rewind($resource);
		$data = fread($resource, 4096);
		$this->assertEquals("emergency\nalert\ncritical\nerror\nwarning\nnotice\ninfo\ndebug\n", $data);
	}
}
 