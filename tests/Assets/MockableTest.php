<?php

namespace Redbox\Testsuite\Tests\Assets;

use Redbox\Testsuite\Test;

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
     * @param  int  $score  The score to initialize the mock with.
     * @param  int  $min    The minimal score to initialize the moch with (optional)
     * @param  int  $max    The maximal score to initialize the moch with (optional)
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
        return new MockableTest();
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
     * @return bool
     */
    public function run()
    {
        return true;
    }
}