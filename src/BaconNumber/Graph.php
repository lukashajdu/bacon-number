<?php

namespace BaconNumber;

use BaconNumber\Exception\UnsetVertexException;

/**
 * Graph
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package BaconNumber
 */
class Graph
{
    /**
     * The collection of all points in the graph
     *
     * @var VertexCollection[]
     */
    private $vertexes;

    const INFINITE = PHP_INT_MAX;

    /**
     * Constructor
     */
    function __construct()
    {
        $this->vertexes = new VertexCollection();
    }

    /**
     * Add vertex to the graph
     *
     * @param VertexInterface $vertex
     *
     * @return bool
     */
    public function addVertex(VertexInterface $vertex): bool
    {
        $this->vertexes->add($vertex);

        return true;
    }

    /**
     * Get vertexes
     *
     * @return VertexCollection
     */
    public function getVertexes(): VertexCollection
    {
        return $this->vertexes;
    }

    /**
     * Calculate the shortest distance between 2 vertexes
     *
     * The shortest distance is calculated using Dijkstra's Algorithm with
     * constant metric between 2 nodes.
     *
     * @param VertexInterface $start
     * @param VertexInterface $finish
     *
     * @return int
     * @throws UnsetVertexException
     */
    public function getShortestDistance(
        VertexInterface $start,
        VertexInterface $finish
    ): int {
        $distances = new VertexCollection();
        $nodes = new PriorityQueue();
        foreach ($this->vertexes as $vertex) {
            $metric = $start->equals($vertex) ? 0 : self::INFINITE;
            $vertex->setDistance($metric);
            $distances->add($vertex);
            $nodes->insert($vertex, $metric);
        }

        $nodes->top();

        /**
         * Loop over nodes and return the smallest distance
         */
        while ($nodes->valid()) {
            /** @var VertexInterface $smallest */
            $smallest = $nodes->current();
            if ($smallest->equals($finish)) {
                return $smallest->getDistance();
            }

            if (!$this->hasMorePathsToSource($smallest)) {
                break;
            }

            /**
             * Look at the all nodes where the current vertex is attached to
             */
            foreach ($smallest->getEdges() as $neighbor) {
                if (!$distances->itemExists($neighbor)) {
                    continue;
                }

                $metric = $smallest->getDistance() + 1;
                if ($metric < $neighbor->getDistance()) {
                    $neighbor->setDistance($metric);
                    $distances->add($neighbor);

                    $nodes->insert($neighbor, $metric);
                }
            }

            $nodes->next();
        }

        throw new UnsetVertexException(
            'Graph doesn\'t have configured all edges.'
        );
    }

    /**
     * Check if there are more paths to the source node
     *
     * When the vertex has infinite distance then there are no more paths to
     * the source node. Otherwise, there is still chance to find more nodes.
     *
     * @param VertexInterface $vertex
     *
     * @return bool
     */
    public function hasMorePathsToSource(VertexInterface $vertex): bool
    {
        return $vertex->getDistance() !== self::INFINITE;
    }
}
