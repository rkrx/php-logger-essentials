php-logger-essentials
=====================
[![Build Status](https://travis-ci.org/rkrx/php-logger-essentials.svg?branch=master)](https://travis-ci.org/rkrx/php-logger-essentials)

A fully standards-compliant Logger ((PSR-3)[http://www.php-fig.org/psr/psr-3/]) with support for some extended features.

### So, why not just go with monolog?
(https://github.com/Seldaek/monolog)[Monolog] comes with an impressive amount of logger-adapters ready for production.

Could these adapters not just be loggers itself? Yes, they could. For some reason they are not. Because of that, you are bound to the adapters shipped with monolog (or adapters ready on packagist, or just write your own). Because we have a standard (psr-3) I believe all we need is a composite-Object that notifies all injected loggers with new messages - this is what monolog does.

You can simply use LoggerCollection which also implements the LoggerInterface to replace Monolog\Logger. Then add as many psr-3-compliant Loggers to LoggerCollection as you like, wrap them in extenders, filters or formatters and gain more control about how your messages are treated.

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