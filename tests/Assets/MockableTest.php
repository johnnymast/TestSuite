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
 * @since    GIT:1.0
 */

namespace Redbox\Testsuite\Tests\Assets;

use Redbox\Testsuite\Container;
use Redbox\Testsuite\Interfaces\ContainerInterface;
use Redbox\Testsuite\Test;

/**
 * Class MockableTest
 *
 * @package Redbox\Testsuite\Tests\Assets
 */
class MockableTest extends Test
{
    /**
     * Minimal score.
     *
     * @var int
     */
    public int $min = 0;
    
    /**
     * Maximal score.
     *
     * @var int
     */
    public int $max = 0;
    
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
        
        $instance->min = $min;
        $instance->max = $max;
        
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
     * Return the minimal amount of
     * points the test can score.
     *
     * @return mixed
     */
    public function minScore()
    {
        return $this->min;
    }
    
    /**
     * Return the maximum amount of
     * points the test can score.
     *
     * @return mixed
     */
    public function maxScore()
    {
        return $this->max;
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
