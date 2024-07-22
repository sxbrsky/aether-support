<?php declare(strict_types = 1);

/*
 * This file is part of the nulxrd/splx.
 *
 * Copyright (C) 2024 Dominik Szamburski
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */


if (!\file_exists(__DIR__.'/../vendor/autoload.php')) {
    throw new \RuntimeException('Install dependencies to run test suite.');
}

require_once __DIR__.'/../vendor/autoload.php';
