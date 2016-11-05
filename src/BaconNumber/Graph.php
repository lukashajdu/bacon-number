<?php

namespace BaconNumber;

/**
 * Graph
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package BaconNumber
 */
class Graph
{
    const INFINITE = PHP_INT_MAX;

    /**
     * Add vertex to the graph
     *
     * @param VertexInterface $vertex
     *
     * @return bool
     */
    public function addVertex(VertexInterface $vertex): bool
    {
    }

    /**
     * Calculate the shortest path between 2 vertexes
     *
     * @param VertexInterface $start
     * @param VertexInterface $finish
     *
     * @return int
     */
    public function shortestPath(
        VertexInterface $start,
        VertexInterface $finish
    ) {
    }
}
