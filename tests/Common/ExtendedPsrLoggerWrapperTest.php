<?php
namespace Kir\Logging\Essentials\Common;

use Kir\Logging\Essentials\Loggers\ArrayLogger;

class ExtendedPsrLoggerWrapperTest extends \PHPUnit_Framework_TestCase {
	public function testAll() {
		$arrayLogger = new ArrayLogger();
		$logger = new ExtendedPsrLoggerWrapper($arrayLogger);
		$logger = $logger->createSubLogger('a');
		$logger = $logger->createSubLogger('b');
		$logger = $logger->createSubLogger('c');
		$logger->info('Hello World');
		$messages = $arrayLogger->getMessages();
		$this->assertContains('a / b / c', $messages[0]['message']);
	}
}
