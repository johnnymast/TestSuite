<?php

/**
 * AfterCreation.php
 *
 * This file demonstrate is almost identical to Single.php and
 * will demonstrates the usage of the afterCreation() function
 * to prepare data to be used inside the test.
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
use Redbox\Testsuite\TestCase;
use Redbox\Testsuite\TestSuite;

/**
 * Class AfterCreationTest
 */
class AfterCreationTest extends TestCase
{
    
    /**
     * This array will be filled with answers
     * inside afterCreation.
     *
     * @var array
     */
    protected $answers = [];
    
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
     * This function is overwritten from Redbox\Testsuite\TestCase
     * and is being used to prepare information for the test.
     *
     * @return void
     */
    public function afterCreation()
    {
        $this->answers = [true, true, false];
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
     * @return void
     */
    public function run(ContainerInterface $container)
    {
        foreach ($this->answers as $answer) {
            $this->checkAnswer($answer);
        }
    }
}

/**
 * Instantiate the test.
 */
$test = new AfterCreationTest();

/**
 * Create a test suite and attach the test.
 */
$suite = new TestSuite();
$suite->attach($test)
    ->run();

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


echo "Total suite score: ".$suite->getScore()."\n";
echo "Percentage complete: ".$test->score->percentage()."%\n";
