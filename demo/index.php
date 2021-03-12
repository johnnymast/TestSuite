<?php

require '../vendor/autoload.php';

use Redbox\Testsuite\Test;
use Redbox\Testsuite\TestSuite;

/**
 * JUST A SPEC DEMO FOR MY SELF
 */
class TheTest extends Test
{
    
    /**
     * Required function for tests indicating
     * the minimal score for this test.
     * 
     * @return int
     */
    public function minScore()
    {
        return 0;
    }
    
    /**
     * @return int
     */
    public function maxScore()
    {
        return 10;
    }
    
    /**
     *
     * @param  bool  $correct
     */
    protected function checkAnswer($correct)
    {
        if ($correct) {
            $this->score->increment(1);
        }
    }
    
    /**
     * Run the test.
     *
     * @return bool
     */
    public function run()
    {
        $this->checkAnswer(true);
        $this->checkAnswer(true);
        $this->checkAnswer(false);
        
        return true;
    }
}

$test = new TheTest();

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
echo "Percentage complete: ".$suite->getScore()."\n";
