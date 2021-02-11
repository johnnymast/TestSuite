<?php

/**
 * TestTest.php
 *
 * This test suite will test all Test Abstract related functions.
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

namespace Redbox\Testsuite\Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * Class TestTest
 *
 * @package Redbox\Testsuite\Tests\Unit
 */
class TestTest extends TestCase
{
    /**
     * The test instance used for all the tests.
     *
     * @var \Redbox\Testsuite\Test
     */
    protected $testInstance;
    
    /**
     * This function will be executed before all test functions.
     * This means a fresh test instance for every test in this suite.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->testInstance = new class extends \Redbox\Testsuite\Test {
    
            /**
             * Define the min score for this test.
             *
             * @return int
             */
            public function minScore()
            {
                return 0;
            }
    
            /**
             * Define the max score for this test.
             *
             * @return int
             */
            public function maxScore()
            {
                return 4;
            }
            
            /**
             * Fake method for testing.
             *
             * @return void
             */
            private function executeTest1()
            {
                $this->score->increment(2);
            }
            
            /**
             * Run the test.
             *
             * @return bool
             */
            public function run(): bool
            {
                $this->executeTest1();
                return true;
            }
        };
    }
    
    /**
     * Test that the default score is set to the min score.
     *
     * @return void
     */
    public function test_score_is_0_by_default()
    {
        $this->assertEquals(0, $this->testInstance->score->getScore());
    }
    
    /**
     * Test that set and get score are working correctly.
     *
     * @return void
     */
    public function test_set_and_get_score_work_correct()
    {
        $this->testInstance->score->setScore(5);
        
        $this->assertEquals(5, $this->testInstance->score->getScore());
    }
    
    /**
     * Test that the score on a test can be incremented.
     *
     * @return void
     */
    public function test_core_can_be_incremented()
    {
        $this->testInstance->score->setScore(5);
        $this->testInstance->score->increment(5);
        $this->assertEquals(10, $this->testInstance->score->getScore());
    }
    
    /**
     * Test that, after a test run the score is stored correctly.
     *
     * @return void
     */
    public function test_run_should_increment_score()
    {
        $this->testInstance->run();
        $this->assertEquals(2, $this->testInstance->score->getScore());
    }
    
    /**
     * Test that the score instance gets the min score from a test instance.
     *
     * @return void
     */
    public function test_score_knows_the_min_score()
    {
        $this->assertEquals(0, $this->testInstance->score->minScore());
    }
    
    /**
     * Test that the score instance gets the max score from a test instance.
     *
     * @return void
     */
    public function test_score_knows_the_max_score()
    {
        $this->assertEquals(4, $this->testInstance->score->maxScore());
    }
    
    /**
     * Test that the average score is communicated correctly.
     *
     * @return void
     */
    public function test_average_can_be_correctly_calculated()
    {
        $this->testInstance->score->increment(5);
        $this->testInstance->score->increment(5);
        $this->testInstance->score->increment(5);
        $this->assertEquals(5, $this->testInstance->score->average());
    }
    
    /**
     * Test that the average does not divide by zero if there is no score.
     *
     * @return void
     */
    public function test_average_does_not_divide_by_zero_increments_but_returns_false()
    {
        $this->assertEquals(0, $this->testInstance->score->average());
        $this->assertFalse($this->testInstance->score->average());
    }
    
    /**
     * Test percentage on score is calculated correctly.
     *
     * @return void
     */
    public function test_percentage_is_calculated_correctly()
    {
        /**
         * After running the score will be 2 + 1 = 4.
         * This will calculate percentage of 3 out of 4 (max score).
         */
        $this->testInstance->run();
        $this->testInstance->score->increment(1);
        $this->assertEquals(75, $this->testInstance->score->percentage());
    }
    
    /**
     * Test that score increments are calculated the rights way.
     *
     * @return void
     */
    public function test_increments_is_calculated_correctly()
    {
        $this->testInstance->score->increment(2);
        $this->testInstance->score->increment(2);
        $this->assertEquals(2, $this->testInstance->score->getIncrements());
    }
    
    /**
     * Test that empty tests have a 0% percentage score.
     *
     * @return void
     */
    public function test_percentage_should_be_0_without_increments()
    {
        $this->assertEquals(0, $this->testInstance->score->percentage());
    }
}
