<?php

/*
 * This file is part of the nulxrd/splx.
 *
 * Copyright (C) 2024 Dominik Szamburski
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Splx;

use Traversable;

/**
 * @template TKey
 * @template TValue
 *
 * @extends \Splx\Collection<TKey, TValue>
 */
abstract class AbstractCollection implements Collection
{
    /**
     * @var array<TKey, TValue> $data
     */
    protected array $data = [];

    public function __construct(array $data = []) {
        foreach ($data as $key => $value) {
            $this[$key] = $value;
        }
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->data);
    }

    /**
     * @inheritDoc
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->data[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->data[$offset];
    }

    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $offset === null ? $this->data[] = $value : $this->data[$offset] = $value;
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->data[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function clear(): void
    {
        $this->data = [];
    }

    /**
     * @inheritDoc
     */
    public function contains(mixed $value): bool
    {
        return \in_array($value, $this->data, true);
    }

    /**
     * @inheritDoc
     */
    public function empty(): bool
    {
        return empty($this->data);
    }

    /**
     * @inheritDoc
     */
    public function remove(int|string $index): void
    {
        if (!\array_key_exists($index, $this->data)) {
            throw new \OutOfBoundsException("Index was out of range.");
        }

        unset($this->data[$index]);
    }

    /**
     * @inheritDoc
     */
    public function each(callable $callback): self
    {
        foreach ($this->data as $key => $value) {
            if ($callback($value, $key) === false) {
                break;
            }
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function filter(callable $callback): self
    {
        $self = clone $this;
        $self->data = \array_merge([], \array_filter($self->data, $callback));

        return $self;
    }

    /**
     * @inheritDoc
     */
    public function first(): mixed
    {
        return \reset($this->data);
    }

    /**
     * @inheritDoc
     */
    public function last(): mixed
    {
        return \end($this->data);
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return \count($this->data);
    }
}
