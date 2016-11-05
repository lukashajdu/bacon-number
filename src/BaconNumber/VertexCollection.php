<?php

namespace BaconNumber;

use Countable;
use Iterator;

/**
 * Vertex Collection
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package BaconNumber
 */
class VertexCollection implements Countable, Iterator
{
    /**
     * An array containing all vertex edges
     *
     * @var VertexInterface[]
     */
    private $edges = [];

    /**
     * Add the item to the collection
     *
     * @param VertexInterface $vertex
     *
     * @return bool
     */
    public function add(VertexInterface $vertex): bool
    {
        $this->edges[$vertex->getHash()] = $vertex;

        return true;
    }

    /**
     * Check if the key exists in the collection
     *
     * @param string $key
     *
     * @return bool
     */
    public function keyExists(string $key): bool
    {
        return isset($this->edges[$key]);
    }

    /**
     * Check if the item exists in the collection
     *
     * @param VertexInterface $item
     *
     * @return bool
     */
    public function itemExists(VertexInterface $item): bool
    {
        return $this->keyExists($item->getHash());
    }

    /**
     * {@inheritDoc}
     */
    public function count()
    {
        return count($this->edges);
    }

    /**
     * {@inheritDoc}
     */
    public function key()
    {
        return key($this->edges);
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        return next($this->edges);
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        return current($this->edges);
    }

    /**
     * {@inheritDoc}
     */
    public function valid()
    {
        return key($this->edges) !== null;
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        reset($this->edges);
    }
}
