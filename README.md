rkr/logger-essentials
=====================
[![Build Status](https://travis-ci.org/rkrx/php-logger-essentials.svg?branch=master)](https://travis-ci.org/rkrx/php-logger-essentials) [![Latest Stable Version](https://poser.pugx.org/rkr/logger-essentials/version.svg)](https://packagist.org/packages/rkr/logger-essentials) [![Total Downloads](https://poser.pugx.org/rkr/logger-essentials/downloads.svg)](https://packagist.org/packages/rkr/logger-essentials) [![License](https://poser.pugx.org/rkr/logger-essentials/license.svg)](https://packagist.org/packages/rkrx/php-logger-essentials)

A fully standards-compliant Logger ([psr-3](http://www.php-fig.org/psr/psr-3/)) with some useful wrappers and adapters.

### So, why not just go with already existing libraries?

Compared with...

* [Monolog](doc/monolog.md)
* [KLogger](doc/klogger.md)
* [Log4PHP](doc/log4php.md)

### `LoggerCollection` for composite logging

```PHP
$errorLogger = new LoggerCollection();
$errorLogger->add(new ResourceLogger(STDERR));
$errorLogger->add(new ErrorLogLogger());
$errorLogger->add(new PushoverLogger(/* ... */));

$logger = new LoggerCollection();
$logger->add(new LogLevelRangeFilterProxy($errorLogger, LogLevel::ERROR, LogLevel::EMERGENCY));
$errorLogger->add(new LogLevelRangeFilterProxy(new ResourceLogger(STDOUT), LogLevel::INFO, LogLevel::WARNING));

$logger->error("This is a log messages");
```

### `ExtendedLogger` for sub-loggers
You can create subloggers from a logger-instance. The reason is to easly create a base-context for all deriving log-messages. So you can track, how a certain log-message come from. In a different project, the call-context could be different.

```PHP
$psrLogger = ...;
$logger = new ExtendedPsrLoggerWrapper($psrLogger, new CommonCaptionRenderer());
$subLogger = $logger->createSubLogger('Sub-Routine');
$subLogger = $logger->createSubLogger('Sub-Sub-Routine');
$subLogger->notice('Hello World'); // Sub-Routine / Sub-Sub-Routine: Hello World
```

### `Rfc5424LogLevels` and `LogLevelTranslator` for log-level conversion

```PHP
$psrLogLevel = Psr\Log\LogLevel::DEBUG;
$rfc5454LogLevel = 7 - LogLevelTranslator::getLevelNo($psrLogLevel);
$rfc5454WarningLevel = 7 - LogLevelTranslator::getLevelNo(Psr\Log\LogLevel::WARNING);
if($rfc5454LogLevel >= $rfc5454WarningLevel) {
	$logger->log($psrLogLevel, $message, array());
}
```

### Exclude a single log level with the `SingleLogLevelFilterProxy`
Define a single log-level to be excluded.

```PHP
$logger = new SingleLogLevelFilterProxy(new StreamLogger(STDOUT), LogLevel::DEBUG);
```

### Only include a certain range of log levels with the `LogLevelRangeFilterProxy`
Define a range of valid log-levels.

```PHP
$logger = new LoggerCollection();
$logger->add(new SingleLogLevelFilterProxy(new StreamLogger(STDOUT), LogLevel::INFO, LogLevel::ERROR));
$logger->add(new SingleLogLevelFilterProxy(new StreamLogger(STDERR), LogLevel::ERROR, LogLevel::EMERGENCY));

$logger->notice('test');
```

### Add a message prefix to all messages with the `MessagePrefixProxy`
Add a prefix to all log messages:

```PHP
$logger = new MessagePrefixProxy(new ResourceLogger(STDOUT), 'AddCustomer: ');
```

### CallbackFilterWrapper
Filter log-messages by a user defined callback filter.

## Loggers

* ErrorLogLogger
* StreamLogger
* ResourceLogger
* PushoverLogger
* UdpLogger
* NullLogger