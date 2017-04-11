<?php

namespace spec\johnnymast\Testsuite;

use johnnymast\Testsuite\Test;
use johnnymast\Testsuite\TestSuite;
use PhpSpec\ObjectBehavior;

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

    function it_should_run_a_single_test(Test $test)
    {
        $test->run()->willReturn(true);

        $this->attach($test);
        $this->run()->shouldReturn(1);
    }

    function it_should_run_a_multiple_tests(Test $test1, Test $test2)
    {
        $test1->run()->willReturn(true);
        $test2->run()->willReturn(true);


        $this->attach([$test1, $test2]);
        $this->run()->shouldReturn(2);
    }
}
