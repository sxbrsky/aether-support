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

/**
 * @template TKey
 * @template TValue
 *
 * @extends \Splx\Collection<TKey, TValue>
 */
interface SetInterface extends Collection
{
    /**
     * Adds values to the set.
     *
     * @param TValue ...$values
     *  Values to insert to the set.
     *
     * @return void
     */
    public function add(mixed ...$values): void;

    /**
     * Removes given values from the set.
     *
     * @param mixed ...$values
     *  The values to remove.
     *
     * @return void
     */
    public function remove(mixed ...$values): void;

    /**
     * Creates a new set using values from the current set and another set.
     *
     * @param \Splx\SetInterface $set
     *  The other set, to combine with the current set.
     *
     * @return \Splx\SetInterface
     *  A new set containing all the values of the current set as well as another set.
     *
     */
    public function union(SetInterface $set): static;

    /**
     * Creates a new set by intersecting values with another set.
     *
     * @param \Splx\SetInterface $set
     *  The other set.
     *
     * @return \Splx\SetInterface
     *  The intersection of the current set and another set.
     */
    public function intersect(SetInterface $set): static;

    /**
     * Creates a new set using values that aren't in another set.
     *
     * @param \Splx\SetInterface $set
     *  Set containing the values to exclude.
     *
     * @return \Splx\SetInterface
     *  A new set containing all value that ware not in the other set.
     */
    public function diff(SetInterface $set): static;
}
