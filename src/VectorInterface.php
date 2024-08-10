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
 * @template TKey of int|string
 * @template TValue
 *
 * @extends \Splx\Collection<TKey, TValue>
 */
interface VectorInterface extends Collection
{
    /**
     * Gets the value at a given index.
     *
     * @param TKey $index
     *  The index to access
     *
     * @return mixed
     *  The value at the requested index.
     *
     * @throws \OutOfBoundsException
     */
    public function at(int|string $index): mixed;

    /**
     * Adds values to the end of the vector.
     *
     * @param TValue ...$values
     *  The values to add.
     *
     * @return void
     */
    public function push(mixed ...$values): void;

    /**
     * Removes the last value of the vector.
     *
     * @return TValue|null
     *  The removed last value.
     *
     * @throws \UnderflowException
     *  If vector is empty.
     */
    public function pop(): mixed;

    /**
     * Sets a new value on specified index.
     *
     * @param TKey $index
     *  The index of the value to update.
     * @param TValue $value
     *  The new value.
     *
     * @return void
     */
    public function set(int|string $index, mixed $value): void;
}
