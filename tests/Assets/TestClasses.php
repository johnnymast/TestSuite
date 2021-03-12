<?php

namespace Redbox\Testsuite\Tests\Specs\Assets;

use Redbox\Testsuite\Test;

class MockableTest implements Test
{
    /**
     * Earned score.
     *
     * @var int
     */
    protected $score = 0;

    /**
     * Minimal score.
     *
     * @var int
     */
    protected $min = 0;

    /**
     * Maximal score.
     *
     * @var int
     */
    protected $max = 0;

    /**
     * MockableTest constructor.
     *
     * @param int $score
     */
    public function __construct($score = 0, $min = 0, $max = 0)
    {
        $this->score = $score;
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * Return the minimal amount of
     * points the test can score.
     *
     * @return int
     */
    public function minScore()
    {
        return $this->min;
    }

    /**
     * Return the maximum amount of
     * points the test can score.
     *
     * @return int
     */
    public function maxScore()
    {
        return $this->max;
    }

    /**
     * Return the total test score.
     *
     * @return int
     */
    public function score()
    {
        return $this->score;
    }

    /**
     * Run the test.
     *
     * @return bool
     */
    public function run()
    {
        return true;
    }
}