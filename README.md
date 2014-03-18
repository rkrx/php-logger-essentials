php-logger-essentials
=====================
Some useful additions to the psr/log-Interface

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
$logger = new MessagePrefixProxy(new StreamLogger(STDOUT), 'AddCustomer: ');
```

### CallbackFilterWrapper
Filter log-messages by a user defined callback filter.

## Loggers

* ErrorLogLogger
* StreamLogger
* PushoverLogger
* UdpLogger