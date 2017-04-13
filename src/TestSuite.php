<?php

namespace johnnymast\Testsuite;

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

    /**
     * Attach a Test or an array of
     * Tests to the TestSuite.
     *
     * @param $type
     */
    public function attach($type)
    {
        if (is_array($type) === true) {
            foreach ($type as $test) {
                $this->attach($test);
            }
        } else {
            if (! $type instanceof Test) {
                throw new \InvalidArgumentException('Type not implementation Test interface.');
            }

            $this->tests->attach($type);
        }
    }

    /**
     * Detach a given test from the
     * TestSuite.
     *
     * @param Test $test
     */
    public function detach(Test $test)
    {
        $this->tests->detach($test);
    }

    /**
     * Check to see if the TestSuite has a given
     * test inside.
     *
     * @param Test $test
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
    public function score()
    {
        return $this->score;
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
                $this->score += $test->score();
                $tests_run++;;
            }
        }

        return $tests_run;
    }
}
