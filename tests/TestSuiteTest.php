<?php

namespace johnnymast\Testsuite\Tests;

use johnnymast\Testsuite\Test;
use johnnymast\Testsuite\TestSuite;

class TestSuiteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that an \InvalidArgumentException will be
     * thrown if the test not has type Test.
     *
     * @expectedException \InvalidArgumentException
     */
    public function test_it_only_takes_tests()
    {
        $suite = new TestSuite();
        $suite->attach('invalid_type');
    }

    /**
     * Test it can attach a single test
     */
    public function test_it_can_take_at_test()
    {
        $test = $this->createMock(Test::class);
        $suite = new TestSuite();
        $suite->attach($test);

        $this->assertTrue($suite->has($test));
    }

    /**
     * Test it can attach a multiple tests
     */
    public function test_it_can_take_multiple_tests()
    {
        $test1 = $this->createMock(Test::class);
        $test2 = $this->createMock(Test::class);
        $suite = new TestSuite();
        $suite->attach([$test1, $test2]);

        $this->assertTrue($suite->has($test1));
        $this->assertTrue($suite->has($test2));
    }

    /**
     * Test it can detach a test.
     */
    public function test_it_can_detach_a_test() {
        $test = $this->createMock(Test::class);
        $suite = new TestSuite();
        $suite->attach($test);

        $this->assertTrue($suite->has($test));

        $suite->detach($test);
        $this->assertFalse($suite->has($test));
    }
}
