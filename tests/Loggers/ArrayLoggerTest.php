<?php
namespace Kir\Logging\Essentials\Loggers;

class ArrayLoggerTest extends \PHPUnit_Framework_TestCase {
	public function testAll() {
		$logger = new ArrayLogger();

		$logger->alert('Test');
		$logger->error('Test');
		$logger->debug('Test');

		$messages = $logger->getMessages();
		$this->assertCount(3, $messages);
	}
}
 