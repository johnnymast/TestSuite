<?php

namespace Redbox\Testsuite;

class TestSuite
{
    /**
     * Storage to contain the
     * tests.
     *
     * @var \SplObjectStorage
     */
    protected $tests = null;
    
    /**
     * Test Score counter.
     *
     * @var int
     */
    protected $score = 0;
    
    /**
     * TestSuite constructor.
     */
    public function __construct()
    {
        $this->tests = new \SplObjectStorage;
    }
    
    /**
     * Reset the score and rewind
     * the tests storage.
     */
    public function reset()
    {
        $this->score = 0;
    }
    
    protected function countMaxScore()
    {
        $maxScore = 0;
        
        if (count($this->tests) > 0) {
            foreach ($this->tests as $test) {
                $maxScore += $test->maxScore();
            }
        }
        
        return $maxScore;
    }
    
    /**
     * Attach a Test or an array of
     * Tests to the TestSuite.
     *
     * @param $type
     */
    public function attach($info)
    {
        if (is_array($info) === true) {
            foreach ($info as $test) {
                $this->attach($test);
            }
        } else {
            $test = $info;
            
            // TODO: Allow array of class names and instantiate here
//            if (is_string($info) === true && class_exists($info) === true) {
//                $test = new $info();
//            }
            
            if (is_subclass_of($test, Test::class) === false) {
                throw new \InvalidArgumentException('Type not implementation Test interface.');
            }
            
            $this->tests->attach($test);
        }
    }
    
    /**
     * Detach a given test from the
     * TestSuite.
     *
     * @param  Test  $test
     */
    public function detach(Test $test)
    {
        $this->tests->detach($test);
    }
    
    /**
     * Check to see if the TestSuite has a given
     * test inside.
     *
     * @param  Test  $test
     *
     * @return bool
     */
    public function has(Test $test)
    {
        return $this->tests->contains($test);
    }
    
    /**
     * Return the score of tests
     * in this TestSuite.
     *
     * @return int
     */
    public function score(): int
    {
        return $this->score;
    }
    
    public function average()
    {
        return ($this->score / $this->countMaxScore()) * 100;
    }
    
    /**
     * Run the tests
     */
    public function run()
    {
        $tests_run = 0;
        
        /**
         * Reset the test results
         */
        $this->reset();
        
        foreach ($this->tests as $test) {
            if ($test->run()) {
                $this->score += $test->score->getScore();
                $tests_run++;;
            }
        }
        
        return $tests_run;
    }

    public function getScore()
    {
        return $this->score;
    }
}
