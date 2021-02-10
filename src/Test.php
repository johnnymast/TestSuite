<?php


namespace Redbox\Testsuite;


abstract class Test
{
    
    /**
     * @var Score
     */
    public ?Score $score = null;
    
    /**
     * The number of increments.
     *
     * @var int
     */
    private int $increments = 0;
    
    
    abstract public function minScore();
    
    abstract public function maxScore();
    
    
    final function __construct()
    {
        $this->score = new Score($this);
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
    public function getIncrements()
    {
        return $this->increments;
    }
    
    
    public function score()
    {
        return $this->score;
    }
    
    /**
     * @return mixed
     */
    abstract public function run();
}