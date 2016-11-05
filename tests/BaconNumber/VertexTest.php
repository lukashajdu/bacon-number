<?php

namespace BaconNumber;

use PHPUnit_Framework_TestCase as TestCase;

/**
 * Vertex Test
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package BaconNumber
 */
class VertexTest extends TestCase
{
    /**
     * @covers \BaconNumber\Vertex::__construct
     * @covers \BaconNumber\Vertex::getTitle
     * @covers \BaconNumber\Vertex::getHash
     */
    public function testConstructor()
    {
        $title = 'Title';
        $vertex = new Vertex($title);
        $this->assertEquals($title, $vertex->getTitle());
        $this->assertEquals(hash('sha256', $title), $vertex->getHash());
    }

    /**
     * @covers \BaconNumber\Vertex::getDistance
     */
    public function testGetDefaultDistance()
    {
        $vertex = new Vertex('A');
        $this->assertEquals(Graph::INFINITE, $vertex->getDistance());
    }

    /**
     * @covers \BaconNumber\Vertex::equals
     */
    public function testEquals()
    {
        $vertex1 = new Vertex('A');
        $vertex2 = new Vertex('A');
        $vertex3 = new Vertex('B');

        $this->assertTrue($vertex1->equals($vertex2));
        $this->assertFalse($vertex2->equals($vertex3));
    }
}
