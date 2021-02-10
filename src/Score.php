<?php
/**
 * Score.php
 *
 * This file will maintain the Test scores.
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
 * Class Score
 *
 * @package Redbox\Testsuite
 */
class Score
{
    /**
     * The current score.
     *
     * @var mixed
     */
    protected $score = 0;
    
    /**
     * The number of increments this score went over.
     *
     * @var int
     */
    private int $increments = 0;
    
    /**
     * Reference to the test the score belongs to.
     *
     * @var Test
     */
    private Test $test;
    
    /**
     * Score constructor.
     *
     * @param Test $test The Test this score belongs to.
     */
    public function __construct(Test $test)
    {
        $this->test = $test;
    }
    
    /**
     * Increment the score by $score amount.
     *
     * @param mixed $value The value to increment the score with (float/double or int).
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
        return round(($this->getScore() / $this->maxScore()) * 100, 2);
    }
    
    /**
     * Calculate the average for this
     * score.
     *
     * @return float|int
     */
    public function average()
    {
        return ($this->increments > 0) ? ($this->score / $this->increments) : false;
    }
    
    /**
     * Return the number of increments the
     * score went over.
     *
     * @return int
     */
    public function getIncrements()
    {
        return $this->increments;
    }
    
    /**
     * Return the minimal score.
     *
     * @return mixed
     */
    public function minScore()
    {
        return $this->test->minScore();
    }
    
    /**
     * Return the maximal score.
     *
     * @return mixed
     */
    public function maxScore()
    {
        return $this->test->maxScore();
    }
    
    /**
     * Return the current score.
     *
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }
    
    /**
     * Set to score to a given value.
     *
     * @param int $value The value to set as the score.
     *
     * @return void
     */
    public function setScore($value = 0)
    {
        $this->score = $value;
    }
}
