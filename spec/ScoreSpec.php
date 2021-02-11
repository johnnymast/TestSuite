<?php

/**
 * ScoreSpec.php
 *
 * This file tests the behavior of the Score class.
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

namespace spec\Redbox\Testsuite;

use PhpSpec\ObjectBehavior;
use Redbox\Testsuite\Score;
use Redbox\Testsuite\Tests\Assets\MockableTest;

/**
 * Class ScoreSpec
 *
 * @package spec\Redbox\Testsuite
 */
class ScoreSpec extends ObjectBehavior
{
    /**
     * This function is run before every test.
     *
     * @return void
     */
    function let()
    {
        $this->beConstructedWith(MockableTest::createWith(0, 0, 200));
    }
    
    /**
     * Test the Score class is initializable.
     *
     * @return void
     */
    function it_is_initializable()
    {
        $this->shouldHaveType(Score::class);
    }
    
    /**
     * Test the score and be set and later be returned via get.
     *
     * @return void
     */
    private function it_should_be_able_to_set_and_get_the_score()
    {
        $this->setScore(5);
        $this->getScore()->shouldBe(5);
    }
    
    /**
     * Test that default score in the class is set to 0.
     *
     * @return void
     */
    private function it_the_default_value_for_scores_is_0()
    {
        $this->getScore()->shouldBe(0);
    }
    
    /**
     * Test incrementing scores works correctly.
     *
     * @return void
     */
    private function it_can_increment_scores()
    {
        $this->increment(1);
        $this->getScore()->shouldBe(1);
    }
    
    /**
     * Testing the average of 7 is calculated correctly.
     *
     * @return void
     */
    private function it_can_calculate_the_average_of_total_7()
    {
        $this->increment(2);
        $this->increment(2);
        $this->increment(3);
        $this->average()->shouldBeDouble(2.3333333333333);
    }
    
    /**
     * Testing the average of 9 is calculated correctly.
     *
     * @return void
     */
    private function it_can_calculate_the_average_of_total_9()
    {
        $this->increment(3);
        $this->increment(3);
        $this->increment(3);
        $this->average()->shouldBe(3);
    }
    
    /**
     * Testing the average of 12 is calculated correctly.
     *
     * @return void
     */
    private function it_can_calculate_the_average_of_total_12()
    {
        $this->increment(3);
        $this->increment(3);
        $this->increment(3);
        $this->increment(3);
        $this->average()->shouldBe(3);
    }
    
    /**
     * Test that score is calculating the percentage correctly.
     *
     * @return void
     */
    private function it_can_calculate_a_score_percentage()
    {
        $this->increment(11);
        $this->increment(11);
        $this->percentage()->shouldBeDouble(0.11);
    }
}
