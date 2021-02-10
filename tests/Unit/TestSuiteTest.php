<?php

namespace Redbox\Testsuite\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Redbox\Testsuite\Test;
use Redbox\Testsuite\Tests\Assets\MockableTest;
use Redbox\Testsuite\TestSuite;

class TestSuiteTest extends TestCase
{
    /**
     * Test that an \InvalidArgumentException will be
     * thrown if the test not has type Test.
     */
    public function test_it_only_takes_tests()
    {
        $this->expectException(\InvalidArgumentException::class);
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
    public function test_it_can_detach_a_test()
    {
        $test = $this->createMock(Test::class);
        $suite = new TestSuite();
        $suite->attach($test);
        
        $this->assertTrue($suite->has($test));
        
        $suite->detach($test);
        $this->assertFalse($suite->has($test));
    }
    
    /**
     * Test that the run function will return 1 test
     * for being run.
     *
     */
    public function test_it_can_run_once()
    {
        $test = MockableTest::createWith(1);
        
        $suite = new TestSuite();
        $suite->attach($test);
        
        $actual = $suite->run();
        $expected = 1;
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * Test that the run function will return 2 tests
     * for being run.
     */
    public function test_it_can_multiple_tests()
    {
        $test1 = MockableTest::createWith(1);
        $test2 = MockableTest::createWith(2);
        
        $suite = new TestSuite();
        $suite->attach([$test1, $test2]);
        
        $actual = $suite->run();
        $expected = 2;
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * Test it can get the score of one test.
     */
    public function test_it_can_calculate_score_of_one_test()
    {
        $test = MockableTest::createWith(4);
        
        $suite = new TestSuite();
        $suite->attach($test);
        $suite->run();
        
        $actual = $suite->getScore();
        $expected = 4;
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * Test it can calculate score of multiple running tests
     */
    public function test_it_can_calculate_score_of_multiple_tests()
    {
        $test1 = MockableTest::createWith(4);
        $test2 = MockableTest::createWith(5);
        
        $suite = new TestSuite();
        $suite->attach([$test1, $test2]);
        $suite->run();
        
        $actual = $suite->getScore();
        $expected = 9;
        $this->assertEquals($expected, $actual);
    }
    
    public function test_getscore_returns_the_correct_value()
    {
        $test1 = MockableTest::createWith();
        $test1->score->increment(4);
        
        $suite = new TestSuite();
        $suite->attach([$test1]);
        $suite->run();
    
        $actual = $suite->getScore();
        $expected = 4;
    
        $this->assertEquals($expected, $actual);
    }
}
