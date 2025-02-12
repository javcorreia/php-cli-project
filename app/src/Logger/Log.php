<?php

namespace App\Cli\Logger;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log
{
    protected static Logger $instance;

    private function __construct()
    {
        //
    }

    public static function getLogger(): Logger
    {
        if (!isset(self::$instance)) {
            self::initializeLogger();
        }

        return self::$instance;
    }

    protected static function initializeLogger(): void
    {
        self::$instance = new Logger('log');
        if ($_ENV['LOG_FORMAT'] === 'json') {
            self::$instance->pushHandler((new StreamHandler('php://stdout'))->setFormatter(new \Monolog\Formatter\JsonFormatter()));
        } else {
            self::$instance->pushHandler(new StreamHandler('php://stdout'));
        }
    }

    public static function debug(string $message, array $context=[]): void
    {
        self::getLogger()->debug($message, $context);
    }

    public static function info(string $message, array $context=[]): void
    {
        self::getLogger()->info($message, $context);
    }

    public static function notice(string $message, array $context=[]): void
    {
        self::getLogger()->notice($message, $context);
    }

    public static function warning(string $message, array $context=[]): void
    {
        self::getLogger()->warning($message, $context);
    }

    public static function error(string $message, array $context=[]): void
    {
        self::getLogger()->error($message, $context);
    }

    public static function critical(string $message, array $context=[]): void
    {
        self::getLogger()->critical($message, $context);
    }

    public static function alert(string $message, array $context=[]): void
    {
        self::getLogger()->alert($message, $context);
    }

    public static function emergency(string $message, array $context=[]): void
    {
        self::getLogger()->emergency($message, $context);
    }
}