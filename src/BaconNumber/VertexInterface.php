<?php

namespace BaconNumber;

/**
 * Vertex Interface
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package BaconNumber
 */
interface VertexInterface
{
    /**
     * Constructor
     *
     * @param string $title
     */
    public function __construct(string $title);

    /**
     * Get title of the vertex
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     * Get hashed title of the vertex
     *
     * @return mixed
     */
    public function getHash(): string;

    /**
     * Get edges of the vertex
     *
     * @return VertexCollection
     */
    public function getEdges(): VertexCollection;

    /**
     * Add edge to the collection of edges
     *
     * @param VertexInterface $vertex
     *
     * @return $this
     */
    public function addEdge(VertexInterface $vertex);

    /**
     * Get distance from the starting point
     *
     * @return int
     */
    public function getDistance(): int;

    /**
     * Set distance from the starting point
     *
     * @param int $distance
     *
     * @return $this
     */
    public function setDistance(int $distance);

    /**
     * Check if the vertex equals to the other vertex
     *
     * @param VertexInterface $vertex
     *
     * @return bool
     */
    public function equals(VertexInterface $vertex): bool;
}
