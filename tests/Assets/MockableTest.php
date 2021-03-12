<?php

/**
 * MockableTest.php
 *
 * This file creates a fake mocked test instance that i can use for testing.
 *
 * PHP version 7.4
 *
 * @category Core
 * @package  RedboxTestSuite
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-testsuite
 * @since    1.0
 */

namespace Redbox\Testsuite\Tests\Assets;

use Redbox\Testsuite\Interfaces\ContainerInterface;
use Redbox\Testsuite\TestCase;
use Redbox\Testsuite\Test;

/**
 * Class MockableTest
 *
 * @package Redbox\Testsuite\Tests\Assets
 */
class MockableTest extends TestCase
{
    /**
     * Tell the TesCase what the
     * min reachable score is.
     *
     * @var int
     */
    protected int $minscore = 0;

    /**
     * Tell the TesCase what the
     * max reachable score is.
     *
     * @var int
     */
    protected int $maxscore = 10;

    /**
     * Create an instance with a score min value and max value.
     *
     * @param int $score The score to initialize the mock with.
     * @param int $min   The minimal score to initialize the moch with (optional)
     * @param int $max   The maximal score to initialize the moch with (optional)
     *
     * @return MockableTest
     */
    public static function createWith($score = 0, $min = 0, $max = 0): MockableTest
    {
        $instance = self::create();
        $instance->score->setScore($score);
        
        $instance->minscore = $min;
        $instance->maxscore = $max;
        
        return $instance;
    }
    
    /**
     * Create an instance of the MockableTest.
     *
     * @return MockableTest
     */
    public static function create(): MockableTest
    {
        return new static();
    }

    /**
     * Run the test.
     *
     * @param ContainerInterface $container The storage container for the TestSuite.
     *                                        
     * @return bool
     */
    public function run(ContainerInterface $container)
    {
        return true;
    }
}
