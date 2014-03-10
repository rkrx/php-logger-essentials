php-logger-essentials
=====================
Some useful additions to the psr/log-Interface

## `ExtendedLogger` for sub-loggers
You can create subloggers from a logger-instance. The reason is to easly create a base-context for all deriving log-messages. So you can track, how a certain log-message come from. In a different project, the call-context could be different.

```PHP
$psrLogger = ...;
$logger = new ExtendedPsrLoggerWrapper($psrLogger, new CommonCaptionRenderer());
$subLogger = $logger->createSubLogger('Sub-Routine');
$subLogger = $logger->createSubLogger('Sub-Sub-Routine');
$subLogger->notice('Hello World'); // Sub-Routine / Sub-Sub-Routine: Hello World
```

## `Rfc5424LogLevels` and `LogLevelTranslator` for log-level conversion

```PHP
$psrLogLevel = Psr\Log\LogLevel::DEBUG;
$rfc5454LogLevel = 7 - LogLevelTranslator::getLevelNo($psrLogLevel);
$rfc5454WarningLevel = 7 - LogLevelTranslator::getLevelNo(Psr\Log\LogLevel::WARNING);
if($rfc5454LogLevel >= $rfc5454WarningLevel) {
	$logger->log($psrLogLevel, $message, array());
}
```

## `ExcludedLogLevelFilterWrapper`
Define a single log-level to be excluded.

## `LogLevelFilterWrapper`
Define a range of valid log-levels.

## `CallbackFilterWrapper`
Filter log-messages by a user defined callback filter.

