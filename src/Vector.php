<?php

/*
 * This file is part of the sxbrsky/splx.
 *
 * Copyright (C) 2024 Dominik Szamburski
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Splx;

/**
 * @template TKey of array-key
 * @template TValue
 *
 * @extends \Splx\AbstractCollection<TKey, TValue>
 * @implements \Splx\VectorInterface<TKey, TValue>
 */
class Vector extends AbstractCollection implements VectorInterface
{
    /**
     * @inheritDoc
     */
    public function at(int|string $index): mixed
    {
        if (!\array_key_exists($index, $this->data)) {
            throw new \OutOfBoundsException('Index is out of bounds.');
        }

        return $this->data[$index];
    }

    /**
     * @inheritDoc
     */
    public function push(...$values): void
    {
        foreach ($values as $value) {
            $this->data[] = $value;
        }
    }

    /**
     * @inheritDoc
     */
    public function pop(): mixed
    {
        if ($this->empty()) {
            throw new \UnderflowException('Cannot pop empty vector.');
        }

        return \array_pop($this->data);
    }

    /**
     * @inheritDoc
     */
    public function set(int|string $index, mixed $value): void
    {
        if (!\array_key_exists($index, $this->data)) {
            throw new \OutOfBoundsException('Index is out of bounds.');
        }

        $this->data[$index] = $value;
    }
}
