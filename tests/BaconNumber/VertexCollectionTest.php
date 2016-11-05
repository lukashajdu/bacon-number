<?php

namespace BaconNumber;

use PHPUnit_Framework_TestCase as TestCase;

/**
 * Vertex Collection Test
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package BaconNumber
 */
class VertexCollectionTest extends TestCase
{
    /**
     * @covers \BaconNumber\VertexCollection::add
     * @covers \BaconNumber\VertexCollection::keyExists
     */
    public function testAdd()
    {
        $vertex = new Vertex('A');

        $collection = new VertexCollection();
        $this->assertFalse($collection->keyExists($vertex->getHash()));
        $this->assertTrue($collection->add($vertex));
        $this->assertTrue($collection->keyExists($vertex->getHash()));
    }

    /**
     * @covers \BaconNumber\VertexCollection::itemExists
     */
    public function testItemExists()
    {
        $vertex = new Vertex('A');

        $collection = new VertexCollection();
        $this->assertFalse($collection->itemExists($vertex));
        $this->assertTrue($collection->add($vertex));
        $this->assertTrue($collection->itemExists($vertex));
    }
}
