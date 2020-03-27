<?php
require "./vendor/autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler(__DIR__ .'/third.log', Logger::WARNING));

// add records to the log
$log->warning('THIS IS Another TEST');
$log->error('OK');