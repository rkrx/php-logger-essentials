Logger-Essentials compared to Monolog
=====================================

[Monolog](https://github.com/Seldaek/monolog) comes with an impressive amount of logger-adapters ready for production.

Could these adapters not just be loggers themself? Yes, they could but for some reason they are not. Because of that, you are bound to the adapters shipped with monolog (or adapters ready on packagist, or just write your own). Because we have a standard (psr-3) I believe all we need is a composite-object that holds many psr-3-loggers and notify them with new messages - at least this is what monolog does, but with non-standard adapters.

Most of the monolog-handlers give only little control over, what log-levels should be discerned and sometimes hide possible parameters for loggers (look at PushoverHandler for example).

You can simply use LoggerCollection which also implements the LoggerInterface to replace Monolog\Logger. Then add as many psr-3-compliant Loggers to LoggerCollection as you like, wrap them in extenders, filters or formatters and gain more control about how your messages are treated.

[Back](..)