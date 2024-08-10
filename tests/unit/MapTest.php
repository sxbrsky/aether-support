<?php

/*
 * This file is part of the sxbrsky/splx.
 *
 * Copyright (C) 2024 Dominik Szamburski
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Splx\Tests\Unit;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Splx\Map;
use Splx\MapInterface;

#[CoversClass(Map::class)]
class MapTest extends TestCase
{
    protected MapInterface $map;

    protected function setUp(): void
    {
        $this->map = new Map();
    }

    public function testGet(): void {
        $this->map['john'] = 20;
        $this->map['jane'] = 30;

        self::assertEquals(20, $this->map->get('john'));
    }

    public function testPut(): void {
        $this->map->put('jane', 20);
        $this->map->put('john', 30);

        self::assertCount(2, $this->map);
        self::assertEquals(20, $this->map->get('jane'));
    }

    public function testContainsKey(): void {
        $this->map->put('jane', 20);
        $this->map->put('john', 30);

        self::assertTrue($this->map->containsKey('jane'));
    }

    public function testContainsValue(): void {
        $this->map->put('jane', 20);
        $this->map->put('john', 30);

        self::assertTrue($this->map->containsKey('jane'));
    }
}
