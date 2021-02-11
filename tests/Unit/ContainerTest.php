<?php

/**
 * ContainerTest.php
 *
 * This test Suite tests all Container (class) functions.
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

namespace Redbox\Testsuite\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Redbox\Testsuite\Container;

/**
 * Class ContainerTest
 *
 * @package Redbox\Testsuite\Tests\Unit
 */
class ContainerTest extends TestCase
{
    /**
     * Container instance to run tests on.
     *
     * @var Container
     */
    protected $container;
    
    /**
     * This function will be executed before all test functions.
     * This means a fresh container instance for every test in this suite.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->container = new Container();
    }
    
    /**
     * Test getting and setting should work correctly.
     *
     * @return void
     */
    public function test_get_and_set_should_work_correctly()
    {
        $this->container->set('__FIRST__', 'second');
        
        $actual = $this->container->get('__FIRST__');
        $expected = 'second';
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * Test that the has function works correctly.
     *
     * @return void
     */
    public function test_has_works_correctly()
    {
        $this->container->set('__SECOND__', 'some value');
        $this->assertTrue($this->container->has('__SECOND__'));
    }
    
    /**
     * Test the forget function works correctly.
     *
     * @return void
     */
    function test_forget_works_correctly()
    {
        $this->container->set('__VAL__', 'some other value');
        
        $this->assertTrue($this->container->has('__VAL__'));
        
        $this->container->forget('__VAL__');
        
        $this->assertFalse($this->container->has('__VAL__'));
    }
    
    /**
     * Test the destroy function exists.
     *
     * @return void
     */
    public function test_destroy_function_should_exist()
    {
        $this->assertTrue(
            method_exists($this->container, 'destroy'),
            'Class does not have method destroy'
        );
    }
}
