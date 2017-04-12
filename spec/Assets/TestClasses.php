<?php

namespace spec\johnnymast\Testsuite\Assets;

use johnnymast\Testsuite\Test;

class MockableTest implements Test
{
    protected $score = 0;
    protected $min = 0;
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

    public function minScore()
    {
        return $this->min;
    }

    public function maxScore()
    {
        return $this->max;
    }

    public function score()
    {
        return $this->score;
    }

    public function run()
    {
        return true;
    }
}