<?php

/**
 * ContainerSpec.php
 *
 * This file tests the behavior of the Container class.
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
use Redbox\Testsuite\Container;

/**
 * Class ContainerSpec
 *
 * @package spec\Redbox\Testsuite
 */
class ContainerSpec extends ObjectBehavior
{
    /**
     * Check to see if the class can be initialized.
     *
     * @return void
     */
    function it_is_initializable()
    {
        $this->shouldHaveType(Container::class);
    }
    
    /**
     * Check for the existence of the destroy function.
     *
     * @return void
     */
    function it_should_have_a_callable_destroy_function()
    {
        $this->destroy();
    }
    
    /**
     * Check if there is a function called has.
     *
     * @return void
     */
    function it_should_have_a_workable_has_function()
    {
        $this->set('__HELLO__', 'world');
        $this->has('__HELLO__')->shouldReturn(true);
    }
    
    /**
     * Check if there is a function called get.
     *
     * @return void
     */
    function it_should_workable_get_and_set_function()
    {
        $this->set('__GOODBYE__', 'world');
        $this->get('__GOODBYE__');
    }
    
    /**
     * Check if there is a workable forget function.
     *
     * @return void
     */
    function it_should_have_a_workable_forget_function()
    {
        $this->set('__BLEEP__', 'world');
        $this->has('__BLEEP__')->shouldReturn(true);
        
        $this->forget('__BLEEP__');
        
        $this->has('__BLEEP__')->shouldReturn(false);
    }
}
