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
 * @extends \ArrayAccess<TKey, TValue>
 * @extends \IteratorAggregate<TKey, TValue>
 */
interface Collection extends \ArrayAccess, \Countable, \IteratorAggregate
{
    /**
     * Clears all elements from the collection.
     *
     * @return void
     */
    public function clear(): void;

    /**
     * Checks if the collection contains a specific value.
     *
     * @param TValue $value
     *  The value to check.
     *
     * @return bool
     *  <b>True</b> if the value is found, <b>false</b> otherwise.
     */
    public function contains(mixed $value): bool;

    /**
     * Checks if the collection is empty.
     *
     * @return bool
     *  <b>True</b> if the collection is empty, <b>false</b> otherwise.
     */
    public function empty(): bool;

    /**
     * Removes the element at the specified index from the collection.
     *
     * @param TKey $index
     *  The key to remove
     *
     * @return void
     *
     * @throws \OutOfBoundsException
     */
    public function remove(int|string $index): void;

    /**
     * Applies a callback to each element in the collection.
     *
     * @param callable $callback
     *  The callback function to apply.
     *
     * @return \Splx\Collection<TKey, TValue>
     */
    public function each(callable $callback): self;

    /**
     * Filters the collection using a callback function.
     *
     * @param callable $callback
     *  The callback function to determine if an element should be included.
     *
     * @return \Splx\Collection<TKey, TValue>
     */
    public function filter(callable $callback): self;

    /**
     * Returns the first item in this collection.
     *
     * @return TValue|false
     *  The first item in the collection.
     */
    public function first(): mixed;

    /**
     * Returns the last item in this collection.
     *
     * @return TValue|false
     *  The last item in the collection.
     */
    public function last(): mixed;
}
