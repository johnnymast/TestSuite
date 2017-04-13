<?php

namespace johnnymast\Testsuite;

class Score
{
    /**
     * @var int
     */
    private $score = 0;

    /**
     * The number of increments.
     *
     * @var int
     */
    private $increments = 0;

    /**
     * The minimal score for
     * the test.
     *
     * @var int
     */
    private $minscore = 0;

    /**
     * The maximal score for
     * the test.
     *
     * @var int
     */
    private $maxscore = 0;

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
        return ($this->score / $this->maxscore) * 100;
    }

    /**
     * Calculate the average for this
     * score.
     *
     * @return float|int
     */
    public function average()
    {
        return ($this->increments * $this->score) / $this->increments;
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
    public function getMinScore()
    {
        return $this->minscore;
    }

    /**
     * Return the maximal score.
     *
     * @return int
     */
    public function getMaxScore()
    {
        return $this->maxscore;
    }
}
