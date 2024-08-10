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
use Splx\AbstractCollection;
use Splx\Collection;
use Splx\Stubs\DummyCollection;

#[CoversClass(AbstractCollection::class)]
class CollectionTest extends TestCase
{
    protected Collection $collection;

    protected function setUp(): void {
        $this->collection = new DummyCollection();
    }

    public function testClear(): void {
        $this->collection[] = 'one';
        $this->collection[] = 'two';
        $this->collection->clear();
        self::assertTrue($this->collection->empty());
    }

    public function testContains(): void {
        $this->collection[] = 'one';
        $this->collection[] = 'two';
        self::assertTrue($this->collection->contains('one'));
    }

    public function testEmpty(): void {
        self::assertTrue($this->collection->empty());
    }

    public function testRemove(): void {
        $this->collection[] = 'one';
        $this->collection[] = 'two';
        $this->collection->remove(1);

        self::assertCount(1, $this->collection);
        self::assertEquals('one', $this->collection->first());
    }

    public function testRemoveOutOfBounds(): void {
        self::expectException(\OutOfBoundsException::class);
        self::expectExceptionMessage('Index was out of range.');

        $this->collection->remove(0);
    }

    public function testEach(): void {
        $it = 0;

        $this->collection[] = 'one';
        $this->collection[] = 'two';

        $this->collection->each(function () use (&$it) {
            $it++;
        });
        self::assertEquals(2, $it);
    }

    public function testFilter(): void {
        $this->collection[] = 'one';
        $this->collection[] = 'two';
        self::assertCount(1, $this->collection->filter(static fn ($item) => $item === 'one'));
    }

    public function testFirst(): void {
        $this->collection[] = 'one';
        $this->collection[] = 'two';
        self::assertEquals('one', $this->collection->first());
    }

    public function testLast(): void {
        $this->collection[] = 'one';
        $this->collection[] = 'two';
        self::assertEquals('two', $this->collection->last());
    }


}
