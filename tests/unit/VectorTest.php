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

use OutOfBoundsException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Splx\Vector;
use Splx\VectorInterface;
use UnderflowException;

#[CoversClass(Vector::class)]
class VectorTest extends TestCase
{
    private VectorInterface $vector;

    public function setUp(): void {
        $this->vector = new Vector();
    }

    public function testAt(): void {
        $this->vector->push('one');
        $this->vector->push('two');

        self::assertEquals('one', $this->vector->at(0));
    }

    public function testAtThrowOutOfBoundsException(): void {
        self::expectException(OutOfBoundsException::class);
        self::expectExceptionMessage('Index is out of bounds.');

        $this->vector->at(1);
    }

    public function testPush(): void {
        $this->vector->push(1);
        $this->vector->push('two');

        self::assertCount(2, $this->vector);
    }

    public function testPop(): void {
        $this->vector->push(1);
        $this->vector->push('two');
        $this->vector->pop();

        self::assertCount(1, $this->vector);
    }

    public function testPopThrowsUnderflowExceptionIfVectorIsEmpty(): void {
        self::expectException(UnderflowException::class);
        self::expectExceptionMessage('Cannot pop empty vector.');

        $this->vector->pop();
    }

    public function testSet(): void {
        $this->vector->push('one');
        $this->vector->push('two');
        $this->vector->set(1, 'three');

        self::assertCount(2, $this->vector);
        self::assertEquals('three', $this->vector->at(1));
    }

    public function testSetThrowOutOfBoundsException(): void {
        self::expectException(OutOfBoundsException::class);
        self::expectExceptionMessage('Index is out of bounds.');

        $this->vector->set(1, 'three');
    }
}
