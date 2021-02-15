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
    
    /**
     * Storage container to contain information
     * for the tests.
     *
     * @var ContainerInterface|null
     */
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
     * This function will be called before every
     * test.
     *
     * @return void
     */
    public function beforeTest()
    {
        // Overwrite at will
    }
    
    /**
     * This function will be called after every
     * test.
     *
     * @return void
     */
    public function afterTest()
    {
        // Overwrite at will
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
        
        if ($this->tests->count() > 0) {
            foreach ($this->tests as $test) {
                $test->score->reset();
            }
        }
    }
    
    /**
     * Attach a Test or an array of
     * Tests to the TestSuite.
     *
     * @param $info The Test to attach.
     *
     * @return $this
     */
    public function attach($info): self
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
            
            if (is_subclass_of($test, TestCase::class) === false) {
                throw new \InvalidArgumentException('Test does not extend Test abstract class.');
            }
            
            $test->setName(get_class($test).'_'.$this->tests->count());
            
            $this->tests->attach($test);
        }
        
        return $this;
    }
    
    /**
     * Detach a given test from the
     * TestSuite.
     *
     * @param TestCase $test The test to detach.
     *
     * @return $this
     */
    public function detach(TestCase $test): self
    {
        $this->tests->detach($test);
        return $this;
    }
    
    /**
     * Check to see if the TestSuite has a given
     * test inside.
     *
     * @param TestCase $test The Test to check for.
     *
     * @return bool
     */
    public function has(TestCase $test)
    {
        return $this->tests->contains($test);
    }
    
    /**
     * Run the tests
     *
     * @param bool $reset Should the tests reset before running
     *
     * @return int The number of tests that ran.
     */
    public function run($reset = true): int
    {
        $tests_run = 0;
        
        /**
         * Reset the test results
         */
        if ($reset) {
            $this->reset();
        }
        
        $container = $this->getContainer();
        
        foreach ($this->tests as $test) {
            $this->beforeTest();
            
            $test->run($container);
            
            $this->afterTest();
            
            $this->score += $test->score->getScore();
            $tests_run++;
        }
        
        return $tests_run;
    }
    
    /**
     * Return the answers/motivations from all tests.
     *
     * @return array
     */
    public function getAnswers(): array
    {
        if ($this->tests->count() > 0) {
            $info = [];
            foreach ($this->tests as $test) {
                $info[$test->getName()] = $test->score->getScoreInfo();
            }
        }
        
        return $info;
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
