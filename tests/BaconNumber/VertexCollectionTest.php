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

    /**
     * @covers \BaconNumber\VertexCollection::count
     */
    public function testCount()
    {
        $collection = new VertexCollection();

        $collection->add(new Vertex('A'));
        $collection->add(new Vertex('A'));
        $this->assertEquals(1, $collection->count());

        $collection->add(new Vertex('B'));
        $this->assertEquals(2, $collection->count());
    }

    /**
     * @covers \BaconNumber\VertexCollection::rewind
     * @covers \BaconNumber\VertexCollection::key
     */
    public function testRewind()
    {
        $vertex1 = new Vertex('A');
        $vertex2 = new Vertex('B');
        $collection = new VertexCollection();
        $collection->add($vertex1);
        $collection->add($vertex2);

        $collection->rewind();
        $this->assertEquals($vertex1->getHash(), $collection->key());
        $collection->next();
        $collection->rewind();
        $this->assertEquals($vertex1->getHash(), $collection->key());
    }

    /**
     * @covers \BaconNumber\VertexCollection::next
     */
    public function testNext()
    {
        $vertex1 = new Vertex('A');
        $vertex2 = new Vertex('B');
        $collection = new VertexCollection();
        $collection->add($vertex1);
        $collection->add($vertex2);

        $collection->rewind();
        $this->assertEquals($vertex2, $collection->next());
    }

    /**
     * @covers \BaconNumber\VertexCollection::current
     */
    public function testCurrent()
    {
        $vertex1 = new Vertex('A');
        $vertex2 = new Vertex('B');
        $collection = new VertexCollection();
        $collection->add($vertex1);
        $collection->add($vertex2);

        $collection->rewind();
        $this->assertEquals($vertex1, $collection->current());
        $collection->next();
        $this->assertEquals($vertex2, $collection->current());
    }

    /**
     * @covers \BaconNumber\VertexCollection::valid
     */
    public function testValid()
    {
        $vertex = new Vertex('A');
        $collection = new VertexCollection();
        $collection->add($vertex);

        $this->assertTrue($collection->valid());
        $collection->next();
        $this->assertFalse($collection->valid());
    }
}
