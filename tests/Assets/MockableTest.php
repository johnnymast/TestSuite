<?php

namespace Redbox\Testsuite\Tests\Assets;

use Redbox\Testsuite\Score;
use Redbox\Testsuite\Test;

class MockableTest extends Test
{
    /**
     * Minimal score.
     *
     * @var int
     */
    public $min = 0;
    
    /**
     * Maximal score.
     *
     * @var int
     */
    public $max = 0;
    
    
    /**
     * @param  int  $score
     * @param  int  $min
     * @param  int  $max
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
     * @return int
     */
    public function minScore()
    {
        return $this->min;
    }
    
    /**
     * Return the maximum amount of
     * points the test can score.
     *
     * @return int
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