<?php

require '../vendor/autoload.php';

use Redbox\Testsuite\Test;
use Redbox\Testsuite\TestSuite;

/**
 * JUST A SPEC DEMO FOR MY SELF
 */
class SingleTest extends Test
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
     * @return void
     */
    public function run()
    {
        $this->checkAnswer(true);
        $this->checkAnswer(true);
        $this->checkAnswer(true);
    }
}

$test = new SingleTest();

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
