<?php

namespace spec\johnnymast\Testsuite;

use PhpSpec\ObjectBehavior;
use johnnymast\Testsuite\Test;
use johnnymast\Testsuite\TestSuite;
use spec\johnnymast\Testsuite\Assets\MockableTest;

class TestSuiteSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TestSuite::class);
    }

    function it_should_not_attach_unknown_tests()
    {
        $this->shouldThrow(\InvalidArgumentException::class)->during('attach', ['invalid']);
    }

    function it_should_attach_a_test($test)
    {
        $test->beADoubleOf(Test::class);
        $this->attach($test);
        $this->has($test)->shouldReturn(true);
    }

    function it_should_detach_a_test($test)
    {
        $test->beADoubleOf(Test::class);
        $this->detach($test);
        $this->has($test)->shouldReturn(false);
    }

    function it_should_allow_for_multiple_attachments($test1, $test2)
    {
        $test1->beADoubleOf(Test::class);
        $test2->beADoubleOf(Test::class);
        $this->attach([$test1, $test2]);

        $this->has($test1)->shouldReturn(true);
        $this->has($test2)->shouldReturn(true);
    }

    function it_should_run_a_single_test()
    {
        $test = new MockableTest();

        $this->attach($test);
        $this->run()->shouldReturn(1);

        /**
         * Dont know if we need this but lets
         * do it.
         */
        $this->detach($test);
    }

    function it_should_run_a_multiple_tests()
    {

        $test1 = new MockableTest();
        $test2 = new MockableTest();

        $this->attach([$test1, $test2]);
        $this->run()->shouldReturn(2);

        /**
         * Don't know if we need this but lets
         * do it.
         */
        $this->detach($test1);
        $this->detach($test2);
    }

    function it_should_score_five_with_one_test()
    {
        $test = new MockableTest(5);
        $this->attach($test);

        $this->run();
        $this->score()->shouldReturn(5);

        /**
         * Don't know if we need this but lets
         * do it.
         */
        $this->detach($test);
    }

    function it_should_score_eight_with_both_of_the_tests()
    {
        $test1 = new MockableTest(5);
        $test2 = new MockableTest(3);

        $this->attach([$test1, $test2]);

        $this->run();
        $this->score()->shouldReturn(8);

        /**
         * Don't know if we need this but lets
         * do it.
         */
        $this->detach($test1);
        $this->detach($test2);
    }

    function it_can_reset_it_self()
    {
        $test1 = new MockableTest(5);
        $test2 = new MockableTest(3);

        $this->attach([$test1, $test2]);

        $this->run();
        $this->score()->shouldReturn(8);

        /**
         * Don't know if we need this but lets
         * do it.
         */
        $this->detach($test1);
        $this->detach($test2);

        $this->reset();
        $this->score()->shouldReturn(0);
    }
}
