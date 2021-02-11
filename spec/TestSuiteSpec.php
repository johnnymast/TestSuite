<?php

/**
 * TestSuiteSpec.php
 *
 * This file tests the behavior of the TestSuite class.
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
use PhpSpec\Wrapper\Collaborator as CollaboratorAlias;
use Redbox\Testsuite\Test;
use Redbox\Testsuite\Tests\Assets\MockableTest;
use Redbox\Testsuite\TestSuite;

/**
 * Class
 * TestSuiteSpec
 *
 * @package spec\Redbox\Testsuite
 */
class TestSuiteSpec extends ObjectBehavior
{
    /**
     * Provides shouldBeInstanceOfClassByName() and shouldNotBeInstanceOfClassByName().
     *
     * @return \Closure[]
     */
    public function getMatchers(): array
    {
        return [
          'haveInstancesOfObjectWithType' => function ($subject, $type, $num = 0, $counter = 0) {
            foreach ($subject as $test) {
                if ($test instanceof $type) {
                    $counter++;
                }
            }
              return ($counter == $num);
          }
        ];
    }
    
    /**
     * Test the TestSuite class is initializable.
     *
     * @return void
     */
    function it_is_initializable()
    {
        $this->shouldHaveType(TestSuite::class);
    }
    
    /**
     * Test that an invalid argument exception will be thrown if an invalid test is being
     * attached to the testsuite.
     *
     * @return void
     */
    function it_should_not_attach_unknown_tests()
    {
        $this->shouldThrow(\InvalidArgumentException::class)->during('attach', ['invalid']);
    }
    
    /**
     * Test that attaching a Test works.
     *
     * @param CollaboratorAlias $test This is a fake instance of the Test Abstract.
     *
     * @return void
     */
    function it_should_attach_a_test($test)
    {
        $test->beADoubleOf(Test::class);
        
        $this->attach($test);
        $this->has($test)->shouldReturn(true);
    }
    
    /**
     * Test that one Test can be attached to the test suite.
     *
     * @param CollaboratorAlias $test This is a fake instance of the Test Abstract.
     *
     * @return void
     */
    function it_should_detach_a_test(CollaboratorAlias $test)
    {
        $test->beADoubleOf(Test::class);
        
        $this->detach($test);
        $this->has($test)->shouldReturn(false);
    }
    
    /**
     * Test getTests returns all tests.
     *
     * @param CollaboratorAlias $test This is a fake instance of the Test Abstract.
     *
     * @return void
     */
    function it_should_return_all_tests_with_gettests(CollaboratorAlias $test)
    {
        $test->beADoubleOf(Test::class);
        
        $this->attach($test);
        
        $this->getTests()->shouldHaveCount(1);
        $this->getTests()->shouldContain($test);
    }
    
    /**
     * Test that multiple classes can be attacked by passing the attach function an array with tests.
     *
     * @param CollaboratorAlias $test1 This is a fake instance of the Test Abstract.
     * @param CollaboratorAlias $test2 This is an other fake instance of the Test Abstract.
     *
     * @return void
     */
    function it_should_allow_for_multiple_attachments(CollaboratorAlias $test1, CollaboratorAlias $test2)
    {
        $test1->beADoubleOf(Test::class);
        $test2->beADoubleOf(Test::class);
        
        $this->attach([$test1, $test2]);
        
        $this->has($test1)->shouldReturn(true);
        $this->has($test2)->shouldReturn(true);
    }
    
    /**
     * Test one test can be attached by just using a classname. This
     * test will automatically be loaded by the test suite.
     *
     * @return void
     */
    function it_can_attach_one_test_by_class_name()
    {
        $this->getTests()->shouldHaveCount(0);
        $this->attach([MockableTest::class]);
        
        $this->getTests()->shouldHaveCount(1);
        
        $this->getTests()->shouldHaveInstancesOfObjectWithType(MockableTest::class, 1);
    }
    
    /**
     * Test one test can be attached by just using a classname. This
     * test will automatically be loaded by the test suite.
     *
     * @return void
     */
    function it_can_attach_multiple_tests_by_class_name()
    {
        $this->getTests()->shouldHaveCount(0);
        $this->attach([MockableTest::class, MockableTest::class]);
        
        $this->getTests()->shouldHaveCount(2);
        
        $this->getTests()->shouldHaveInstancesOfObjectWithType(MockableTest::class, 2);
    }
    
    /**
     * Test that a test suite could run a single test.
     *
     * @return void
     */
    function it_should_run_a_single_test()
    {
        $test = MockableTest::create();
        
        $this->attach($test);
        $this->run()->shouldReturn(1);
        
        /**
         * Dont know if we need this but lets
         * do it.
         */
        $this->detach($test);
    }
    
    /**
     * Test that a test suite can run multiple tests.
     *
     * @return void
     */
    function it_should_run_a_multiple_tests()
    {
        $test1 = MockableTest::create();
        $test2 = MockableTest::create();
        
        $this->attach([$test1, $test2]);
        $this->run()->shouldReturn(2);
        
        /**
         * Don't know if we need this but lets
         * do it.
         */
        $this->detach($test1);
        $this->detach($test2);
    }
    
    /**
     * Test that a test score will be returned to the test suite
     * correctly.
     *
     * @return void
     */
    function it_should_score_five_with_one_test()
    {
        $test = MockableTest::createWith(5);
        $this->attach($test);
        
        $this->run();
        $this->getScore()->shouldReturn(5);
        
        /**
         * Don't know if we need this but lets
         * do it.
         */
        $this->detach($test);
    }
    
    /**
     * Testing that the score of multiple tests in a suite
     * will be summed together correctly.
     *
     * @return void
     */
    function it_should_score_eight_with_both_of_the_tests()
    {
        $test1 = MockableTest::createWith(5);
        $test2 = MockableTest::createWith(3);
        
        $this->attach([$test1, $test2]);
        
        $this->run();
        $this->getScore()->shouldReturn(8);
        
        /**
         * Don't know if we need this but lets
         * do it.
         */
        $this->detach($test1);
        $this->detach($test2);
    }
    
    /**
     * Test that scores on a Test Suite can be reset.
     *
     * @return void
     */
    function it_can_reset_it_self()
    {
        $test1 = MockableTest::createWith(5);
        $test2 = MockableTest::createWith(3);
        
        $this->attach([$test1, $test2]);
        
        $this->run();
        $this->getScore()->shouldReturn(8);
        
        /**
         * Don't know if we need this but lets
         * do it.
         */
        $this->detach($test1);
        $this->detach($test2);
        
        $this->reset();
        $this->getScore()->shouldReturn(0);
    }
    
    /**
     * Test the default score for a TestSuite is 0.
     *
     * @return void
     */
    function it_the_default_value_for_scores_is_0()
    {
        $this->getScore()->shouldBe(0);
    }
}
