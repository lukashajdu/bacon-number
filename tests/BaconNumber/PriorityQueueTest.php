<?php

namespace BaconNumber;

use PHPUnit_Framework_TestCase as TestCase;

/**
 * Priority Queue Test
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package BaconNumber
 */
class PriorityQueueTest extends TestCase
{
    public function testCompare()
    {
        /**
         * @covers \BaconNumber\PriorityQueue::compare
         */
        $queue = new PriorityQueue();

        $this->assertEquals(0, $queue->compare(1, 1));
        $this->assertEquals(-1, $queue->compare(2, 1));
        $this->assertEquals(1, $queue->compare(1, 2));
    }
}
