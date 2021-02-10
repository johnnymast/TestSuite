<?php
/**
 * Test.php
 *
 * The abstract class for Tests inside the TestSuite.
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

namespace Redbox\Testsuite;

/**
 * Class Test
 *
 * @package Redbox\Testsuite
 */
abstract class Test
{
    
    /**
     * Instance that keeps track of the score
     * for this test.
     *
     * @var Score
     */
    public ?Score $score = null;
    
    /**
     * The number of increments.
     *
     * @var int
     */
    private int $increments = 0;
    
    /**
     * Test constructor.
     *
     * Please not tests cant overwrite the function.
     */
    final function __construct()
    {
        $this->score = new Score($this);
    }
    
    /**
     * Increment the score by $score amount.
     *
     * @param mixed $value The score to increment with, float/double or int.
     *
     * @return void
     */
    public function increment($value)
    {
        $this->score += $value;
        $this->increments++;
    }
    
    /**
     * Return the percentage the score is
     * compared to the maximal score.
     *
     * @return float|int
     */
    public function percentage()
    {
        return ($this->score / $this->maxScore()) * 100;
    }
    
    /**
     * Calculate the average for this
     * score.
     *
     * @return float|int
     */
    public function average()
    {
        return round($this->score / $this->getIncrements());
    }
    
    /**
     * Return the number of increments the
     * score went over.
     *
     * @return int
     */
    public function getIncrements(): int
    {
        return $this->increments;
    }
    
    /**
     * Return the score for this test.
     *
     * @return Score
     */
    public function score(): Score
    {
        return $this->score;
    }
    
    /**
     * Tests must implement this method to indicate
     * the minimum score this test can reach.
     *
     * @return mixed
     */
    abstract public function minScore();
    
    /**
     * Tests must implement this method to indicate
     * the maximum score this test can reach.
     *
     * @return mixed
     */
    abstract public function maxScore();
    
    /**
     * Tests must implement this method to start
     * running their tests.
     *
     * @return void
     */
    abstract public function run();
}
