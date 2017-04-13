<?php

namespace spec\johnnymast\Testsuite;

use johnnymast\Testsuite\Score;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ScoreSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Score::class);
    }


    function it_can_increment_scores() {
        $this->increment();
        $this->score->ShouldBe(1);
    }

    function it_can_calculate_the_average() {
        $this->increment(2);
        $this->increment(2);
        $this->increment(3);
        $this->average()->shouldReturn(2);
    }

    function it_can_calculate_a_score_percentage() {

    }
}
