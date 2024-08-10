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
use Splx\Set;
use Splx\SetInterface;

#[CoversClass(Set::class)]
class SetTest extends TestCase
{
    protected SetInterface $set;

    protected function setUp(): void {
        $this->set = new Set();
    }

    public function testInsert(): void {
        $this->set->add('a');
        $this->set->add('b');

        self::assertCount(2, $this->set);
    }

    public function testUnion(): void {
        $this->set->add('a');
        $this->set->add('b');
        $set = $this->set->union(new Set(['c', 'd']));

        self::assertCount(4, $set);
    }

    public function testIntersection(): void {
        $this->set->add('a');
        $this->set->add('b');
        $set = $this->set->intersect(new Set(['a', 'c']));

        self::assertCount(1, $set);
    }

    public function testDiff(): void {
        $this->set->add('a');
        $this->set->add('b');
        $set = $this->set->diff(new Set(['a']));

        self::assertCount(1, $set);
    }

}
