<?php

namespace spec\Redbox\Testsuite;

use Redbox\Testsuite\Tests\Assets\MockableTest;
use PhpSpec\ObjectBehavior;
use Redbox\Testsuite\Score;

class ScoreSpec extends ObjectBehavior
{
    function let () {
        $this->beConstructedWith(MockableTest::createWith(0, 0, 200));
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType(Score::class);
    }
    
    function it_should_be_able_to_set_and_get_the_score()
    {
        $this->setScore(5);
        $this->getScore()->shouldBe(5);
    }
    
    function it_the_default_value_for_scores_is_0()
    {
        $this->getScore()->shouldBe(0);
    }
    
    function it_can_increment_scores()
    {
        $this->increment(1);
        $this->getScore()->shouldBe(1);
    }
    
    function it_can_calculate_the_average_of_total_7()
    {
        $this->increment(2);
        $this->increment(2);
        $this->increment(3);
        $this->average()->shouldBeDouble(2.3333333333333);
    }
    
    function it_can_calculate_the_average_of_total_9()
    {
        $this->increment(3);
        $this->increment(3);
        $this->increment(3);
        $this->average()->shouldBe(3);
    }
    
    function it_can_calculate_the_average_of_total_12()
    {
        $this->increment(3);
        $this->increment(3);
        $this->increment(3);
        $this->increment(3);
        $this->average()->shouldBe(3);
    }
    
    function it_can_calculate_a_score_percentage()
    {
        $this->increment(11);
        $this->increment(11);
        $this->percentage()->shouldBeDouble(0.11);
    }
}
