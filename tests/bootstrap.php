<?php declare(strict_types = 1);

if (!\file_exists(__DIR__.'/../vendor/autoload.php')) {
    throw new \RuntimeException('Install dependencies to run test suite.');
}

require_once __DIR__.'/../vendor/autoload.php';
