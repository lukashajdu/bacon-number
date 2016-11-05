<?php

namespace BaconNumber;

use PHPUnit_Framework_TestCase as TestCase;

/**
 * Graph Test
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package BaconNumber
 */
class GraphTest extends TestCase
{
    /**
     * @covers \BaconNumber\Graph::__construct
     * @covers \BaconNumber\Graph::getVertexes
     */
    public function testConstructor()
    {
        $graph = new Graph();
        $this->assertEquals(new VertexCollection(), $graph->getVertexes());
    }

    /**
     * @covers \BaconNumber\Graph::addVertex
     * @covers \BaconNumber\Graph::getVertexes
     */
    public function testAddVertex()
    {
        $vertex = new Vertex('A');
        $graph = new Graph();
        $graph->addVertex($vertex);
        $collection = new VertexCollection();
        $collection->add($vertex);
        $this->assertEquals($collection, $graph->getVertexes());
    }

    /**
     * @covers \BaconNumber\Graph::getShortestDistance
     */
    public function testShortestPath()
    {
        $vertexA = new Vertex('A');
        $vertexB = new Vertex('B');
        $vertexC = new Vertex('C');
        $vertexD = new Vertex('D');
        $vertexE = new Vertex('E');
        $vertexF = new Vertex('F');
        $vertexG = new Vertex('G');
        $vertexH = new Vertex('H');

        $vertexA->addEdge($vertexB)->addEdge($vertexD);
        $vertexB->addEdge($vertexA)->addEdge($vertexF);
        $vertexC->addEdge($vertexD)->addEdge($vertexF);
        $vertexD->addEdge($vertexA)->addEdge($vertexC)->addEdge($vertexG);
        $vertexE->addEdge($vertexF)->addEdge($vertexH);
        $vertexF->addEdge($vertexB)->addEdge($vertexC)->addEdge($vertexE);

        $graph = new Graph();
        $graph->addVertex($vertexA);
        $graph->addVertex($vertexB);
        $graph->addVertex($vertexC);
        $graph->addVertex($vertexD);
        $graph->addVertex($vertexE);
        $graph->addVertex($vertexF);
        $graph->addVertex($vertexG);
        $graph->addVertex($vertexH);

        $this->assertEquals(2, $graph->getShortestDistance($vertexA, $vertexC));
        $this->assertEquals(1, $graph->getShortestDistance($vertexA, $vertexD));
        $this->assertEquals(0, $graph->getShortestDistance($vertexA, $vertexA));
        $this->assertEquals(3, $graph->getShortestDistance($vertexA, $vertexE));
        $this->assertEquals(3, $graph->getShortestDistance($vertexB, $vertexG));
        $this->assertEquals(4, $graph->getShortestDistance($vertexA, $vertexH));
        $this->assertEquals(3, $graph->getShortestDistance($vertexC, $vertexH));
        $this->assertEquals(2, $graph->getShortestDistance($vertexD, $vertexB));
    }

    /**
     * @covers \BaconNumber\Graph::getShortestDistance
     */
    public function testMissingEdge()
    {
        $vertexA = new Vertex('A');
        $vertexB = new Vertex('B');
        $vertexC = new Vertex('C');

        $vertexA->addEdge($vertexB);
        $vertexB->addEdge($vertexA);
        $vertexC->addEdge($vertexB);

        $graph = new Graph();
        $graph->addVertex($vertexA);
        $graph->addVertex($vertexB);
        $graph->addVertex($vertexC);

        $this->assertEquals(
            Graph::INFINITE,
            $graph->getShortestDistance($vertexA, $vertexC)
        );
    }

    /**
     * @covers \BaconNumber\Graph::getShortestDistance
     */
    public function testShortestPathException()
    {
        $vertexA = new Vertex('A');
        $vertexB = new Vertex('B');
        $vertexC = new Vertex('C');

        $vertexA->addEdge($vertexB);
        $vertexB->addEdge($vertexA)->addEdge($vertexC);
        $vertexC->addEdge($vertexB);

        $graph = new Graph();
        $graph->addVertex($vertexA);
        $graph->addVertex($vertexB);

        $this->assertEquals(1, $graph->getShortestDistance($vertexA, $vertexB));

        $this->expectException(\Exception::class);
        $graph->getShortestDistance($vertexA, $vertexC);
    }

    /**
     * @covers \BaconNumber\Graph::hasMorePathsToSource
     */
    public function testHasMorePathsToSource()
    {
        $vertex = new Vertex('A');
        $graph = new Graph();
        $graph->addVertex($vertex);
        $this->assertFalse($graph->hasMorePathsToSource($vertex));

        $vertex->setDistance(5);
        $graph->addVertex($vertex);
        $this->assertTrue($graph->hasMorePathsToSource($vertex));
    }
}
