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
 * @implements \Splx\MapInterface<TKey, TValue>
 */
class Map extends AbstractCollection implements MapInterface
{
    /**
     * {@inheritDoc}
     * @param TKey $offset
     */
    public function offsetSet($offset, $value): void
    {
        $this->put($offset, $value);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset): mixed
    {
        return $this->get($offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset): bool
    {
        return $this->containsKey($offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset): void
    {
        $this->remove($offset);
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
    public function put(mixed $key, mixed $value): void
    {
        $hash = $this->hash($key);
        $this->data[$hash] = ['value' => $value, 'key' => $key];
    }

    /**
     * @inheritDoc
     */
    public function get(mixed $key): mixed
    {
        $hash = $this->hash($key);
        if (!\array_key_exists($hash, $this->data)) {
            return null;
        }
        return $this->data[$hash]['value'];
    }

    /**
     * @inheritDoc
     */
    public function containsKey(mixed $key): bool
    {
        $hash = $this->hash($key);
        return isset($this->data[$hash]['key']);
    }

    /**
     * @inheritDoc
     */
    public function containsValue(mixed $value): bool
    {
        foreach ($this->data as $item) {
            if ($item['value'] === $value) {
                return true;
            }
        }

        return false;
    }

    /**
     * Generates a hash value of the given value.
     *
     * @param TKey $value
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
