<?php

namespace Redbox\Testsuite;

class Score
{
    /**
     * @var int
     */
    protected int $score = 0;
    
    /**
     * The number of increments.
     *
     * @var int
     */
    private int $increments = 0;
    
    /**
     * Score constructor.
     *
     * @param  Test  $test
     */
    public function __construct(Test $test)
    {
        $this->test = $test;
    }
    
    /**
     * Increment the score by $score amount.
     */
    public function increment($score)
    {
        $this->score += $score;
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
        return round(($this->maxScore() / 100) * $this->score,2);
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
     * @return int
     */
    public function minScore()
    {
        return $this->test->minScore();
    }
    
    /**
     * Return the maximal score.
     *
     * @return int
     */
    public function maxScore()
    {
        return $this->test->maxScore();
    }
    
    /**
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }
    
    /**
     * @param  int  $score
     */
    public function setScore($score = 0)
    {
        $this->score = $score;
    }
}
