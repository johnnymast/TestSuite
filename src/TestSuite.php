<?php

/**
 * TestSuite.php
 *
 * This middleware will intercept traffic from visitors to
 * your website.
 *
 * PHP version 7.2
 *
 * @category Core
 * @package  RedboxTestSuite
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-testsuite
 * @since    GIT:1.0
 */

namespace Redbox\Testsuite;

use Redbox\Testsuite\Interfaces\ContainerInterface;

class TestSuite
{
    /**
     * Storage to contain the
     * tests.
     *
     * @var \SplObjectStorage
     */
    protected ?\SplObjectStorage $tests = null;
    
    protected ?ContainerInterface $container = null;
    
    /**
     * Test Score counter.
     *
     * @var int|double
     */
    protected $score = 0;
    
    /**
     * TestSuite constructor.
     */
    public function __construct()
    {
        $this->tests = new \SplObjectStorage;
        
        $this->setContainer(new Container());
    }
    
    /**
     * Set he storage container for the test suite.
     *
     * @param ContainerInterface $container The storage container for the test suite.
     *
     * @return void
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    /**
     * Return the storage container.
     *
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }
    
    /**
     * Reset the score and rewind
     * the tests storage.
     *
     * @return void
     */
    public function reset()
    {
        $this->score = 0;
    }
    
    /**
     * Attach a Test or an array of
     * Tests to the TestSuite.
     *
     * @param $info The Test to attach.
     *
     * @return void
     */
    public function attach($info)
    {
        if (is_array($info) === true) {
            foreach ($info as $test) {
                $this->attach($test);
            }
        } else {
            $test = $info;
            
            if (is_string($info) === true && class_exists($info) === true) {
                $test = new $info();
            }
            
            if (is_subclass_of($test, Test::class) === false) {
                throw new \InvalidArgumentException('Test does not extend Test abstract class.');
            }
            
            $this->tests->attach($test);
        }
    }
    
    /**
     * Detach a given test from the
     * TestSuite.
     *
     * @param Test $test The test to detach.
     *
     * @return void
     */
    public function detach(Test $test)
    {
        $this->tests->detach($test);
    }
    
    /**
     * Check to see if the TestSuite has a given
     * test inside.
     *
     * @param Test $test The Test to check for.
     *
     * @return bool
     */
    public function has(Test $test)
    {
        return $this->tests->contains($test);
    }
    
    /**
     * Run the tests
     *
     * @return int The number of tests that ran.
     */
    public function run(): int
    {
        $tests_run = 0;
        
        /**
         * Reset the test results
         */
        $this->reset();
        
        foreach ($this->tests as $test) {
            $test->run();
            $this->score += $test->score->getScore();
            $tests_run++;
        }
        
        return $tests_run;
    }
    
    /**
     * Return the test suite score.
     *
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }
    
    /**
     * Return all tests.
     *
     * @return \SplObjectStorage
     */
    public function getTests()
    {
        return $this->tests;
    }
}
