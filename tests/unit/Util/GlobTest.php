<?php

/*
 * This file is part of the nulxrd/splx.
 *
 * Copyright (C) 2024 Dominik Szamburski
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Splx\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Splx\Util\Glob;

#[CoversClass(Glob::class)]
class GlobTest extends TestCase
{
    public function testNonMatchingGlobReturnEmptyArray(): void {
        $mock = \Mockery::mock(Glob::class);
        $mock->shouldReceive('glob')
            ->andReturn([]);

        $results = $mock->glob('./**/*.php');

        self::assertEmpty($results);
    }

    public function testGlob(): void {
        $mock = \Mockery::mock(Glob::class);
        $mock->shouldReceive('glob')
            ->andReturn([
                "./src/Glob.php",
                "./tests/bootstrap.php"
            ]);

        $results = $mock->glob('./**/*.php');

        self::assertNotEmpty($results);
        self::assertCount(2, $results);
    }

    public function testToLongPatternThrowsException(): void {
        self::expectException(\InvalidArgumentException::class);
        self::expectExceptionMessage('Pattern exceeds the maximum allowed length of 4096 characters');

        $glob = new Glob();
        $glob->glob(\str_repeat('/**/*.php', 10000));
    }
}
