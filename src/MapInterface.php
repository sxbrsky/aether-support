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
 * @extends \Splx\Collection<TKey, TValue>
 */
interface MapInterface extends Collection
{
    /**
     * Associates the specified value with the specified key in this map.
     *
     * @param TKey $key
     *  The key to associate the value with.
     * @param TValue $value
     *  The value to be associated with the key.
     *
     * @return void
     */
    public function put(mixed $key, mixed $value): void;

    /**
     * Returns the value for a given key.
     *
     * @param TKey $key
     *  The key whose associated value is to be returned.
     *
     * @return TValue|null
     *  The value to which the specified key is mapped.
     */
    public function get(mixed $key): mixed;

    /**
     * Removes the element at the specified index from the collection.
     *
     * @param TKey ...$values
     *  The key to remove.
     *
     * @return void
     */
    public function remove(mixed ...$values): void;

    /**
     * Checks whether the map contains a given key.
     *
     * @param TKey $key
     *  The key to look for.
     *
     * @return bool
     *  <b>True</b> if key found, <b>false</b> otherwise.
     */
    public function containsKey(mixed $key): bool;

    /**
     * Determines whether the map contains a given value.
     *
     * @param TValue $value
     *  The value to look for
     *
     * @return bool
     *  <b>True</b> if value found, <b>false</b> otherwise.
     */
    public function containsValue(mixed $value): bool;
}
