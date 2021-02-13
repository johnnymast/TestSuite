<?php

/**
 * Multiple.php
 *
 * This file demonstrate how to add multiple tests to the test suite
 * and run the tests.
 *
 * PHP version 7.4
 *
 * @category Examples
 * @package  RedboxTestSuite
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-testsuite
 * @since    GIT:1.0
 */

require __DIR__.'/../vendor/autoload.php';

use Redbox\Testsuite\Interfaces\ContainerInterface;
use Redbox\Testsuite\TestSuite;
use Redbox\Testsuite\TestCase;

/**
 * JUST A SPEC DEMO FOR MY SELF
 */
class TheTestCase extends TestCase
{
    
    /**
     * Required function for tests indicating
     * the minimal score for this test.
     *
     * @return int
     */
    public function minScore(): int
    {
        return 0;
    }
    
    /**
     * Required function for tests indicating
     * the maximum score for this test.
     *
     * @return int
     */
    public function maxScore(): int
    {
        return 4;
    }
    
    /**
     * Demo function for answering demo questions.
     *
     * @param bool $correct For demo only if the answer is true mark correct.
     *
     * @return void
     */
    protected function checkAnswer(bool $correct)
    {
        if ($correct) {
            $this->score->increment(1);
        }
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
        $this->checkAnswer(true);
        $this->checkAnswer(true);
        $this->checkAnswer(false);
        
        return true;
    }
}

/**
 * Instantiate the test.
 */
$test = new TheTestCase();

/**
 * Create a test suite
 */
$suite = new TestSuite();
$suite->attach($test);

/**
 * Score should be
 *
 * Test score: 2
 *   - Answer 1 correct: true
 *   - Answer 2 correct: true
 *   - Answer 3 correct: false
 * ===================+
 * Total suite score 2
 */
$suite->run();

echo "Total suite score: ".$suite->getScore()."\n";
echo "Percentage complete: ".$test->score->percentage()."\n";
