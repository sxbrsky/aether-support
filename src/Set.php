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
 * @implements \Splx\SetInterface<TKey, TValue>
 */
class Set extends AbstractCollection implements SetInterface
{
    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value): void
    {
        $this->add($value);
    }

    /**
     * @inheritDoc
     */
    public function contains(mixed $value): bool
    {
        $hash = $this->hash($value);
        return isset($this->data[$hash]);
    }

    /**
     * @inheritDoc
     */
    public function add(...$values): void
    {
        foreach ($values as $value) {
            $hash = $this->hash($value);
            $this->data[$hash] = $value;
        }
    }

    /**
     * @inheritDoc
     */
    public function remove(mixed ...$values): void
    {
        foreach ($values as $value) {
            $hash = $this->hash($value);
            unset($this->data[$hash]);
        }
    }

    /**
     * @inheritDoc
     */
    public function union(SetInterface $set): \Splx\SetInterface
    {
        $result = new static();

        foreach ($this->data as $value) {
            $result->add($value);
        }

        foreach ($set->getIterator() as $value) {
            $result->add($value);
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function intersect(SetInterface $set): \Splx\SetInterface
    {
        $result = new static();

        foreach ($this->data as $value) {
            if ($set->contains($value)) {
                $result->add($value);
            }
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function diff(SetInterface $set): \Splx\SetInterface
    {
        $result = new static();

        foreach ($this->data as $value) {
            if (!$set->contains($value)) {
                $result->add($value);
            }
        }

        return $result;
    }

    /**
     * Generates a hash value of the given value.
     *
     * @param TValue|TKey $value
     *  The value to hash.
     *
     * @return string
     *  The hash of the given value.
     */
    private function hash(mixed $value): string
    {
        return \is_object($value) ? \spl_object_hash($value) : \hash('sha256', \serialize($value));
    }
}
