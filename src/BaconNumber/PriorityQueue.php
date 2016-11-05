<?php

namespace BaconNumber;

use SplPriorityQueue;

/**
 * Priority Queue
 *
 * Implementation of a heap
 *
 * @author Lukas Hajdu <hello@lukashajdu.com>
 * @copyright Lukas Hajdu <http://lukashajdu.com>, 2016
 * @package BaconNumber
 */
class PriorityQueue extends SplPriorityQueue
{
    /**
     * Compare priorities in order to place elements correctly in the heap
     *
     * Elements in the heap are ordered from the smallest priority in order to
     * get the shortest path
     *
     * @param mixed $priority1
     * @param mixed $priority2
     *
     * @return int
     */
    public function compare($priority1, $priority2)
    {
        return $priority2 <=> $priority1;
    }
}
