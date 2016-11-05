Bacon Number
============

[![Build Status](https://travis-ci.org/lukashajdu/bacon-number.svg?branch=develop)](https://travis-ci.org/lukashajdu/bacon-number)

Bacon Number is a PHP library for calculating the
[Bacon Number](https://en.wikipedia.org/wiki/Six_Degrees_of_Kevin_Bacon#Bacon_numbers)
(shortest path) between two points in the graph.

## Installation

Using Composer:

```
composer require lukashajdu/bacon-number
```

## Usage

If we consider the following graph:

![Graph](graph.jpg?raw=true "Graph")

Then the corresponding code will look like this:

```
<?php

require_once 'vendor/autoload.php';

// Create nodes in the graph
$vertexA = new Vertex('A');
$vertexB = new Vertex('B');
$vertexC = new Vertex('C');
$vertexD = new Vertex('D');
$vertexE = new Vertex('E');
$vertexF = new Vertex('F');
$vertexG = new Vertex('G');
$vertexH = new Vertex('H');

// Define all node edges
$vertexA->addEdge($vertexB)->addEdge($vertexC);
$vertexB->addEdge($vertexA)->addEdge($vertexD)->addEdge($vertexF);
$vertexC->addEdge($vertexA)->addEdge($vertexE);
$vertexD->addEdge($vertexB)->addEdge($vertexE);
$vertexE->addEdge($vertexC)->addEdge($vertexD)->addEdge($vertexH);
$vertexF->addEdge($vertexB)->addEdge($vertexG)->addEdge($vertexH);
$vertexG->addEdge($vertexF);
$vertexH->addEdge($vertexE)->addEdge($vertexF);

// Add all nodes to the graph
$graph = new Graph();
$graph->addVertex($vertexA);
$graph->addVertex($vertexB);
$graph->addVertex($vertexC);
$graph->addVertex($vertexD);
$graph->addVertex($vertexE);
$graph->addVertex($vertexF);
$graph->addVertex($vertexG);
$graph->addVertex($vertexH);

// Get the shortest distance between two nodes
echo $graph->getShortestDistance($vertexA, $vertexC); // 1
echo $graph->getShortestDistance($vertexA, $vertexD); // 2
echo $graph->getShortestDistance($vertexA, $vertexA); // 0
echo $graph->getShortestDistance($vertexA, $vertexE); // 2
echo $graph->getShortestDistance($vertexA, $vertexG); // 3
echo $graph->getShortestDistance($vertexA, $vertexH); // 3
```

## Running tests

Unit test can be run from a command line in the project root using
the following script:

```
$ ./vendor/bin/phpunit
```
