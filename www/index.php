<?php declare(strict_types = 1);

use Tracy\Debugger;

include __DIR__ . '/../vendor/autoload.php';

Debugger::enable(Debugger::DETECT, __DIR__ . '/../log');

require __DIR__ . '/../app/bootstrap.php';
