<?php

namespace BaconNumber;

/**
 * Vertex
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package BaconNumber
 */
class Vertex implements VertexInterface
{
    /**
     * Title of the vertex
     *
     * @var string
     */
    private $title;

    /**
     * Hashed title of the vertex
     *
     * @var string
     */
    private $hash;

    /**
     * Edges of the vertex
     *
     * @var VertexCollection
     */
    private $edges;

    /**
     * Distance from the starting point
     *
     * @var int
     */
    private $distance = Graph::INFINITE;

    /**
     * {@inheritdoc}
     */
    public function __construct(string $title)
    {
        $this->edges = new VertexCollection();
        $this->title = $title;
        $this->hash = hash('sha256', $title);
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * {@inheritdoc}
     */
    public function getEdges(): VertexCollection
    {
        return $this->edges;
    }

    /**
     * {@inheritdoc}
     */
    public function addEdge(VertexInterface $vertex)
    {
        $this->edges->add($vertex);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDistance(): int
    {
        return $this->distance;
    }

    /**
     * {@inheritdoc}
     */
    public function setDistance(int $distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function equals(VertexInterface $vertex): bool
    {
        return $this->hash === $vertex->getHash();
    }
}
